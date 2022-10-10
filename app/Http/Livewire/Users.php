<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    public const ADMIN = "1";
    public const SELLER = "2";
    public const SECRETARY = "3";

    public $modal = false;
    public $alertDelete = false;
    public $search = "";
    public $edited = false;

    public $user_id;
    public $name = "";
    public $email = "";
    public $role = "1";
    public $password = "";
    public $confirmPassword = "";

    public $authenticatedUserEmail = "";

    protected $rules = [
      "name" => "required",
      "email" => "required | email",
      "password" => "required | min:8",
      "confirmPassword" => "required | min:8 | same:password",
    ];
    
    protected $messages = [
      "name.required" => "el nombre es obligatorio",
      "email.required" => "el email es obligatorio",
      "email.email" => "email no válido",
      "password.required" => "la contraseña es obligatoria",
      "password.min" => "la contraseña debe de tener un mínimo de 8 caracteres",
      "confirmPassword.required" => "debe de confirmar su contraseña",
      "confirmPassword.min" => "la contraseña debe de tener un mínimo de 8 caracteres",
      "confirmPassword.same" => "no coincide con la contraseña",
    ];

    public function mount()
    {
      $this->authenticatedUserEmail = Auth::user()->email;
    }

    public function updated($property)
    { 
      $this->validateOnly($property);
    } 

    public function render()
    {
      $search = "%" . $this->search . "%";

      $users = User::where("name", "like", $search)
      ->orWhere("email", "like", $search)
      ->get();
      return view('livewire.users.users', ["users" => $users]);
    }


    public function save()
    {
      $this->validate();

      $emailExists = User::where("email", "=", $this->email)->first();

      if($emailExists && !$this->edited){
        session()->flash("emailExists", "La cuenta de email ya existe en el sistema");
      } else {

        if($this->edited && $this->password === "@@@@@111") {
          User::updateOrCreate(["id" => $this->user_id], [
            "name" => $this->name,
            "email" => $this->email,
            "role" => $this->role,
          ]);
        } else {
          User::updateOrCreate(["id" => $this->user_id], [
            "name" => $this->name,
            "email" => $this->email,
            "role" => $this->role,
            "password" => Hash::make($this->password),
          ]);
        }

        $this->cleanFields();
        $this->modal = false;
        $this->edited = false;
      }

    }

    public function edit(int $id)
    {
      $user = User::findOrFail($id);

      $this->user_id = $user->id;
      $this->name = $user->name;
      $this->email = $user->email;
      $this->role = $user->role;
      $this->password = "@@@@@111";
      $this->confirmPassword = "@@@@@111";

      $this->edited = true;
      $this->modal = !$this->modal;
      
    }

    public function delete(int $id)
    {
      $user = User::findOrFail($id);

      $user->delete();
      $this->user_id = 0;
      $this->alertDelete = !$this->alertDelete;
    }

    public function confirmDelete(int $id = 0)
    {
      $this->alertDelete = !$this->alertDelete;
      $this->user_id = $id;
    }

    public function cleanFields()
    {
      $this->user_id = 0;
      $this->name = "";
      $this->password = "";
      $this->email = "";
      $this->confirmPassword = "";
      $this->role = "1";

      $this->modal = false;
    }
}
