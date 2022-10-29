<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;
use App\Models\Credit;
use App\Models\Payment;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class ShowBalances extends Component
{

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = "tailwind";
    public $search = "";

    // Seleccionar cliente
    public $customerSelected = false;
    public $dpiCustomer;
    public $nameCustomer;
    public $lastNameCustomer;
    public $idCustomer;

    // Listar creditos del cliente
    public $credits = [];

    // Seleccionar cliente
    public $creditSelected = false;
    public $idCredit;

    // Listar pagos del credito
    public $payments = [];
    public $pendientePagar = 0;
    public $subBalance = [];
    public $paymentStatus = "3";
    public $feesNumber;
    public $methodPayment = "1";
    public $certificationPayment;
    public $payment;
    public $certificationPaymentSelected = false;
    public $financialDefault = 0;
    public $certificationFinancialDefault;
    public $financialDefaultMethod = "1";

    //modal para confirmar pago
    public $confirmPayment = false;

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
            $this->customerSelected = false;
            $this->creditSelected = false;
        }

        return view('livewire.balances.show-balances');
    }

    public function customerClicked($name, $lastName, $dpi, $id)
    {
      $this->customerSelected = true;
      $this->creditSelected = false;
      $this->nameCustomer = $name;
      $this->lastNameCustomer = $lastName;
      $this->dpiCustomer = $dpi;
      $this->idCustomer = $id;
      $this->search = "";

      $customer = Customer::findOrFail($id);


      // Filter credits of customer
      // $this->credits = Credit::where("id_customer", "=", $id)->get();
      //$this->credits = ;

      $this->credits = $customer->credits;
      $this->outstandingBalance();
      $this->transformCredits();

      // return view('livewire.balances.show-balances');
    }

    // calcular saldo pendiente

    public function outstandingBalance()
    { 

      foreach($this->credits as $credit) {

        $payments = $credit->payments->where("status", "=", "1")->pluck("capital")->toArray();

        $this->subBalance[$credit->id] = array_reduce($payments, function($previus, $current){
          return $previus + $current;
        }, 0);

      }
    }

    public function unSelectedCustomer()
    {
      $this->customerSelected = false;
      $this->nameCustomer = "";
      $this->lastNameCustomer = "";
      $this->dpiCustomer = "";
      $this->idCustomer = "";
      $this->credits = [];
      $this->creditSelected = false;
      $this->idCredit = "";
      $this->payments = [];
    }

    function transformCredits()
    {
        foreach ($this->credits as $credit)
        {
           if($credit->interest_type == 1) {
              $credit->interest_type = 'Fijo';
           } else {
              $credit->interest_type = 'Porcentual';
           }
           switch($credit->payment_frequency){
              case (1);
                  $credit->payment_frequency = 'Mensual';
              break;
              case (2);
                  $credit->payment_frequency = 'Semanal';
              break;
              case (3);
                  $credit->payment_frequency = 'Quincenal';
              break;
          }
        }
    }

    public function creditClicked($id)
    {
        $this->creditSelected = true;
        $this->idCredit = $id;
        $this->pendientePagar = 0;

        // Filter payments of credit
        $this->credits = Credit::where("id", "=", $id)->get();

        $paymentStatus = $this->paymentStatus;

        if($paymentStatus === "3") {
          $this->payments = Payment::where("id_credit", "=", $id)
          ->get();
        } else {
          $this->payments = Payment::where("id_credit", "=", $id)
            ->where("status", "=", $paymentStatus)
            ->get();
        }

        $this->feesNumber = $this->payments;

        // dd($paymentStatus);
        $this->transformCredits();
        $this->outstandingBalance();

        // Sumar totos los pagos que aun estan pendientes por pagar
        // payment status: 1: Pendiente Pago  2: Pagado
        foreach ($this->payments as $payment)
        {
           if($payment->status == 1 /* Pendiente Pago*/)
           {
             $this->pendientePagar = $this->pendientePagar + $payment->capital;
           }
        }
    }



    public function toPay()
    {
      $imagePath = "";
      $financialDefaultImagePath = "";

      if($this->certificationPayment) {
        // $imagePath = $this->certificationPayment->store("payments", "public");
      }

      if($this->certificationFinancialDefault) {
        // $financialDefaultImagePath = $this->certificationFinancialDefault->store("financialDefault", "public");
      }


      $this->payment->status = "2";
      $this->payment->certification_payment = $imagePath;
      $this->payment->method_payment = ($this->methodPayment === "1")? "1" : "2";
      $this->payment->certification_financial_default = $financialDefaultImagePath;
      $this->payment->financial_default = $this->financialDefault;
      $this->payment->financial_default_method = ($this->financialDefaultMethod === "1")? "1" : "2";
      $this->payment->payment_day = \Carbon\Carbon::today("America/Guatemala")->format("Y-m-d");
      $this->payment->received_by = Auth::user()->name;

      $this->payment->save();

      session()->flash("message", "cuota cancelada correctamente");
    }

    public function confirmPayment($id)
    {
      $this->customerSelected = false;
      $this->creditSelected = false;
      $this->confirmPayment = true;

      $this->payment = Payment::findOrFail($id);
    }

    public function cancelPayment()
    {
      $this->confirmPayment = !$this->confirmPayment;
      $this->customerSelected = true;
      $this->creditSelected = true;
    
      $this->creditClicked($this->payment->credits->id);
    }
}
