<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Customer;
use App\Models\Payment;
use Carbon\Carbon;
use \Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Support\Facades\DB;


class PDFGenerator extends Controller
{
  public function pdfEstimate(Request $request)
  {
    $pdf = PDF::loadView("livewire.credits.pdf", [
      "customer" => json_decode($request->customer),
      "amount" => json_decode($request->amount),
      "interest" => json_decode($request->interest),
      "payments" => json_decode($request->payments),
      "total_interest" => json_decode($request->total_interest),
      "interest_type" => json_decode($request->interest_type),
    ]);

    return $pdf->stream();
  }

  public function pdfInvoice($customer_id, $payment_id)
  {
    $payment = Payment::where('id', $payment_id)->get();
    $customer = Customer::where('id', $customer_id)->get();

    $pdf = PDF::loadView("livewire.balances.invoice", [
      'customer' => $customer[0], 
      'payment' => $payment[0]]);
      
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
      $credits = Credit::whereIn("id", function ($query) use ($startWeek, $endWeek) {
        $query->select("id_credit")
          ->from("payments")
          ->where("status", "=", "1")
          ->whereNotBetween("payment_date", [$startWeek, $endWeek]);
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

  public function pdfActiveCredits(Request $req)
  {
    $credits = DB::table("credits")
      ->join("customers", "customers.id", "=", "credits.id_customer")
      ->select("credits.capital", "credits.balance", "customers.name" , "customers.last_name" , "customers.personal_phone", "customers.email")
      ->get();

    $pdf = PDF::loadView("livewire.balances.active-credits", ["credits" => $credits]);

    return $pdf->stream();
    
  }

  public function customersInfo(Request $req)
  { 
    $pdf = PDF::loadView("livewire.customers.customers-info", [
      "name" => json_decode($req->name),
      "last_name" => json_decode($req->last_name),
      "dpi" => json_decode($req->dpi),
      "nit" => json_decode($req->nit),
      "personalPhone" => json_decode($req->personalPhone),
      "homePhone" => json_decode($req->homePhone),
      "employmentPhone" => json_decode($req->employmentPhone),
      "companyName" => json_decode($req->companyName),
      "employmentAddress" => json_decode($req->employmentAddress),
      "homeAddress" => json_decode($req->homeAddress),
      "facebook" => json_decode($req->facebook),
      "email" => json_decode($req->email),
      "nameReference" => json_decode($req->nameReference),
      "lastNameReference" => json_decode($req->lastNameReference),
      "phoneReference" => json_decode($req->phoneReference),
      "emailReference" => json_decode($req->emailReference),
      "nameSecondReference" => json_decode($req->nameSecondReference),
      "lastNameSecondReference" => json_decode($req->lastNameSecondReference),
      "phoneSecondReference" => json_decode($req->phoneSecondReference),
      "emailSecondReference" => json_decode($req->emailSecondReference),
      "nameThirdReference" => json_decode($req->nameThirdReference),
      "lastNameThirdReference" => json_decode($req->lastNameThirdReference),
      "phoneThirdReference" => json_decode($req->phoneThirdReference),
      "emailThirdReference" => json_decode($req->emailThirdReference),
      "married" => json_decode($req->married),
      "rent" => json_decode($req->rent),
    ]);

    return $pdf->stream();
  }

}
