<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Customers extends Component
{
    public $modal = false;
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


    public function render()
    {
        return view('livewire.customers.customers');
    }

    public function save()
    {


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
