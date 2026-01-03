@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Warga</h4>
                    <h6>Kelola data warga</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('warga.create') }}" class="btn btn-added"><img
                            src="{{ asset('assets-admin/img/icons/plus.svg') }}" alt="img" class="me-1">Tambah Warga</a>
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
                        <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        <option value="Laki-laki"
                                            {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="Perempuan"
                                            {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
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
                                        NIK
                                    </th>
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Jenis Kelamin
                                    </th>
                                    <th>
                                        Agama
                                    </th>
                                    <th>
                                        Pekerjaan
                                    </th>
                                    <th>
                                        No HP
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewWarga as $item)
                                    <tr>
                                        <td>{{ $item->no_ktp }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            @if ($item->jenis_kelamin == 'Laki-laki')
                                                <span class="badges bg-darkblue">Laki-laki</span>
                                            @else
                                                <span class="badges bg-darkpink">Perempuan</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->agama }}</td>
                                        <td>{{ $item->pekerjaan }}</td>
                                        <td>{{ $item->telp }}</td>
                                        <td><span class="badges bg-lightgrey">{{ $item->email }}</span></td>
                                        <td>
                                            <div class="action-buttons d-flex align-items-center">
                                                <a class="btn-action btn-edit me-2" title="Edit Data"
                                                    href="{{ route('warga.edit', $item->warga_id) }}">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                                    class="d-inline delete-form"
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
                            {{ $dataWarga->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- End Main Content --}}
@endsection
