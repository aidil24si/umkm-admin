@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Tambah Tahapan Proyek</h4>
                    <h6>Membuat data tahapan proyek baru</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tahapan.store') }}" method="POST">
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
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="nama_tahap" class="form-label">Nama Tahap</label>
                                    <input type="text" class="form-control" id="nama_tahap" name="nama_tahap"
                                        placeholder="Masukkan nama tahap" required value="{{ old('nama_tahap') }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="target_persen" class="form-label">Target Persen (%)</label>
                                    <input type="number" step="0.01" min="0" max="100" class="form-control"
                                        id="target_persen" name="target_persen" placeholder="Masukkan target persen"
                                        required value="{{ old('target_persen') }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai"
                                        required value="{{ old('tgl_mulai') }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai"
                                        required value="{{ old('tgl_selesai') }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-submit me-2"><i class="fe fe-save me-1"></i>Tambah Data</button>
                                <button type="reset" class="btn btn-cancel me-2">
                                    <i class="fe fe-refresh-cw"></i> Reset
                                </button>
                                <a href="{{ route('tahapan.index') }}" class="btn btn-cancel">
                                    <i class="fe fe-x" data-bs-toggle="tooltip" title="fe fe-x"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    {{-- End Main Content --}}
@endsection
