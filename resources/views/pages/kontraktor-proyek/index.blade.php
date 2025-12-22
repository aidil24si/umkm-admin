@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Kontraktor Proyek</h4>
                    <h6>Kelola data kontraktor proyek</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('kontraktor.create') }}" class="btn btn-added">
                        <img src="{{ asset('assets-admin/img/icons/plus.svg') }}" alt="img" class="me-1">
                        Tambah Kontraktor
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="GET" action="{{ route('kontraktor.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <select name="proyek_id" class="form-select" onchange="this.form.submit()">
                                        <option value="">Semua Proyek</option>
                                        @foreach($dataProyek as $proyek)
                                            <option value="{{ $proyek->proyek_id }}"
                                                {{ request('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                                                {{ $proyek->nama_proyek }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            value="{{ request('search') }}" placeholder="Cari nama, penanggung jawab, kontak...">
                                        <button type="submit" class="input-group-text">
                                            <img src="{{ asset('assets-admin/img/icons/search-white.svg') }}" alt="img">
                                        </button>
                                        @if(request('search'))
                                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                               class="btn btn-outline-secondary ml-3">
                                                Clear
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nama Kontraktor</th>
                                    <th>Nama Proyek</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Kontak</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataKontraktor as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            <span class="badges bg-lightgrey">
                                                {{ $item->proyek->nama_proyek ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>{{ $item->penanggung_jawab }}</td>
                                        <td>{{ $item->kontak }}</td>
                                        <td>{{ Str::limit($item->alamat, 30) }}</td>
                                        <td>
                                            <div class="action-buttons d-flex align-items-center">
                                                <a href="{{ route('kontraktor.edit', $item->kontraktor_id) }}"
                                                   class="btn-action btn-edit me-2" title="Edit">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <form action="{{ route('kontraktor.destroy', $item->kontraktor_id) }}"
                                                      method="POST" class="d-inline delete-form">
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
                            {{ $dataKontraktor->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
