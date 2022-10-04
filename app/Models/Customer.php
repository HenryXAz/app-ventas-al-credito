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
      "email_reference"
    ];
}
