<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\NewCredits;
use App\Http\Controllers\PDFGenerator;

Route::middleware(["auth:sanctum", config("jetstream.auth_session"), "verified"])
  ->group(function () {
    Route::get("/nuevo", NewCredits::class)
      ->name("newCredits");
    Route::post("/estimacion", [PDFGenerator::class, "pdfEstimate"])->name("pdfEstimate");
  });
