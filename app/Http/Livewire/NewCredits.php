<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use App\Models\Customer;

use Livewire\Component;

class NewCredits extends Component
{
  use WithFileUploads;

    public $search = "";

    public $customers;
    public $customerSelected = false;
    public $dpiCustomer;
    public $nameCustomer;
    public $lastNameCustomer;
    public $idCustomer;

    public $amount;
    public $share;
    public $interestType = "1";
    public $interest;
    public $paymentFrequency = "1";
    public $paymentDate;
    public $carPhoto;


    protected $rules = [
      "amount" => "required|regex:/^(\d*\.)?\d+$/",
      "share" => "required|regex:/^(\d*\.)?\d+$/",
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
      $this->validate();
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
      $this->share = "";
      $this->interestType = "1";
      $this->interest = "";
      $this->paymentFrequency = "1";
      $this->paymentDate = "";
      $this->carPhoto = "";
      $this->search = "";
    }
}
