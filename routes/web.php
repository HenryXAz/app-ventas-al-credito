<?php

use App\Http\Livewire\Users;
use App\Http\Livewire\Customers;
use App\Http\Livewire\NewCredits;
use App\Http\Livewire\ShowBalances;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get("/usuarios", Users::class)->name("users");
    Route::get("/clientes", Customers::class)->name("customers");
    Route::get("/nuevo-credito", NewCredits::class)->name("newCredits");
    Route::get("/saldo-clientes", ShowBalances::class)->name("showBalances");
});
