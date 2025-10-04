<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login-form');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:3|regex:/[A-Z]/'
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 3 karakter',
            'password.regex' => 'Password harus mengandung huruf kapital'
        ]);

        // jika validasi berhasil akan di arahkan ke dashboard dan ada pesan berhasilnya
        return redirect('/dashboard')->with('success', 'Login berhasil! Selamat datang di dashboard admin.');
    }
}
