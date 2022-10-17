<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Customer;

class Credit extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function payments()
    {
      return $this->hasMany(Payment::class, "id_credit", "id");
    }

    public function nextPayment($id)
    {
      return Payment::where("status", "=", "1")
        ->where("id_credit", "=", $id)
        ->first();
    }

    public function customer()
    {
      return $this->belongsTo(Customer::class, "id_customer");
    }

    protected $fillable = [
      "id",
      "payment_frequency",
      "capital",
      "interest_type",
      "interest_rate",
      "car_image",
      "fee",
      "status",
      "id_customer",
      "name_customer",
      "dpi_customer"
    ];
}
