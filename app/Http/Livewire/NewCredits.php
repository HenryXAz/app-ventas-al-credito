<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use App\Models\Customer;
use App\Models\Credit;
use App\Models\Payment;

use Livewire\Component;

class NewCredits extends Component
{
  use WithFileUploads;

    public $search = "";
    public $estimate = false;

    public $customers;
    public $customerSelected = false;
    public $dpiCustomer;
    public $nameCustomer;
    public $lastNameCustomer;
    public $idCustomer;

    public $amount;
    public $fee;
    public $lastShare;
    public $interestType = "1";
    public $interest;
    public $paymentFrequency = "1";
    public $paymentDate;
    public $carPhoto;

    public $balances = [];
    public $interests = [];
    public $paymentInterests = [];
    public $dates =  [];
    public $currentCapital =  [];
    public $fees = [];
    public $paymentNumber =  [];

    protected $rules = [
      "nameCustomer" => "required",
      "amount" => "required|regex:/^(\d*\.)?\d+$/",
      "fee" => "required|regex:/^(\d*\.)?\d+$/",
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
      if($this->search === "") {
        $this->customers = null;
      } else {
        $search = "%" . $this->search . "%";
        $this->customers = Customer::where("name", "like", $search)
        ->orWhere("last_name", "like", $search)
        ->orWhere("dpi", "like", $search)
        ->get();
      }
      
      return view('livewire.credits.new-credits');
    }


    public function save()
    {
      
      $imagePath = $this->carPhoto->store("carPhotos", "public");


      $credit = Credit::create([
        "name_customer" => "{$this->nameCustomer} {$this->lastNameCustomer}",
        "dpi_customer" => $this->dpiCustomer,
        "id_customer" => $this->idCustomer,
        "capital" => $this->amount,
        "fee" => $this->fee,
        "interest_type" => $this->interestType,
        "interest_rate" => $this->interest,
        "payment_frequency" => $this->paymentFrequency,
        "car_image" => $imagePath,
        "status" => "1"

      ])->id;

      if(count($this->balances)) {
        for($i=0;$i<count($this->balances); $i++) {
          Payment::create([
            "payment_number" => $this->paymentNumber[$i],
            "payment_date" => $this->dates[$i],
            "interest" => ($this->interestType === "1")? $this->interest: $this->paymentInterests[$i],
            "fee" => $this->fees[$i],
            "capital" => $this->currentCapital[$i],
            "balance" => $this->balances[$i],
            "status" => "1",
            "id_credit" => $credit,            
          ]);
        }
      }

      session()->flash("message", "crédito generado correctamente");
      $this->estimate = false;
    }

    public function feeCalculate()
    {
      $this->validate();

      $paymentFrequency = "";

      if($this->paymentFrequency === "1") {
        $paymentFrequency = "+ 1 month";
      }

      if($this->paymentFrequency === "2") {
        $paymentFrequency = "+ 7 days";
      }

      if($this->paymentFrequency === "3") {
        $paymentFrequency = "+ 15 days";
      }

      if($this->interestType === "2") {
        
        $interest = $this->interest / 100;
      
        $this->calculateWithPercentageInterest($interest, $paymentFrequency);
      }

      if($this->interestType === "1") {
        $interest = $this->interest;

        $this->calculateWithFixedInterest($interest, $paymentFrequency);
      }

      $this->estimate = !$this->estimate;

    }

    public function calculateWithPercentageInterest($interestPercentage, $paymentFrequency)
    {

      $amount = $this->amount;
      $this->fees[0] = $this->fee ?? 0;

      $i = 0;
      $interest = $interestPercentage;
      $this->balances[0] = round($amount, 2);

      $this->dates[0] = date($this->paymentDate);

      while($amount > 0) {
        $this->paymentNumber[$i] = $i + 1;
        $this->paymentInterests[$i] =  round($amount * $interest, 2);  
        $this->fees[$i] = $this->fee;      

        $amount = round($amount - ($this->fees[$i] - $this->paymentInterests[$i]), 2);
        $this->balances[$i] = round($amount, 2);
        $this->currentCapital[$i] = round($this->fees[$i] - $this->paymentInterests[$i],2);

        if($i > 0) {
          $this->dates[$i] = date("Y-m-d", strtotime(date($this->dates[$i - 1]) . $paymentFrequency));
        }  


        if($amount <= $this->fees[$i]) {
          $this->paymentNumber[$i + 1] = $i + 2; 
          $this->paymentInterests[$i + 1] =  round($amount * $interest, 2); 
          $this->balances[$i + 1] = 0;
          $this->dates[$i + 1] = date("Y-m-d", strtotime(date($this->dates[$i ]) . $paymentFrequency));
          $this->fees[$i + 1] = round($amount + $this->paymentInterests[$i + 1], 2);
         // $this->fees[$i + 1] = round($amount, 2);
          $this->currentCapital[$i + 1] = round($this->fees[$i + 1] - $this->paymentInterests[$i + 1],2) ;

          $amount = 0;
        }

        $i++;
      }
      

    }

    public function calculateWithFixedInterest($interestMount,$paymentFrequency)
    {
      $i = 0;
      $amount = $this->amount;
      $interest = $interestMount;
      $this->balances[0] = round($amount, 2);

      $this->dates[0] = date($this->paymentDate);

      while($amount > 0 ) {
        $this->paymentNumber[$i] = $i + 1;
        $this->fees[$i] = round($this->fee,2);
        $this->currentCapital[$i] = round($this->fees[$i] - $interest,2);      
        $this->balances[$i] = round($amount - ($this->fees[$i] - $interest),2);  
        $this->paymentInterests[$i] = $interest;
        
        $amount = $this->balances[$i];

        if($i > 0) {
          $this->dates[$i] = date("Y-m-d", strtotime(date($this->dates[$i - 1]) . $paymentFrequency));
        }  

        if($amount <= $this->fees[$i]) {
          $this->fees[$i + 1] = round($interest + $amount, 2);
          $this->balances[$i + 1] = 0; 
          $this->dates[$i + 1] = date("Y-m-d", strtotime(date($this->dates[$i ]) . $paymentFrequency));
          $this->currentCapital[$i + 1] = round($amount, 2);
          $this->paymentNumber[$i + 1] = $i + 2;
          $this->paymentInterests[$i + 1] = $interest;
          $amount = 0;
          break;
        }
        
        $i++;
      }
    }



    public function customerClicked($name, $lastName, $dpi, $id)
    {
      $this->customerSelected = true;
      $this->nameCustomer = $name;
      $this->lastNameCustomer = $lastName;
      $this->dpiCustomer = $dpi;
      $this->idCustomer = $id;
      $this->search = "";
    }

    public function unSelectedCustomer()
    {
      $this->customerSelected = false;
      $this->nameCustomer = "";
      $this->lastNameCustomer = "";
      $this->dpiCustomer = "";
      $this->idCustomer = "";
    }

    public function removeImage()
    {
      $this->carPhoto = null;
    }

    public function cleanFields()
    {
      $this->amount = "";
      $this->fee = "";
      $this->interestType = "1";
      $this->interest = "";
      $this->paymentFrequency = "1";
      $this->paymentDate = "";
      $this->carPhoto = "";
      $this->search = "";

      $this->idCustomer = "";
      $this->dpiCustomer = "";
      $this->nameCustomer = "";
      $this->lastNameCustomer = "";
      $this->customerSelected = false;

      $this->interests = [];
      $this->balances = [];
      $this->paymentInterests = [];
      $this->dates =  [];
      $this->currentCapital =  [];
      $this->fees = [];
      $this->paymentNumber =  [];
      

      $this->estimate = !$this->estimate;
    }

}
