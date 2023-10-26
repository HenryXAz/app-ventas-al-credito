<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Customers;
use App\Http\Livewire\CustomerReports;
use App\Http\Controllers\PDFGenerator;

Route::middleware(["auth:sanctum", config("jetstream.auth_session", "verified")])
  ->group(function () {
    Route::get("", Customers::class)
      ->name("customers");
    Route::post("", [PDFGenerator::class, "customers"])->name("customersReport");
    Route::post("/info-cliente", [PDFGenerator::class, "customersInfo"])->name("customersInfo");

    Route::get("/reporte-clientes", CustomerReports::class)
      ->name("customerReports")
      ->middleware("admin");

    Route::post("/reporte-clientes", [PDFGenerator::class, "pdfCustomers"])->name("pdfCustomers");
  });
