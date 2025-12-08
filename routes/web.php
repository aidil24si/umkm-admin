<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\UsersAdminController;
use App\Http\Controllers\WargaAdminController;
use App\Http\Controllers\ProyekAdminController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\TahapanProyekAdminController;

// Warga Admin Routes
Route::resource('warga', WargaAdminController::class)->middleware('checkislogin');

// Proyek Admin Routes
Route::resource('proyek', ProyekAdminController::class)->middleware('checkislogin');

//Dashboard Admin Routes
Route::resource('dashboard', DashboardAdminController::class)->middleware('checkislogin');

//users admin routes
Route::resource('user', UsersAdminController::class)->middleware('checkislogin');

//tahapan proyek admin routes
Route::resource('tahapan', TahapanProyekAdminController::class)->middleware('checkislogin');

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
Route::group(['middleware' => ['checkrole:Admin']], function () {
    Route::get('proyek', [ProyekAdminController::class,'index'])->name('proyek.index');
    Route::get('tahapan', [TahapanProyekAdminController::class,'index'])->name('tahapan.index');
    Route::get('warga', [WargaAdminController::class,'index'])->name('warga.index');
});

//route middleware checkrole Super admin
Route::group(['middleware' => ['checkrole:Super Admin']], function () {
    Route::get('user', [UsersAdminController::class,'index'])->name('user.index');
});


