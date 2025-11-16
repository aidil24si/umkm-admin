<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\UsersAdminController;
use App\Http\Controllers\WargaAdminController;
use App\Http\Controllers\ProyekAdminController;
use App\Http\Controllers\DashboardAdminController;

// Warga Admin Routes
Route::resource('warga', WargaAdminController::class);

// Proyek Admin Routes
Route::resource('proyek', ProyekAdminController::class);

//Dashboard Admin Routes
Route::resource('dashboard', DashboardAdminController::class);

//users admin routes
Route::resource('user', UsersAdminController::class);

// Auth Admin Routes
Route::get('/', [AuthAdminController::class, 'index'])->name('login');
Route::post('/login', [AuthAdminController::class, 'login'])->name('admin.login');
Route::get('/register', [AuthAdminController::class, 'regis'])->name('register');
Route::post('/register', [AuthAdminController::class, 'register'])->name('admin.register');


