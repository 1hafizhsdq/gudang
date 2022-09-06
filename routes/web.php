<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Models\Project;
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
    
    // master supplier
    Route::resource('/supplier', SupplierController::class);
    Route::get('/list-supplier', [SupplierController::class, 'listSupplier'])->name('list-supplier');
    
    // master project
    Route::resource('/project', ProjectController::class);
    Route::get('/list-project', [ProjectController::class, 'listProject'])->name('list-project');
    
    // master barang
    Route::resource('/barang', BarangController::class);
    Route::get('/list-barang', [BarangController::class, 'listBarang'])->name('list-barang');
    Route::post('/del-foto', [BarangController::class, 'delFoto'])->name('del-foto');
    Route::post('/sku-store', [BarangController::class, 'storeSku'])->name('sku-store');
    Route::get('/del-sku/{id}/{barang}', [BarangController::class, 'delSku'])->name('del-sku');
    Route::get('/edit-sku/{id}', [BarangController::class, 'editSku'])->name('edit-sku');
});

Route::middleware(['auth'])->group(function () {
    // master transaksi stok
    Route::get('/tr-stok', [TransaksiController::class, 'index'])->name('tr-stok');
    Route::post('/post-tr-stok', [TransaksiController::class, 'store'])->name('post-tr-stok');
    Route::get('/get-sku/{id}', [TransaksiController::class, 'getSku'])->name('get-sku');
    Route::get('/get-stok-now/{id}', [TransaksiController::class, 'getStok'])->name('get-stok-now');
    Route::post('/post-barang', [TransaksiController::class, 'storeBarang'])->name('post-barang');
    Route::get('/get-form/{status}', [TransaksiController::class, 'getForm'])->name('get-form');
});
