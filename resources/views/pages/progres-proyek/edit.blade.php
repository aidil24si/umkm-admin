@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Edit Progres Proyek</h4>
                    <h6>Mengedit data progres proyek</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('progres.update', $progres->progres_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="proyek_id" class="form-label">Proyek</label>
                                    <select class="form-control" id="proyek_id" name="proyek_id" required>
                                        <option value="">Pilih Proyek</option>
                                        @foreach ($dataProyek as $proyek)
                                            <option value="{{ $proyek->proyek_id }}" {{ $progres->proyek_id == $proyek->proyek_id ? 'selected' : '' }}>
                                                {{ $proyek->nama_proyek }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="tahap_id" class="form-label">Tahap</label>
                                    <select class="form-control" id="tahap_id" name="tahap_id" required>
                                        <option value="">Pilih Tahap</option>
                                        @foreach ($dataTahapan as $tahap)
                                            <option value="{{ $tahap->tahap_id }}" {{ $progres->tahap_id == $tahap->tahap_id ? 'selected' : '' }}>
                                                {{ $tahap->nama_tahap }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="persen_real" class="form-label">Persen Real (%)</label>
                                    <input type="number" step="0.01" class="form-control" id="persen_real"
                                           name="persen_real" placeholder="0.00" required min="0" max="100"
                                           value="{{ $progres->persen_real }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required
                                           value="{{ \Carbon\Carbon::parse($progres->tanggal)->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="4"
                                              placeholder="Masukkan catatan progres">{{ $progres->catatan }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-submit me-2">
                                    <i class="fe fe-save me-1"></i> Update Data
                                </button>
                                <a href="{{ route('progres.index') }}" class="btn btn-cancel">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
