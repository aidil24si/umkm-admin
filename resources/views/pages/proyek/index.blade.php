@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Proyek</h4>
                    <h6>Kelola data proyek</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('proyek.create') }}" class="btn btn-added"><img
                            src="{{ asset('assets-admin/img/icons/plus.svg') }}" alt="img" class="me-1">Tambah
                        Proyek</a>
                </div>
            </div>
            {{-- Notifikasi Success --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="GET" action="{{ route('proyek.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="tahun" class="form-select" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        <option value="2025" {{ request('tahun') == '2025' ? 'selected' : '' }}>2025
                                        </option>
                                        <option value="2024" {{ request('tahun') == '2024' ? 'selected' : '' }}>2024
                                        </option>
                                        <option value="2023" {{ request('tahun') == '2023' ? 'selected' : '' }}>2023
                                        </option>
                                        <option value="2022" {{ request('tahun') == '2022' ? 'selected' : '' }}>2022
                                        </option>
                                        <option value="2021" {{ request('tahun') == '2021' ? 'selected' : '' }}>2021
                                        </option>
                                        <option value="2020" {{ request('tahun') == '2020' ? 'selected' : '' }}>2020
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                            value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                                        <button type="submit" class="input-group-text" id="basic-addon2">
                                            <img src="{{ asset('assets-admin/img/icons/search-white.svg') }}"
                                                alt="img">
                                        </button>
                                        @if (request('search'))
                                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                                class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        Kode Proyek
                                    </th>
                                    <th>
                                        Nama Proyek
                                    </th>
                                    <th>
                                        Tahun
                                    </th>
                                    <th>
                                        Lokasi
                                    </th>
                                    <th>
                                        Anggaran
                                    </th>
                                    <th>
                                        Sumber Dana
                                    </th>
                                    <th>
                                        Total Kontraktor
                                    </th>
                                    <th>
                                        Deskripsi
                                    </th>
                                    <th>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataProyek as $item)
                                    <tr>
                                        <td>{{ $item->kode_proyek }}</td>
                                        <td>{{ $item->nama_proyek }}</td>
                                        <td>{{ $item->tahun }}</td>
                                        <td>{{ $item->lokasi }}</td>
                                        <td><span class="badges bg-lightgreen">Rp
                                                {{ number_format($item->anggaran, 2, ',', '.') }}</span></td>
                                        <td>{{ $item->sumber_dana }}</td>
                                        <td>{{ $item->total_kontraktor }}</td>
                                        <td class="px-2 deskripsi-cell">{{ $item->deskripsi }}</td>
                                        <td>
                                            <div class="action-buttons d-flex align-items-center">
                                                <a class="btn-action btn-detail me-2" title="Detail Data"
                                                    href="{{ route('proyek.show', $item->proyek_id) }}">
                                                    <i class="fe fe-eye"></i>
                                                </a>
                                                <a class="btn-action btn-edit me-2" title="Edit Data"
                                                    href="{{ route('proyek.edit', $item->proyek_id) }}">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <form action="{{ route('proyek.destroy', $item->proyek_id) }}"
                                                    method="POST" class="d-inline delete-form"
                                                    data-success-message="Data berhasil dihapus!">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete" title="Hapus Data">
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
                            {{ $dataProyek->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
