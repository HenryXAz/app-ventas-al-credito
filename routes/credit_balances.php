<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ShowBalances;
use App\Http\Controllers\PDFGenerator;

Route::middleware(["auth:sanctum", config("jetstream.auth_session"), "verified"])
  ->group(function () {
    Route::get("", ShowBalances::class)
      ->name("showBalances");
    Route::post("/factura-pago", [PDFGenerator::class, "pdfInvoice"])->name("pdfInvoice");
    Route::get("/creditos-activos", [PDFGenerator::class, "pdfActiveCredits"])->name("activeCredits");
  });
