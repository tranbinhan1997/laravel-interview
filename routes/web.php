<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('auth.login')->middleware('login');
Route::post('/do-login', [AuthController::class, 'login'])->name('auth.do-login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('authenticate');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories')->middleware('authenticate');
Route::post('/categories/add', [CategoryController::class, 'create'])->name('categories-add')->middleware('authenticate');
Route::get('/products', [ProductController::class, 'index'])->name('products')->middleware('authenticate');
Route::post('/products/add', [ProductController::class, 'create'])->name('products-add')->middleware('authenticate');

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices')->middleware('authenticate');
Route::post('/invoices/add', [InvoiceController::class, 'create'])->name('invoices-add')->middleware('authenticate');
Route::get('/invoices/{id}', [InvoiceController::class, 'edit'])->name('invoices-edit')->middleware('authenticate');
Route::post('/invoices/{id}', [InvoiceController::class, 'update'])->name('invoices-update')->middleware('authenticate');
