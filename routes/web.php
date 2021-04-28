<?php

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

Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get("/clients", [\App\Http\Controllers\CustomerController::class, "index"])->name("clients.index");
Route::get("/client/{client}", [\App\Http\Controllers\CustomerController::class, "show"])->name("clients.show");
Route::get("/client/{client}/invoice", [\App\Http\Controllers\ClientInvoiceController::class, 'show'])->name("clients.invoices.show");
//Route::view("/client", "clients.show")->name("clients.show");


require __DIR__ . '/auth.php';
