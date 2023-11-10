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
        // Relación uno a muchos con Payment
        return $this->hasMany(Payment::class, "id_credit", "id");
    }

    public function nextPayment()
    {
        return $this->hasOne(Payment::class, "id_credit")
                    ->where('status', '1')
                    ->orderBy('payment_date', 'asc');
    }
    
    
    public function futurePayments($endDate = null)
    {
        $endDate = $endDate ?: now();
        return $this->hasMany(Payment::class, "id_credit")
                    ->where('status', '1') 
                    ->where('payment_date', '>', $endDate) 
                    ->orderBy('payment_date', 'asc');
    }

    

    public function currentBalance()
    {
        $lastPayment = $this->payments()
                            ->where("status", "2") 
                            ->latest('payment_date') 
                            ->first();

        return $lastPayment ? $lastPayment->balance : $this->capital;
    }

    public function customer()
    {
        // Relación uno a uno inversa con Customer
        return $this->belongsTo(Customer::class, "id_customer");
    }

    protected $fillable = [
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