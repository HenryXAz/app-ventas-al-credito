<?php
use App\Http\Controllers\PDFGenerator;
use App\Http\Livewire\CustomerReports;
use App\Http\Livewire\Users;
use App\Http\Livewire\Customers;
use App\Http\Livewire\NewCredits;
use App\Http\Livewire\ShowBalances;
use App\Http\Livewire\Profits;
use Illuminate\Support\Facades\Route;

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
      ->name("customers");
    Route::post("/clientes", [PDFGenerator::class, "customers"])->name("customersReport");
    Route::post("/info-cliente", [PDFGenerator::class, "customersInfo"])->name("customersInfo");

    Route::get("/nuevo-credito", NewCredits::class)
      ->name("newCredits");
    Route::post("/estimacion", [PDFGenerator::class, "pdfEstimate"])->name("pdfEstimate");
    
    Route::get("/saldo-clientes", ShowBalances::class)
      ->name("showBalances");
    Route::post("/factura-pago", [PDFGenerator::class, "pdfInvoice"])->name("pdfInvoice");
    Route::get("/creditos-activos",[PDFGenerator::class, "pdfActiveCredits"])->name("activeCredits");
   
    Route::get("/ganancias", Profits::class)
      ->name("profits")
      ->middleware("admin");

    Route::get("/reporte-clientes", CustomerReports::class)
      ->name("customerReports")
      ->middleware("admin");

    Route::post("/reporte-clientes", [PDFGenerator::class, "pdfCustomers"])->name("pdfCustomers");

});