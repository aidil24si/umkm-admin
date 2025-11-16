@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Edit Warga</h4>
                    <h6>Mengedit data warga</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('warga.update', $dataWarga->warga_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="no_ktp" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" required
                                        value="{{ $dataWarga->no_ktp }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required
                                        value="{{ $dataWarga->nama }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required
                                        value="{{ old('jenis_kelamin') }}">
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki"
                                            {{ $dataWarga->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ $dataWarga->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="agama" class="form-label">Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama" required
                                        value="{{ $dataWarga->agama }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required
                                        value="{{ $dataWarga->pekerjaan }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="telp" class="form-label">No. HP</label>
                                    <input type="text" class="form-control" id="telp" name="telp" required
                                        value="{{ $dataWarga->telp }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $dataWarga->email }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button href="javascript:void(0);" type="submit" class="btn btn-submit me-2">Update
                                    Data
                                </button>
                                <a href="{{ route('warga.index') }}" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    {{-- End Main Content --}}
@endsection
