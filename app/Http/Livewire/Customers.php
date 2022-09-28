<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;


class Customers extends Component
{
    use WithFileUploads;


    protected $rules = [
      
      "dpi" => "required|regex:/^[0-9]{13}$/",
      "name" => "required",
      "lastName" => "required|",
      "personalPhone" => "required|regex:/^[0-9]{8}$/",
      "homePhone" => "required|regex:/^[0-9]{8}$/",
      "employmentPhone" => "required|regex:/^[0-9]{8}$/",
      "companyName" => "required",
      "employmentAddress" => "required",
      "homeAddress" => "required",
      "facebook" => "required",
      "email" => "required|email",
      "nameReference" => "required",
      "lastNameReference" => "required",
      "emailReference" => "required|email",
      "phoneReference" => "required|regex:/^[0-9]{8}$/",
    ];

    protected $messages = [
      "dpi.regex" => "dpi consta de 13 dígitos",
      "personalPhone.regex" => "No. de teléfono es de 8 dígitos",
      "homePhone.regex" => "No. de teléfono es de 8 dígitos ", 
      "employmentPhone.regex" => "No. de teléfono es de 8 dígitos",
      "phoneReference.regex" => "No. de teléfono es de 8 dígitos ",
    ];

    public $modal = false;
    public $alertDelete = false;
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
    public $photo = null;
    public $profileImage;
    public $nameReference = "";
    public $lastNameReference = "";
    public $emailReference = "";
    public $phoneReference = "";
    public $isMarried;
    public $rent;

    public $customers;
    public $search = "";

    public function updated($propertyName)
    { 
      $this->validateOnly($propertyName);
    }

    public function render()
    { 
        $search = "%" . $this->search . "%";
        $this->customers = Customer::where("name", "like" , $search)
          ->orWhere("last_name", "like", $search)
          ->orWhere("dpi", "like", $search)
          ->get();
        return view('livewire.customers.customers');
    }

    public function save()
    {
      
      $imagePath = "";

      if($this->photo !== null)
      {
        $imagePath = $this->photo->store("customerPhotos", "public"); 
      }
      else if(!$this->photo && !$this->profileImage) {
        $imagePath = "customerPhotos/defaultPhoto.png";
      } else {
        $imagePath = $this->profileImage;
      }

      $this->validate();

      

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
        "married" => ($this->isMarried)? 1 : 0,
        "rent" => ($this->rent)? 1: 0,
        "photo" => $imagePath,
      ]);

   
      $this->toggleModal();
      $this->cleanFields();
    }

    public function edit(int $id)
    {
      $customer = Customer::findOrFail($id);

      $this->id_customer = $id;
      $this->dpi = $customer->dpi;
      $this->name = $customer->name;
      $this->lastName = $customer->last_name;
      $this->personalPhone = $customer->personal_phone;
      $this->employmentAddress = $customer->employment_address;
      $this->homeAddress = $customer->home_address; 
      $this->employmentPhone = $customer->employment_phone;
      $this->homePhone = $customer->home_phone;
      $this->homeAddress = $customer->home_address;
      $this->nameReference = $customer->name_reference;
      $this->lastNameReference = $customer->last_name_reference;
      $this->phoneReference = $customer->phone_reference;
      $this->emailReference = $customer->email_reference;
      $this->facebook = $customer->facebook;
      $this->email = $customer->email;
      $this->companyName = $customer->company_name;
      $this->isMarried = ($customer->married === 1)? 1 : 0;
      $this->rent = ($customer->rent === 1)? 1 : 0;
      $this->profileImage = $customer->photo;

      $this->toggleModal();

    }

    public function delete(int $id)
    {
      Customer::find($id)->delete();
      
      $this->id = 0;
      $this->toggleAlertDelete();
      
    }


    public function toggleModal()
    {
      ($this->modal)? $this->cleanFields(): true;
      $this->modal = !$this->modal;
    }

    public function toggleAlertDelete(int $id = 0)
    {
      $this->alertDelete = !$this->alertDelete;
      $this->id_customer = $id;
    }

    public function removeImage()
    {
      $this->photo = null;
      //$this->profileImage = null;
    }

    public function cleanFields()
    {
      $this->id_customer = 0;
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
      $this->companyName = "";
      $this->isMarried = "";
      $this->rent = "";
      $this->photo = null;
      $this->profileImage = null;
    }

}
