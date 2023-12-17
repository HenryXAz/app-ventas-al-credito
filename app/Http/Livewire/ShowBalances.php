<?php

namespace App\Http\Livewire;

use App\Models\Credit;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ShowBalances extends Component
{
  use WithFileUploads;

  public $search = "";
  public $customers = null;
  public $customerSelected = null;
  public $credits = [];
  public $credit = null;
  public $creditPaymentInfo = null;
  public $payments = [];
  
  #[Rule('regex:/^(\d*\.)?\d+$/')]
  #[Rule('required')]
  public $fee;

  #[Rule('regex:/^(\d*\.)?\d+$/')]
  #[Rule('required')]
  public $customFinancialDefault;
 
  public $paymentMethod = "1";

  public $paymentCertification = null;
  public $bankId = null;
  public $bankName = "Banrural";

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }

  public function render()
  {
    if ($this->search === "") {
      $this->customers = null;
    } else {
      $search = "%" . $this->search . "%";
      $this->customers = Customer::where("name", "like", $search)
        ->orWhere("last_name", "like", $search)
        ->orWhere("dpi", "like", $search)
        ->get();
    }

    return view('livewire.balances.show-balances');
  }

  public function makePayment()
  {
    $this->validate();
    $paymentCertificationPath = "";

    if($this->paymentMethod == '2') {
      if($this->bankName == null || $this->bankId == null || $this->paymentCertification == null) {
        session()->flash("error_bank_payment_method", "Asegúrese de ingresar correctamente los datos para pago por banco");
        return;
      } 

      $paymentCertificationPath = $this->paymentCertification->store("payments", "public");
    }

    try {
      DB::beginTransaction();

      $paymentInfo = DB::select(
        '
        CALL `SP_CALCULATE_NEXT_PAYMENT`(
          @credit_id := :credit_id,
          @fee := :fee,
          @custom_financial_default := :financial_default
        );',
        [
          'credit_id' => $this->credit->id,
          'fee' => $this->fee,
          'financial_default' => $this->customFinancialDefault,
        ]
      );

      Payment::create([
        'payment_number' => $paymentInfo[0]->payment_number,
        'payment_date' => \Carbon\Carbon::parse($paymentInfo[0]->current_payment_date)->format('Y-m-d'),
        'payment_day' => \Carbon\Carbon::today('America/Guatemala')->format('Y-m-d'),
        'interest' => $paymentInfo[0]->interest_amount,
        'fee' => $this->fee,
        'capital' => $paymentInfo[0]->recovered_capital,
        'balance' => $paymentInfo[0]->new_balance,
        'status' => '2',
        'financial_default' => $paymentInfo[0]->financial_default_amount,
        'certification_payment' => $paymentCertificationPath,
        'method_payment' => $this->paymentMethod,
        'received_by' => Auth::user()->name,
        'bank_id' => ($this->paymentMethod == '2') ? $this->bankId : null,
        'bank_name' => ($this->paymentMethod == '2') ? $this->bankName : null,
        'id_credit' => $this->credit->id,
      ]);
      DB::commit();

      session()->flash("successful_payment", "Se realizó el pago con éxito");
      $this->chooseCredit($this->credit->id);
      $this->removeImage();
    } catch (\PDOException $e) {
      DB::rollBack();
      dd($e->getMessage());
      session()->flash("error_when_making_payment", "Error, asegúrese de ingresar los campos correctos y tener una buena conexión");
    }
  }

  public function chooseCustomer(int $id)
  {
    $this->search = "";
    $this->customerSelected = Customer::where("id", $id)->get(['id', 'name', 'last_name', 'dpi']);
    $this->credits = Credit::where("id_customer", $this->customerSelected[0]->id)->get();
  }

  public function unSelectCustomer()
  {
    $this->customerSelected = null;
    $this->credits = [];
    $this->credit = null;
    $this->payments = [];
  }

  public function chooseCredit(int $creditId)
  {
    $this->credits = [];
    $this->credit = Credit::find($creditId);

    // get info of next_payment
    $this->calculatePayment();

    // get all payments
    $this->payments = Payment::where("id_credit", $this->credit->id)
      ->orderBy('payment_number' , 'desc')
      ->get();
    }

  public function unSelectCredit()
  {
    $this->credit = null;
    $this->payments = [];
    $this->credits = Credit::where("id_customer", $this->customerSelected[0]->id)->get();
  }

  public function calculatePayment()
  {
    $this->creditPaymentInfo = DB::select(
      '
      CALL `SP_CALCULATE_NEXT_PAYMENT`(
        @credit_id := :credit_id,
        @fee := :fee,
        @custom_financial_default := :financial_default
      );',
      [
        'credit_id' => $this->credit->id,
        'fee' => $this->credit->fee,
        'financial_default' => -1,
      ]
    );
    $this->fee = $this->creditPaymentInfo[0]->fee;
    $this->customFinancialDefault = $this->creditPaymentInfo[0]->financial_default_amount;
  }

  public function recalculatePaymentFee()
  {
    if(!preg_match('/^(\d*\.)?\d+$/', $this->fee)) {
      return;
    }

    $this->creditPaymentInfo = DB::select(
      '
      CALL `SP_CALCULATE_NEXT_PAYMENT`(
        @credit_id := :credit_id,
        @fee := :fee,
        @custom_financial_default := :financial_default
      );',
      [
        'credit_id' => $this->credit->id,
        'fee' => $this->fee,
        'financial_default' => -1,
      ]
    );
    $this->fee = $this->creditPaymentInfo[0]->fee;
  }

  public function recalculateFinancialDefault()
  {
    if(!preg_match('/^(\d*\.)?\d+$/', $this->customFinancialDefault)) {
      return;
    }

    $this->creditPaymentInfo = DB::select(
      '
      CALL `SP_CALCULATE_NEXT_PAYMENT`(
        @credit_id := :credit_id,
        @fee := :fee,
        @custom_financial_default := :financial_default
      );',
      [
        'credit_id' => $this->credit->id,
        'fee' => $this->fee,
        'financial_default' => $this->customFinancialDefault,
      ]
    );
  }

  public function removeImage()
  {
    $this->paymentCertification = null;
  }
}
