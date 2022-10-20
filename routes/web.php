<?php
use App\Http\Controllers\PDFGenerator;
use App\Http\Livewire\CustomerReports;
use App\Http\Livewire\Users;
use App\Http\Livewire\Customers;
use App\Http\Livewire\NewCredits;
use App\Http\Livewire\ShowBalances;
use App\Http\Livewire\Profits;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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


    Route::get("/usuarios", Users::class)
      ->name("users")
      ->middleware("admin");

    Route::get("/clientes", Customers::class)
      ->name("customers")
      ->middleware("seller");
    Route::post("/clientes", [PDFGenerator::class, "customers"])->name("customersReport");

    Route::get("/nuevo-credito", NewCredits::class)
      ->name("newCredits")
      ->middleware("seller");
    Route::post("/estimacion", [PDFGenerator::class, "pdfEstimate"])->name("pdfEstimate");
    
    Route::get("/saldo-clientes", ShowBalances::class)
      ->name("showBalances")
      ->middleware("secretary");
    Route::post("/factura-pago", [PDFGenerator::class, "pdfInvoice"])->name("pdfInvoice");
   
    Route::get("/ganancias", Profits::class)
      ->name("profits")
      ->middleware("admin");

    Route::get("/reporte-clientes", CustomerReports::class)
      ->name("customerReports")
      ->middleware("secretary");

    Route::post("/reporte-clientes", [PDFGenerator::class, "pdfCustomers"])->name("pdfCustomers");

});