@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Tambah User</h4>
                    <h6>Membuat data user</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">Nama</label>
                                    <input type="text" id="name" class="form-control" required name="name"
                                        value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" class="form-control" required name="email"
                                        value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" id="role" name="role">
                                        <option value="" selected disabled>Pilih Role User</option>
                                        <option value="Super Admin" {{ old('role') == 'Super Admin' ? 'selected' : '' }}>
                                            Super
                                            Admin</option>
                                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>
                                        <option value="Guest" {{ old('role') == 'Guest' ? 'selected' : '' }}>
                                            Guest
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <label>Foto Profil</label>
                                <input type="file" class="form-control" name="profile_picture" accept="image/*">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="pass-group">
                                        <input type="text" id="password" class="pass-input" required name="password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Konfirmasi
                                        Password</label>
                                    <div class="pass-group">
                                        <input type="text" id="password_confirmation" class="form-control" required
                                            name="password_confirmation">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button href="javascript:void(0);" type="submit" class="btn btn-submit me-2"><i class="fe fe-save me-1"></i>Tambah
                                    Data
                                </button>
                                <button type="reset" class="btn btn-cancel me-2">
                                    <i class="fe fe-refresh-cw"></i> Reset
                                </button>
                                <a href="{{ route('user.index') }}" class="btn btn-cancel"><i class="fe fe-x"
                                        data-bs-toggle="tooltip" title="fe fe-x"></i> Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
