<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Credit;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function credits()
    {
      return $this->belongsTo(Credit::class,"id_credit");
    }

    protected $fillable = [
      "fee",
      "interest",
      "capital",
      "balance",
      "payment_number",
      "payment_date",
      "status",
      "financial_default",
      "id_credit"
    ];
 
}
