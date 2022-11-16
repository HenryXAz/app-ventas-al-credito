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
      return Payment::where([
        ["status", "=", "1"],
        ["id_credit", "=", "$id"]
      ])
        // ->where("id_credit", "=", $id)
        ->first();
    }

    public function currentBalance($id)
    {
      $lastPayment = Payment::where("status", "=", "2")
        ->where("id_credit", "=", $id)
        ->get()
        ->last();

      if(!$lastPayment) {
        return $this->capital;
      } else {
        return $lastPayment->balance;
      }
    }

    public function customer()
    {
      return $this->belongsTo(Customer::class, "id_customer");
    }

    protected $fillable = [
      "id",
      "payment_frequency",
      "capital",
      "balance",
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
