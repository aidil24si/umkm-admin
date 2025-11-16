@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Tambah Warga</h4>
                    <h6>Membuat data warga</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('warga-admin.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="no_ktp" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                                        placeholder="Masukkan NIK" required value="{{ old('no_ktp') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukkan nama lengkap" required value="{{ old('nama') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required
                                        value="{{ old('jenis_kelamin') }}">
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="agama" class="form-label">Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama"
                                        placeholder="Masukkan agama anda" required value="{{ old('agama') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                        placeholder="Masukkan pekerjaan" required value="{{ old('pekerjaan') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="telp" class="form-label">No. HP</label>
                                    <input type="text" class="form-control" id="telp" name="telp"
                                        placeholder="Masukkan nomor telepon" required value="{{ old('telp') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Masukkan alamat email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button href="javascript:void(0);" type="submit" class="btn btn-submit me-2">Tambah
                                    Data
                                </button>
                                <button type="reset" class="btn btn-cancel me-2">
                                    <i class="fe fe-refresh-cw"></i> Reset
                                </button>
                                <a href="{{ route('warga-admin.index') }}" class="btn btn-cancel"><i class="fe fe-x"
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
