<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFGenerator extends Controller
{
  public function pdfEstimate(Request $req)
  {
<<<<<<< Updated upstream
    $pdf = PDF::loadView("livewire.credits.pdf", [
=======

    $pdf = PDF::loadView("livewire.credits.pdf", [
      "nameCustomer" => json_decode($req->nameCustomer),
      "lastNameCustomer" => json_decode($req->lastNameCustomer),
      "dpiCustomer" => json_decode($req->dpiCustomer),
      "amount" => json_decode($req->amount),
      "interest" => json_decode($req->interest),
      "interestType" => json_decode($req->interestType),
>>>>>>> Stashed changes
      "balances" => json_decode($req->balances),
      "currentCapital" => json_decode($req->currentCapital),
      "paymentInterests" => json_decode($req->paymentInterests),
      "fees" => json_decode($req->fees),
      "dates" => json_decode($req->dates),
      "paymentNumber" => json_decode($req->paymentNumber),
    ]);

    return $pdf->stream();
  }
}
