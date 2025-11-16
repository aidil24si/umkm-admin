@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Proyek</h4>
                    <h6>Kelola Data Proyek</h6>
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
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{ asset('assets-admin/img/icons/filter.svg') }}" alt="img">
                                    <span><img src="{{ asset('assets-admin/img/icons/closes.svg') }}" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img
                                        src="{{ asset('assets-admin/img/icons/search-white.svg') }}" alt="img"></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 text-muted" style="width: 100px;">
                                        Kode Proyek
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 120px;">
                                        Nama Proyek
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 80px;">
                                        Tahun
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 120px;">
                                        Lokasi
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 120px;">
                                        Anggaran
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 120px;">
                                        Sumber Dana
                                    </th>
                                    <th scope="col" class="px-2 text-muted deskripsi-cell">
                                        Deskripsi
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 100px;">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataProyek as $item)
                                    <tr>
                                        <td class="px-2">{{ $item->kode_proyek }}</td>
                                        <td class="px-2">{{ $item->nama_proyek }}</td>
                                        <td class="px-2">{{ $item->tahun }}</td>
                                        <td class="px-2">{{ $item->lokasi }}</td>
                                        <td class="px-2"><span class="badges bg-lightgreen">Rp
                                                {{ number_format($item->anggaran, 2, ',', '.') }}</span></td>
                                        <td class="px-2">{{ $item->sumber_dana }}</td>
                                        <td class="px-2 deskripsi-cell">{{ $item->deskripsi }}</td>
                                        <td>
                                            <div class="action-buttons d-flex align-items-center">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
