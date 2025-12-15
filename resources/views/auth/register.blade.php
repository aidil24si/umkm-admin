@extends('layouts.auth.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="{{ asset('assets-admin/img/logo.svg') }}" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Register</h3>
                            <h4>Buat akun kamu untuk masuk ke halaman dashboard</h4>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.register') }}" method="POST">
                            @csrf
                            <div class="form-login">
                                <label>Nama Lengkap</label>
                                <div class="form-addons">
                                    <input type="text" name="name" placeholder="Masukkan nama lengkap"
                                        value="{{ old('name') }}" required>
                                    <img src="{{ asset('assets-admin/img/icons/users1.svg') }}" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="email" name="email" placeholder="Masukkan alamat email"
                                        value="{{ old('email') }}" required>
                                    <img src="{{ asset('assets-admin/img/icons/mail.svg') }}" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password" class="pass-input"
                                        placeholder="Masukkan password" required>
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Konfirmasi Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password_confirmation" class="pass-input"
                                        placeholder="Konfirmasi password" required>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Sign Up</button>
                            </div>
                        </form>
                        <div class="signinform text-center">
                            <h4>Sudah punya akun? <a href="{{ route('login') }}" class="hover-a">Login Disini</a></h4>
                        </div>
                    </div>
                </div>
                <div class="login-img">

                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
