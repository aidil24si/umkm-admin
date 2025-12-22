@extends('layouts.admin.app')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>List Lokasi Proyek</h4>
                <h6>Kelola data lokasi proyek</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('lokasi.create') }}" class="btn btn-added">
                    <img src="{{ asset('assets-admin/img/icons/plus.svg') }}" alt="img" class="me-1">
                    Tambah Lokasi
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <form method="GET" action="{{ route('lokasi.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="proyek_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Proyek</option>
                                    @foreach($dataProyek as $proyek)
                                        <option value="{{ $proyek->proyek_id }}"
                                            {{ request('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                                            {{ $proyek->kode_proyek }} - {{ $proyek->nama_proyek }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Proyek</th>
                                <th>Koordinat</th>
                                <th>GeoJSON</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataLokasi as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->proyek->kode_proyek }}</strong><br>
                                        <small>{{ $item->proyek->nama_proyek }}</small>
                                    </td>
                                    <td>
                                        @if($item->lat && $item->lng)
                                            {{ $item->lat }}, {{ $item->lng }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->geojson)
                                            <span class="badge bg-success">Ada</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons d-flex align-items-center">
                                            <a class="btn-action btn-detail me-2" title="Detail"
                                               href="{{ route('lokasi.show', $item->lokasi_id) }}">
                                                <i class="fe fe-eye"></i>
                                            </a>
                                            <a class="btn-action btn-edit me-2" title="Edit"
                                               href="{{ route('lokasi.edit', $item->lokasi_id) }}">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                            <form action="{{ route('lokasi.destroy', $item->lokasi_id) }}"
                                                  method="POST" class="d-inline delete-form"
                                                  data-success-message="Lokasi berhasil dihapus!">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete" title="Hapus">
                                                    <i class="fe fe-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $dataLokasi->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
