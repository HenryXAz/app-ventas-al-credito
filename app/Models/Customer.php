<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function users()
    {
      return $this->belongsTo(User::class, "id_user");
    }

    public function credits()
    {
      return $this->hasMany(Credit::class, "id_customer", "id");
    }

    public function conyuge()
    {
      return $this->hasMany(Conyuge::class, "id_customer", "id");
    }

    public function haveCredits($id)
    {
        return(Customer::where("id", "=", $id))
          ->whereIn("id", function ($query){
            $query->select("id_customer")->from("credits");
          })->exists();
    }

    public $timestamps = false;

    protected $fillable = [
      "id",
      "dpi",
      "name",
      "last_name",
      "personal_phone",
      "home_phone",
      "employment_phone",
      "home_address",
      "employment_address",
      "company_name",
      "id_user",
      "photo",
      "facebook",
      "email",
      "married",
      "rent",
      "name_reference",
      "last_name_reference",
      "phone_reference",
      "email_reference",
      "name_second_reference",
      "lastname_second_reference",
      "email_second_reference",
      "phone_second_reference",
      "name_third_reference",
      "last_name_third_reference",
      "email_third_reference",
      "phone_third_reference",
      "house_photo",
    ];
}
