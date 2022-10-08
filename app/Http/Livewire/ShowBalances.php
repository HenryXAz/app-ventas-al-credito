<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;
use App\Models\Credit;
use App\Models\Payment;

class ShowBalances extends Component
{

    use WithPagination;

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

      // Filter credits of customer
      $this->credits = Credit::where("id_customer", "=", $id)->get();
      $this->transformCredits();

      return view('livewire.balances.show-balances');
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
        $this->payments = Payment::where("id_credit", "=", $id)->get();
        $this->transformCredits();

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

}
