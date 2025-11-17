@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Tahapan Proyek</h4>
                    <h6>Kelola data tahapan proyek</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('tahapan.create') }}" class="btn btn-added"><img
                            src="{{ asset('assets-admin/img/icons/plus.svg') }}" alt="img" class="me-1">Tambah Tahapan</a>
                </div>
            </div>
            {{-- Notifikasi Success --}}
            @if(session('success'))
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
                        <table class="table datanew table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nama Tahapan</th>
                                    <th>Nama Proyek</th>
                                    <th>Target Persen</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataTahapan as $item)
                                    <tr>
                                        <td>{{ $item->nama_tahap }}</td>
                                        <td>
                                            <span class="badges bg-lightgrey">
                                                {{ $item->proyek->nama_proyek ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($item->target_persen, 2) }}%</td>
                                        <td>{{ $item->tgl_mulai->format('d/m/Y') }}</td>
                                        <td>{{ $item->tgl_selesai->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="action-buttons d-flex align-items-center">
                                                <a class="btn-action btn-edit me-2" title="Edit Data"
                                                    href="{{ route('tahapan.edit', $item->tahap_id) }}">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <form action="{{ route('tahapan.destroy', $item->tahap_id) }}"
                                                    method="POST" class="d-inline delete-form"
                                                    data-success-message="Data tahapan proyek berhasil dihapus!">
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
