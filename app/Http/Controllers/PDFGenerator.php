<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFGenerator extends Controller
{
  public function pdfEstimate(Request $req)
  {

   $pdf = PDF::loadView("livewire.credits.pdf", [
      "nameCustomer" => json_decode($req->nameCustomer),
      "lastNameCustomer" => json_decode($req->lastNameCustomer),
      "dpiCustomer" => json_decode($req->dpiCustomer),
      "amount" => json_decode($req->amount),
      "interest" => json_decode($req->interest),
      "interestType" => json_decode($req->interestType),

      "balances" => json_decode($req->balances),
      "currentCapital" => json_decode($req->currentCapital),
      "paymentInterests" => json_decode($req->paymentInterests),
      "fees" => json_decode($req->fees),
      "dates" => json_decode($req->dates),
      "paymentNumber" => json_decode($req->paymentNumber),
    ]);

    return $pdf->stream();
  }

  public function pdfInvoice(Request $req)
  {
    $pdf = PDF::loadView("livewire.balances.invoice");
    $pdf->set_paper("21.59 27.94", "landscape");
    return $pdf->stream();
  }

}
