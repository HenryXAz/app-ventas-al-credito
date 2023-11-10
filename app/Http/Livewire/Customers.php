<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
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
      "nit" => "required",
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
    public $alertCustomerInfo = false;
    public $editCustomer = false;
    public $id_customer = 0;
    public $dpi = "";
    public $nit = "";
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
          ->paginate(2);
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


      $this->validate();


      $customer_id = Customer::updateOrCreate(["id" => $this->id_customer],
      [
        "id_user" => Auth::user()->id,
        "dpi" => $this->dpi,
        "nit" => $this->nit,
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



      $this->editCustomer = true;
      $this->toggleModal();
      $this->alertCustomerInfo = true;
      $this->id_customer = $customer_id;
    }

    public function edit(int $id)
    {
      $this->cleanFields();
      $this->editCustomer = true;

      $customer = Customer::findOrFail($id);

      $this->id_customer = $id;
      $this->dpi = $customer->dpi;
      $this->nit = $customer->nit;
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

      $customer = Customer::findOrFail($id);

      if($customer->haveCredits($customer->id)) {
        session()->flash("customer-have-credits", "no se pueden eliminar clientes con créditos creados");
      } else {
        $customer->delete();
      }

      $this->id_customer = 0;
      $this->toggleAlertDelete();

    }


    public function toggleModal()
    {
      if(!$this->editCustomer) {
        $this->cleanFields();
      }
      // ($this->modal)? $this->cleanFields(): true;
      $this->modal = !$this->modal;
      $this->editCustomer = false;
    }

    public function toggleAlertDelete(int $id = 0)
    {
      $this->alertDelete = !$this->alertDelete;
      $this->id_customer = $id;
    }

    public function toggleAlertCustomerInfo(){
      $this->alertCustomerInfo = !$this->alertCustomerInfo;
      // $this->toggleModal();
      $this->cleanFields();
      $this->id_customer = 0;
    }

    public function removeImage()
    {
      $this->photo = null;
      //$this->profileImage = null;
    }

    public function removeImage2()
    {
      // $this->photo2 = null;
      //$this->profileImage = null;
    }

    public function cleanFields()
    {
      $this->id_customer = 0;
      $this->dpi = "";
      $this->nit = "";
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
