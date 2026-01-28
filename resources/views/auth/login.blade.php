@extends('layouts.auth.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="{{ asset('assets-admin/img/logo-umkm.png') }}" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Login</h3>
                            <h4>Silahkan Login terlebih dahulu</h4>
                            <h4>Untuk masuk ke halaman dashboard`</h4>
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

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.login') }}" method="POST">
                            @csrf
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
                                <button type="submit" class="btn btn-login">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="login-img"
                    style="
                            flex: 1;
                            background-image: url('{{ asset('assets-admin/img/umkm-login.png') }}');
                            background-size: cover;
                            background-position: center;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: white;
                            text-align: center;
                            padding: 2rem;
                        ">
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
