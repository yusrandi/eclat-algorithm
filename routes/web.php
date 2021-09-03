<?php

use App\Http\Livewire\Sale\Create;
use App\Http\Livewire\Sale\Index;
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

Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);
    Route::get('/sales', [App\Http\Controllers\SaleController::class, 'index']);
    Route::get('/sales/create', [App\Http\Controllers\SaleController::class, 'create']);
    Route::get('/perhitungan', [App\Http\Controllers\PerhitunganController::class, 'index']);
    Route::get('/invoice', [App\Http\Controllers\InvoiceController::class, 'index']);
    Route::get('/invoice/submit', [App\Http\Controllers\InvoiceController::class, 'submit']);
});