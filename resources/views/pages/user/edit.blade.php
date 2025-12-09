@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Edit User</h4>
                    <h6>Mengedit data user</h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            {{-- Foto Profil Section --}}
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label mb-3 d-block">Foto Profil</label>

                                    <div class="profile-picture-wrapper mb-3">
                                        <div class="profile-picture-container">
                                            @if ($dataUser->profile_picture)
                                                <img src="{{ asset('storage/' . $dataUser->profile_picture) }}"
                                                    class="profile-picture" alt="Foto Profil">
                                            @else
                                                <div class="profile-picture-placeholder">
                                                    <i data-feather="user" class="profile-icon"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="btn btn-outline-primary btn-sm">
                                            <i data-feather="upload" class="me-1"></i>
                                            Pilih File
                                            <input type="file" class="d-none" name="profile_picture" accept="image/*"
                                                onchange="previewImage(this)">
                                        </label>
                                        <div class="form-text text-muted">
                                            Pilih file gambar untuk mengubah foto profil
                                        </div>
                                    </div>

                                    @if ($dataUser->profile_picture)
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="remove_profile_picture"
                                                value="1" id="removePhoto">
                                            <label class="form-check-label text-danger" for="removePhoto">
                                                <i data-feather="trash-2" class="me-1"></i>
                                                Hapus Foto Profil
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Form Data Section --}}
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="row">
                                    {{-- Nama --}}
                                    <div class="col-lg-6 col-md-12 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" id="name" class="form-control" required
                                                name="name" value="{{ $dataUser->name }}" placeholder="Masukkan nama">
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-lg-6 col-md-12 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" id="email" class="form-control" required
                                                name="email" value="{{ $dataUser->email }}" placeholder="Masukkan email">
                                        </div>
                                    </div>

                                    {{-- Role --}}
                                    <div class="col-lg-6 col-md-12 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="role" class="form-label">Role</label>
                                            <select class="form-select" id="role" name="role" required>
                                                <option value="" disabled>Pilih Role User</option>
                                                <option value="Super Admin"
                                                    {{ $dataUser->role == 'Super Admin' ? 'selected' : '' }}>
                                                    Super Admin
                                                </option>
                                                <option value="Admin" {{ $dataUser->role == 'Admin' ? 'selected' : '' }}>
                                                    Admin
                                                </option>
                                                <option value="Company"
                                                    {{ $dataUser->role == 'Company' ? 'selected' : '' }}>
                                                    Company
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Password --}}
                                    <div class="col-lg-6 col-md-12 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="Kosongkan jika tidak ingin mengubah">
                                            <div class="form-text text-muted">
                                                Minimal 8 karakter
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Konfirmasi Password --}}
                                    <div class="col-lg-6 col-md-12 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="password_confirmation" class="form-label">Konfirmasi
                                                Password</label>
                                            <input type="password" id="password_confirmation" class="form-control"
                                                placeholder="Kosongkan jika tidak ingin mengubah"
                                                name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button href="javascript:void(0);" type="submit" class="btn btn-submit me-2"><i class="fe fe-save me-1"></i>Update
                                            Data
                                        </button>
                                        <a href="{{ route('user.index') }}" class="btn btn-cancel">Cancel</a>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
