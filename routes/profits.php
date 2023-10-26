<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Profits;

Route::middleware(["auth:sanctum", config("jetstream.auth_session", "verified")])
  ->group(function () {
    Route::get("", Profits::class)
      ->name("profits")
      ->middleware("admin");
  });