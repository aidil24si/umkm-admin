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
                    <form action="{{ route('user.update', $dataUser->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">Nama</label>
                                    <input type="text" id="name" class="form-control" required name="name"
                                        value="{{ $dataUser->name }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" class="form-control" required name="email"
                                        value="{{ $dataUser->email }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" id="password" class="form-control" required name="password"
                                        value="{{ $dataUser->password }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Konfirmasi
                                        Password</label>
                                    <input type="text" id="password_confirmation" class="form-control" required
                                        name="password_confirmation">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button href="javascript:void(0);" type="submit" class="btn btn-submit me-2">Update
                                    Data
                                </button>
                                <a href="{{ route('user.index') }}" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
