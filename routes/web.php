<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CekStokController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TypeController;
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

// Route::middleware(['auth', 'role:1,2,8'])->group(function () {
//     // dashboard
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });

Route::middleware(['auth', 'role:1'])->group(function () {
    // master kategori
    Route::resource('/kategori', KategoriController::class);
    Route::get('/list-kategori', [KategoriController::class, 'listKategori'])->name('list-kategori');
    
    // master lokasi
    Route::resource('/lokasi', LokasiController::class);
    Route::get('/list-lokasi', [LokasiController::class, 'listLokasi'])->name('list-lokasi');
    
    // master merk
    Route::resource('/merk', MerkController::class);
    Route::get('/list-merk', [MerkController::class, 'listMerk'])->name('list-merk');
    
    // master type
    Route::resource('/type', TypeController::class);
    Route::get('/list-type', [TypeController::class, 'listType'])->name('list-type');
    
    // master satuan
    Route::resource('/satuan', SatuanController::class);
    Route::get('/list-satuan', [SatuanController::class, 'listSatuan'])->name('list-satuan');
    
    // master supplier
    Route::resource('/supplier', SupplierController::class);
    Route::get('/list-supplier', [SupplierController::class, 'listSupplier'])->name('list-supplier');
    
    // master client
    Route::resource('/client', ClientController::class);
    Route::get('/list-client', [ClientController::class, 'listClient'])->name('list-client');
    
    // master project
    Route::resource('/project', ProjectController::class);
    Route::get('/list-project', [ProjectController::class, 'listProject'])->name('list-project');
    
    // master barang
    Route::resource('/barang', BarangController::class);
    Route::post('/del-foto', [BarangController::class, 'delFoto'])->name('del-foto');
    Route::post('/sku-store', [BarangController::class, 'storeSku'])->name('sku-store');
    Route::get('/del-sku/{id}/{barang}', [BarangController::class, 'delSku'])->name('del-sku');
    Route::get('/edit-sku/{id}', [BarangController::class, 'editSku'])->name('edit-sku');
    Route::get('/find-merk', [BarangController::class, 'findMerk'])->name('find-merk');
});

Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/list-barang', [BarangController::class, 'listBarang'])->name('list-barang');
    
    // master transaksi stok
    Route::get('/tr-stok', [TransaksiController::class, 'index'])->name('tr-stok');
    Route::get('/tr-stok-masuk', [TransaksiController::class, 'indexMasuk'])->name('tr-stok-masuk');
    Route::get('/tr-stok-keluar', [TransaksiController::class, 'indexKeluar'])->name('tr-stok-keluar');
    Route::post('/post-tr-stok', [TransaksiController::class, 'store'])->name('post-tr-stok');
    Route::get('/get-sku/{id}', [TransaksiController::class, 'getSku'])->name('get-sku');
    Route::get('/get-stok-now/{id}', [TransaksiController::class, 'getStok'])->name('get-stok-now');
    Route::get('/get-stok-now-by-lokasi/{skuid}/{lokasiid}', [TransaksiController::class, 'getStokByLokasi'])->name('get-stok-now-by-lokasi');
    Route::post('/post-barang', [TransaksiController::class, 'storeBarang'])->name('post-barang');
    Route::get('/get-form/{status}', [TransaksiController::class, 'getForm'])->name('get-form');
    Route::get('/get-project', [TransaksiController::class, 'getProject'])->name('get-project');
    Route::get('/get-type/{idmerk}', [TransaksiController::class, 'getType'])->name('get-type');
    Route::get('/get-barang/{idmerk}/{idtype}', [TransaksiController::class, 'getBarang'])->name('get-barang');

    // cek stok
    Route::get('/cek-stok', [CekStokController::class, 'index'])->name('cek-stok');
    Route::get('/cek-stok-detail/{barang_id}', [CekStokController::class, 'detail'])->name('cek-stok-detail');
    Route::get('/list-sku/{barang_id}', [CekStokController::class, 'listSku'])->name('list-sku');
    Route::get('/list-barang-gudang/{id}', [CekStokController::class, 'listBarang'])->name('list-barang-gudang');

    // stok masuk
    Route::get('/stok-masuk', [StokMasukController::class, 'index'])->name('stok-masuk');
    Route::get('/list-stok-masuk', [StokMasukController::class, 'listMasuk'])->name('list-stok-masuk');
    Route::get('/detail-stok-masuk/{id}', [StokMasukController::class, 'detail'])->name('detail-stok-masuk');
    Route::get('/list-stok-masuk-filter', [StokMasukController::class, 'listMasukFilter'])->name('list-stok-masuk-filter');
    
    // stok keluar
    Route::get('/stok-keluar', [StokKeluarController::class, 'index'])->name('stok-keluar');
    Route::get('/list-stok-keluar', [StokKeluarController::class, 'listKeluar'])->name('list-stok-keluar');
    Route::get('/detail-stok-keluar/{id}', [StokKeluarController::class, 'detail'])->name('detail-stok-keluar');
    Route::post('/suratjalan', [StokKeluarController::class, 'suratjalan'])->name('suratjalan');
    Route::get('/list-stok-keluar-filter', [StokKeluarController::class, 'listKeluarFilter'])->name('list-stok-keluar-filter');
});
