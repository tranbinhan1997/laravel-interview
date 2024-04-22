<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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
