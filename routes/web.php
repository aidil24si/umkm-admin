<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\UsersAdminController;
use App\Http\Controllers\WargaAdminController;
use App\Http\Controllers\ProyekAdminController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\KontraktorAdminController;
use App\Http\Controllers\LokasiProyekAdminController;
use App\Http\Controllers\ProgresProyekAdminController;
use App\Http\Controllers\TahapanProyekAdminController;

//Dashboard Admin Routes
Route::resource('dashboard', DashboardAdminController::class)->middleware('checkislogin');

//route mengarah ke halaman profile pengembang
Route::get('/profile', [ProfileAdminController::class, 'index'])->name('profile');


// Auth Admin Routes
Route::get('/', [AuthAdminController::class, 'index'])->name('login');
Route::post('/login', [AuthAdminController::class, 'login'])->name('admin.login');
Route::get('/register', [AuthAdminController::class, 'regis'])->name('register');
Route::post('/register', [AuthAdminController::class, 'register'])->name('admin.register');

// Routes tambahan untuk dokumen proyek
Route::prefix('proyek/{proyek}')->group(function () {
    Route::post('/upload-dokumen', [ProyekAdminController::class, 'uploadDokumen'])->name('proyek.uploadDokumen');
    Route::delete('/dokumen/{dokumen}', [ProyekAdminController::class, 'hapusDokumen'])->name('proyek.hapusDokumen');
    Route::get('/dokumen/{dokumen}/download', [ProyekAdminController::class, 'downloadDokumen'])->name('proyek.downloadDokumen');
    Route::post('/dokumen/{dokumen}/caption', [ProyekAdminController::class, 'updateCaption'])->name('proyek.updateCaption');
});

//route auth logout user
Route::get('logout', [AuthAdminController::class, 'logout'])->name('auth.logout');

//route middleware checkrole Admin
Route::middleware(['checkislogin', 'checkrole:Admin'])->group(function () {
    Route::resource('proyek', ProyekAdminController::class);
    Route::resource('tahapan', TahapanProyekAdminController::class);
    Route::resource('warga', WargaAdminController::class);
    Route::resource('progres', ProgresProyekAdminController::class);
    Route::resource('lokasi', LokasiProyekAdminController::class);
    Route::resource('kontraktor', KontraktorAdminController::class);
});


//route middleware checkrole Super admin
Route::middleware(['checkislogin', 'checkrole:Super Admin'])->group(function () {
    Route::resource('user', UsersAdminController::class);
});

// Routes untuk upload dan manajemen foto
Route::post('/progres-proyek/{id}/upload-foto', [ProgresProyekAdminController::class, 'uploadFoto'])->name('progres-proyek.uploadFoto');
Route::delete('/progres-proyek/{progresId}/hapus-foto/{fotoId}', [ProgresProyekAdminController::class, 'hapusFoto'])->name('progres-proyek.hapusFoto');
Route::get('/progres-proyek/{progresId}/download-foto/{fotoId}', [ProgresProyekAdminController::class, 'downloadFoto'])->name('progres-proyek.downloadFoto');
Route::post('/progres-proyek/{progresId}/update-caption/{fotoId}', [ProgresProyekAdminController::class, 'updateCaption'])->name('progres-proyek.updateCaption');

// Routes untuk upload dan manajemen dokumen/foto lokasi proyek
Route::post('/lokasi-proyek/{id}/upload-dokumen', [LokasiProyekAdminController::class, 'uploadDokumen'])->name('lokasi-proyek.uploadDokumen');
Route::delete('/lokasi-proyek/{lokasiId}/hapus-dokumen/{dokumenId}', [LokasiProyekAdminController::class, 'hapusDokumen'])->name('lokasi-proyek.hapusDokumen');
Route::get('/lokasi-proyek/{lokasiId}/download-dokumen/{dokumenId}', [LokasiProyekAdminController::class, 'downloadDokumen'])->name('lokasi-proyek.downloadDokumen');
Route::post('/lokasi-proyek/{lokasiId}/update-caption/{dokumenId}', [LokasiProyekAdminController::class, 'updateCaption'])->name('lokasi-proyek.updateCaption');




