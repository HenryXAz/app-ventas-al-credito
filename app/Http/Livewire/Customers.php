<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class Customers extends Component
{
    public $modal = false;
    public $id_customer = 0;
    public $dpi = "";
    public $name = "";
    public $lastName = "";
    public $personalPhone = "";
    public $homePhone = "";
    public $employmentPhone = "";
    public $companyName = "";
    public $employmentAddress;
    public $homeAddress = "";
    public $facebook = "";
    public $email = "";
    public $photo = "";
    public $nameReference = "";
    public $lastNameReference = "";
    public $emailReference = "";
    public $phoneReference = "";
    public $isMarried;
    public $rent;

    public $customers;


    public function render()
    { 
        $this->customers = Customer::all();
        return view('livewire.customers.customers');
    }

    public function save()
    {
      Customer::updateOrCreate(["id" => $this->id_customer], 
      [
        "id_user" => Auth::user()->id,
        "dpi" => $this->dpi,
        "name" => $this->name,
        "last_name" => $this->lastName,
        "personal_phone" => $this->personalPhone,
        "home_phone" => $this->homePhone,
        "employment_phone" => $this->employmentPhone,
        "home_address" => $this->homeAddress,
        "employment_address" => $this->employmentAddress,
        "email" => $this->email,
        "facebook" => $this->facebook,
        "name_reference" => $this->nameReference,
        "last_name_reference" => $this->lastNameReference,
        "phone_reference" => $this->phoneReference,
        "email_reference" => $this->emailReference,
        "company_name" => $this->companyName,
        "married" => ($this->isMarried === "1")? 1 : 0,
        "rent" => ($this->rent === "1")? 1: 0,
        "photo" => $this->photo
      ]);


     
      //$this->clearFields();
      $this->modal = false;
    }


    public function toggleModal()
    {
      $this->modal = !$this->modal;
    }

    public function cleanFields()
    {
      $this->dpi = "";
      $this->name = "";
      $this->lastName = "";
      $this->personalPhone = "";
      $this->employmentAddress = "";
      $this->homeAddress = ""; 
      $this->employmentPhone = "";
      $this->homePhone = "";
      $this->homeAddress = "";
      $this->nameReference = "";
      $this->lastNameReference = "";
      $this->phoneReference = "";
      $this->emailReference = "";
      $this->facebook = "";
      $this->email = "";
      $this->isMarried = "0";
      $this->rent = "0";
      $this->photo = "";
    }

}
