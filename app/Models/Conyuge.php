<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conyuge extends Model
{
    use HasFactory;

    public function customers()
    {
      return $this->belongsTo(Customer::class, "id_customer");
    }

    public $timestamps = false;

    protected $fillable = [
      "id",
      "dpi",
      "name",
      "last_name",
      "id_customer",
    ];
}
