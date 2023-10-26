<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Users;

Route::middleware(["auth:sanctum", config("jetstream.auth_session"), "verified"])
  ->group(function () {
    Route::get("", Users::class)
      ->name("users")
      ->middleware("admin");
  });
