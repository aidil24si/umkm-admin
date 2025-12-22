@extends('layouts.admin.app')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Tambah Lokasi Proyek</h4>
                <h6>Membuat data lokasi proyek</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('lokasi.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="proyek_id" class="form-label">Proyek</label>
                                <select class="form-control" id="proyek_id" name="proyek_id" required>
                                    <option value="">Pilih Proyek</option>
                                    @foreach ($dataProyek as $proyek)
                                            <option value="{{ $proyek->proyek_id }}" {{ old('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                                                {{ $proyek->nama_proyek }}
                                            </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="lat" class="form-label">Latitude</label>
                                <input type="number" step="any" class="form-control" id="lat" name="lat"
                                       placeholder="Contoh: -6.2088" value="{{ old('lat') }}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="lng" class="form-label">Longitude</label>
                                <input type="number" step="any" class="form-control" id="lng" name="lng"
                                       placeholder="Contoh: 106.8456" value="{{ old('lng') }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="geojson" class="form-label">GeoJSON Data</label>
                                <textarea class="form-control" id="geojson" name="geojson" rows="6"
                                          placeholder='{"type": "Feature", "properties": {}, "geometry": {...}}'>{{ old('geojson') }}</textarea>
                                <div class="form-text">
                                    Masukkan data GeoJSON dalam format valid JSON
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">
                                <i class="fe fe-save me-1"></i>Simpan
                            </button>
                            <button type="reset" class="btn btn-cancel me-2">
                                <i class="fe fe-refresh-cw"></i> Reset
                            </button>
                            <a href="{{ route('lokasi.index') }}" class="btn btn-cancel">
                                <i class="fe fe-x"></i> Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
