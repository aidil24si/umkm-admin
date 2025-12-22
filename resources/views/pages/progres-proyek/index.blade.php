@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Progres Proyek</h4>
                    <h6>Kelola data progres proyek</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('progres.create') }}" class="btn btn-added">
                        <img src="{{ asset('assets-admin/img/icons/plus.svg') }}" alt="img" class="me-1">
                        Tambah Progres
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
                    <form method="GET" action="{{ route('progres.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="proyek_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Proyek</option>
                                    @foreach ($dataProyek as $proyek)
                                        <option value="{{ $proyek->proyek_id }}"
                                            {{ request('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                                            {{ $proyek->nama_proyek }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Cari catatan...">
                                    <button type="submit" class="input-group-text">
                                        <img src="{{ asset('assets-admin/img/icons/search-white.svg') }}" alt="img">
                                    </button>
                                    @if (request('search'))
                                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                            class="btn btn-outline-secondary ml-3">
                                            Clear
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Proyek</th>
                                    <th>Tahap</th>
                                    <th>Persen Real</th>
                                    <th>Tanggal</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataProgres as $item)
                                    <tr>
                                        <td>{{ $item->proyek->nama_proyek }}</td>
                                        <td>{{ $item->tahapan->nama_tahap }}</td>
                                        <td>
                                            <span class="badges bg-lightgreen">{{ $item->persen_real }}%</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                        <td class="catatan-cell">{{ Str::limit($item->catatan, 50) }}</td>
                                        <td>
                                            <div class="action-buttons d-flex align-items-center">
                                                <a class="btn-action btn-detail me-2" title="Detail"
                                                    href="{{ route('progres.show', $item->progres_id) }}">
                                                    <i class="fe fe-eye"></i>
                                                </a>
                                                <a class="btn-action btn-edit me-2" title="Edit"
                                                    href="{{ route('progres.edit', $item->progres_id) }}">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <form action="{{ route('progres.destroy', $item->progres_id) }}"
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
                            {{ $dataProgres->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
