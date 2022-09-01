<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use Illuminate\Support\Facades\Auth;
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
    return view('login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/auth-login', [LoginController::class, 'loginApi'])->name('auth-login');

Route::middleware(['auth', 'role:1,2,8'])->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:1'])->group(function () {
    // master kategori
    Route::resource('/kategori', KategoriController::class);
    Route::get('/list-kategori', [KategoriController::class, 'listKategori'])->name('list-kategori');
    
    // master satuan
    Route::resource('/satuan', SatuanController::class);
    Route::get('/list-satuan', [SatuanController::class, 'listSatuan'])->name('list-satuan');
});
