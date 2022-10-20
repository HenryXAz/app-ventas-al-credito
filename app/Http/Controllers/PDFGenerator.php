<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Customer;
use Carbon\Carbon;
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
    $pdf = PDF::loadView("livewire.balances.invoice", [
      "nameCustomer" => json_decode($req->nameCustomer),
      "lastNameCustomer" => json_decode($req->lastNameCustomer),
      "dpiCustomer" => json_decode($req->dpiCustomer),
      "paymentNumber" => json_decode($req->paymentNumber),
      "fee" => json_decode($req->fee),
      "paymentDate" => json_decode($req->paymentDate),
      "paymentDay" => json_decode($req->paymentDay),
      "methodPayment" => json_decode($req->method_payment),
      "financialDefault" => json_decode($req->financialDefault),
      "receivedBy" => json_decode($req->receivedBy),
    ]);
    $pdf->set_paper("21.59 27.94", "landscape");
    return $pdf->stream();
  }

  public function pdfCustomers(Request $req)
  {
    $date = Carbon::today("America/Guatemala");

    $startWeek = $date->startOfWeek()->toDateString();
    $endWeek = $date->endOfWeek()->toDateString();

    $credits = [];

    if (json_decode($req->report ) === "1") {
      $credits = Credit::whereIn("id", function ($query) use ($startWeek, $endWeek) {
        $query->select("id_credit")
          ->from("payments")
          ->where("status", "=", "1")
          ->whereBetween("payment_date", [$startWeek, $endWeek]);
      })->get();
      
    } else if (json_decode($req->report ) === "2") {
      $credits = Credit::whereNotIn("id", function ($query) use ($startWeek, $endWeek) {
        $query->select("id_credit")
          ->from("payments")
          ->where("status", "=", "1")
          ->whereBetween("payment_date", [$startWeek, $endWeek]);
      })->get();
    } else if (json_decode($req->report)  === "3") {
      $credits = Credit::whereIn("id", function ($query) use ($startWeek, $endWeek) {
        $query->select("id_credit")
          ->from("payments")
          ->where("status", "=", "1")
          ->where("payment_date", "<", date("Y-m-d"));
      })->get();
    }

    $pdf = PDF::loadView("livewire.customer-reports.pdf-customers", [
      "credits" => $credits,
      "report" => json_decode($req->report),
      "startWeek" => $startWeek,
      "endWeek" => $endWeek,
    ]);
    
    return $pdf->stream();
    
  }

  public function customers(Request $req)
  {
    $customers = Customer::all();

    $pdf = PDF::loadView("livewire.customers.pdf-customers", [
      "customers" => $customers,
    ]);

    return $pdf->stream();
  }

}
