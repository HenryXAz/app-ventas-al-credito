<?php

namespace App\Http\Livewire;

use App\Models\Credit;
use Livewire\WithFileUploads;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewCredits extends Component
{
  use WithFileUploads;

  public $search = "";
  public bool $estimate = false;

  public $customers = null;
  public $customerSelected = null;

  public $amount;
  public $fee;
  public $interestType = "1";
  public $interest;
  public $financialDefaultType;
  public $financialDefault;
  public $paymentFrequency;
  public $paymentDate;
  public $carPhoto;

  public $payments;
  public $totalInterest;
  public $test = null;

  protected $rules = [
    "amount" => "required|regex:/^(\d*\.)?\d+$/",
    "fee" => "required|regex:/^(\d*\.)?\d+$/|lt:amount",
    "interestType" => "required",
    "interest" => "required|regex:/^(\d*\.)?\d+$/",
    "paymentFrequency" => "required",
    "paymentDate" => "required",
    "carPhoto" => "required",
  ];

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }

  public function render()
  {
    if ($this->search === "") {
      $this->customers = null;
    } else {
      $search = $this->search . "%";
      $this->customers = Customer::where("name", "like", $search)
        ->orWhere("last_name", "like", $search)
        ->orWhere("dpi", "like", $search) 
        ->limit(10)
        ->get();
    }

    return view("livewire.credits.new-credits");
  }

  public function customerClicked(int $id)
  {
    $this->customerSelected = Customer::where("id", $id)->get(["id", "name", "last_name", "dpi"]);
    $this->search = "";
  }

  public function unSelectedCustomer()
  {
    $this->customerSelected = null;
  }

  public function removeImage()
  {
    $this->carPhoto = null;
  }

  public function cleanFields()
  {
    $this->resetExcept('estimate');
    $this->estimate = !$this->estimate;
  }

  public function isValidCredit($amount, $fee, $interest)
  {
    if (round($amount, 2) <= round($fee, 2)) {
      return 1;
    }

    if (round($fee, 2) <= round($interest, 2)) {
      return 2;
    }

    if (round($amount, 2) <= (round($interest, 2) + round($fee, 2))) {
      return 3;
    }

    return 0;
  }

  public function feeCalculate()
  {
    $this->validate();

    $initialInterest = ($this->interestType === "1")
      ? $this->interest
      : round($this->amount, 2) * (round($this->interest, 2) / 100);

    if ($this->isValidCredit($this->amount, $this->fee, $initialInterest) === 1) {
      session()->flash("error-credit", "la cuota no puede ser superior o igual al crédito");
      return;
    }

    if ($this->isValidCredit($this->amount, $this->fee, $initialInterest) === 2) {
      session()->flash("error-credit", "el interés no debe ser superior o igual a la cuota");
      return;
    }

    if ($this->isValidCredit($this->amount, $this->fee, $initialInterest) === 3) {
      session()->flash("error-credit", "la suma de interés y cuota no debe ser superior o igual al crédito");
      return;
    }

    $this->estimate = !$this->estimate;

    $this->payments = match(true)
    {
      $this->interestType === "1" => 
      DB::select('CALL `SP_CALCULATE_CREDIT_FIXED_INTEREST`(?,?,?,?,?)', [
        $this->amount,
        $this->fee,
        $initialInterest,
        $this->paymentFrequency,
        $this->paymentDate,
      ]),
      $this->interestType === "2" => 
      DB::select('CALL `SP_CALCULATE_CREDIT_PERCENTAGE_INTEREST`(?,?,?,?,?)', [
        $this->amount,
        $this->fee,
        $this->paymentFrequency,
        $this->interest,
        $this->paymentDate,
      ]),
      default => [],
    };

    $this->payments = collect($this->payments);
    $this->totalInterest = $this->payments->reduce(function ($carry, $current) {
      return $carry + $current->interest;
    }, 0.00);
  }

  public function save()
  {
    $carPhotoPath = $this->carPhoto->store("carPhotos", "public");

    $credit = Credit::create([
      "name_customer" => $this->customerSelected[0]->name . " " . $this->customerSelected[0]->last_name,
      "dpi_customer" => $this->customerSelected[0]->dpi,
      "id_customer" => $this->customerSelected[0]->id,
      "capital" => $this->amount,
      "balance" => $this->amount,
      "fee" => $this->fee,
      "interest_type" => $this->interestType,
      "interest_rate" => $this->interest,
      "payment_frequency" => $this->paymentFrequency,
      "car_image" => $carPhotoPath,
      "financial_default_type" => $this->financialDefaultType,
      "financial_default_amount" => $this->financialDefault,
      "next_payment_date" => $this->paymentDate,
      "status" => "1",
    ]);

    session()->flash("message", "!!Crédito generado con éxito!!");
    $this->cleanFields();
  }
}