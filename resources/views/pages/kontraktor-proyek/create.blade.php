@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Tambah Kontraktor Proyek</h4>
                    <h6>Membuat data kontraktor proyek baru</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('kontraktor.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="proyek_id" class="form-label">Pilih Proyek</label>
                                    <select class="form-select" id="proyek_id" name="proyek_id" required>
                                        <option value="" selected disabled>Pilih Proyek</option>
                                        @foreach($dataProyek as $proyek)
                                            <option value="{{ $proyek->proyek_id }}"
                                                {{ old('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                                                {{ $proyek->nama_proyek }} - {{ $proyek->kode_proyek }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('proyek_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama Kontraktor</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukkan nama kontraktor" required value="{{ old('nama') }}">
                                    @error('nama')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                                    <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                                        placeholder="Masukkan nama penanggung jawab" required value="{{ old('penanggung_jawab') }}">
                                    @error('penanggung_jawab')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="kontak" class="form-label">Kontak</label>
                                    <input type="text" class="form-control" id="kontak" name="kontak"
                                        placeholder="Masukkan nomor kontak" required value="{{ old('kontak') }}">
                                    @error('kontak')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                        placeholder="Masukkan alamat kontraktor">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-submit me-2">
                                    <i class="fe fe-save me-1"></i>Simpan Data
                                </button>
                                <button type="reset" class="btn btn-cancel me-2">
                                    <i class="fe fe-refresh-cw"></i> Reset
                                </button>
                                <a href="{{ route('kontraktor.index') }}" class="btn btn-cancel">
                                    <i class="fe fe-x"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
