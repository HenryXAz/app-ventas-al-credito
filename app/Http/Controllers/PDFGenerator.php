<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFGenerator extends Controller
{
  public function pdfEstimate(Request $req)
  {
    $pdf = PDF::loadView("livewire.credits.pdf", [
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
