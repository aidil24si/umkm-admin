<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailPesananController;

//Dashboard Admin Routes
Route::resource('dashboard', DashboardController::class)->middleware('checkislogin');

//route mengarah ke halaman profile pengembang
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');


// Auth Admin Routes
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
Route::get('/register', [AuthController::class, 'regis'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('admin.register');

// Routes tambahan untuk foto umkm
Route::prefix('umkm/{umkm}')->group(function () {
    Route::post('/upload-foto', [UmkmController::class, 'uploadFoto'])->name('umkm.uploadFoto');
    Route::delete('/foto/{foto}', [UmkmController::class, 'hapusFoto'])->name('umkm.hapusFoto');
    Route::get('/foto/{foto}/download', [UmkmController::class, 'downloadFoto'])->name('umkm.downloadFoto');
    Route::post('/foto/{foto}/caption', [UmkmController::class, 'updateCaption'])->name('umkm.updateCaption');
});

//route auth logout user
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

//route middleware checkrole Admin
Route::middleware(['checkislogin', 'checkrole:Admin'])->group(function () {
    Route::resource('umkm', UmkmController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('pesanan', PesananController::class);
    Route::resource('lokasi', LokasiController::class);
    Route::resource('ulasan', UlasanController::class);
    Route::resource('detail', DetailPesananController::class);
});

//upload foto produk
Route::post('produk/{id}/upload-foto', [ProdukController::class, 'uploadFoto'])->name('produk.uploadFoto');
Route::delete('produk/{produkId}/foto/{fotoId}', [ProdukController::class, 'hapusFoto'])->name('produk.hapusFoto');
Route::get('produk/{produkId}/foto/{fotoId}/download', [ProdukController::class, 'downloadFoto'])->name('produk.downloadFoto');
Route::put('produk/{produkId}/foto/{fotoId}/caption', [ProdukController::class, 'updateCaption'])->name('produk.updateCaption');


//route middleware checkrole Super admin
Route::middleware(['checkislogin', 'checkrole:Super Admin'])->group(function () {
    Route::resource('user', UsersController::class);
});

// Routes untuk upload dan manajemen foto
Route::post('/pesanan/{id}/upload-foto', [PesananController::class, 'uploadFoto'])->name('pesanan.uploadFoto');
Route::delete('/pesanan/{pesananId}/hapus-foto/{fotoId}', [PesananController::class, 'hapusFoto'])->name('pesanan.hapusFoto');
Route::get('/pesanan/{pesananId}/download-foto/{fotoId}', [PesananController::class, 'downloadFoto'])->name('pesanan.downloadFoto');
Route::post('/pesanan/{pesananId}/update-caption/{fotoId}', [PesananController::class, 'updateCaption'])->name('pesanan.updateCaption');




