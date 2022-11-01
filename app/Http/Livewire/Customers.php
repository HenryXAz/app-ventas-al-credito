<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Conyuge;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithFileUploads;
    use WithPagination;


    protected $paginationTheme = "tailwind";

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
    public $nameSecondReference = "";
    public $lastNameSecondReference = "";
    public $emailSecondReference = "";
    public $phoneSecondReference = "";
    public $nameThirdReference = "";
    public $lastNameThirdReference = "";
    public $emailThirdReference = "";
    public $phoneThirdReference = "";
    public $isMarried;
    public $rent;

    // public $customers;
    public $search = "";

    // Conyuge
    public $id_conyuge = 0;
    public $dpi_conyuge = "";
    public $name_conyuge = "";
    public $lastName_conyuge = "";
    public $photo2 = null;
    public $profileImage2;

    public function updated($propertyName)
    {
      $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
      $this->resetPage();
    }

    public function render()
    {
        $search = "%" . $this->search . "%";
        $customers = Customer::where("name", "like" , $search)
          ->orWhere("last_name", "like", $search)
          ->orWhere("dpi", "like", $search)
          ->paginate(10);
        return view('livewire.customers.customers', ["customers" => $customers]);
    }


    public function save()
    {

      $imagePath = "";
      $imagePath2 = "";

      if($this->photo !== null)
      {
        $currentImagePath = public_path("storage/{$this->profileImage}");
        shell_exec("rm {$currentImagePath}");

        $imagePath = $this->photo->store("customerPhotos", "public");
      }
      else if(!$this->photo && !$this->profileImage) {
        $imagePath = "customerPhotos/defaultPhoto.png";
      } else {
        $imagePath = $this->profileImage;
      }

      if($this->photo2 !== null)
      {
        $currentImagePath2 = public_path("storage/{$this->profileImage2}");
        shell_exec("rm {$currentImagePath2}");

        $imagePath2 = $this->photo2->store("customerHousePhoto", "public");
      }
      else if(!$this->photo2 && !$this->profileImage2) {
        $imagePath2 = "customerPhotos/defaultPhoto.png";
      } else {
        $imagePath2 = $this->profileImage2;
      }

      $this->validate();


      $customer_id = Customer::updateOrCreate(["id" => $this->id_customer],
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
        "name_second_reference" => $this->nameSecondReference,
        "lastname_second_reference" => $this->lastNameSecondReference,
        "email_second_reference" => $this->emailSecondReference,
        "phone_second_reference" => $this->phoneSecondReference,
        "name_third_reference" => $this->nameThirdReference,
        "last_name_third_reference" => $this->lastNameThirdReference,
        "email_third_reference" => $this->emailThirdReference,
        "phone_third_reference" => $this->phoneThirdReference,
        "married" => ($this->isMarried)? 1 : 0,
        "rent" => ($this->rent)? 1: 0,
        "photo" => $imagePath,
        "house_photo" => $imagePath2,
      ])->id;

      if ($this->isMarried) {
        
        Conyuge::updateOrCreate(["id" => $this->id_conyuge],
        [
          "id_customer" => $customer_id,
          "dpi" => $this->dpi,
          "name" => $this->name_conyuge,
          "last_name" => $this->lastName_conyuge,
        ]);
      }

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
      $this->profileImage2 = $customer->house_photo;

      if($this->isMarried === 1) {
        $conyuge = $customer->conyuge()->first();
        $this->id_conyuge = $conyuge->id;
        $this->dpi_conyuge = $conyuge->dpi;
        $this->name_conyuge = $conyuge->name;
        $this->lastName_conyuge = $conyuge->last_name;
      }

      $this->toggleModal();

    }

    public function delete(int $id)
    {

      $customer = Customer::findOrFail($id);

      if($customer->haveCredits($customer->id)) {
        session()->flash("customer-have-credits", "no se pueden eliminar clientes con créditos creados");
      } else {
        $customer->delete();
      }

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

    public function removeImage2()
    {
      $this->photo2 = null;
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
      $this->photo2 = null;
      $this->profileImage2 = null;
      $this->dpi_conyuge = "";
      $this->name_conyuge = "";
      $this->lastName_conyuge = "";
      $this->nameSecondReference = "";
      $this->lastNameSecondReference = "";
      $this->emailSecondReference = "";
      $this->phoneSecondReference = "";
      $this->nameThirdReference = "";
      $this->lastNameThirdReference = "";
      $this->emailThirdReference = "";
      $this->phoneThirdReference = "";
      
    }

}
