@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Produk</h4>
                    <h6>Kelola data produk UMKM</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('produk.create') }}" class="btn btn-added">
                        <img src="{{ asset('assets-admin/img/icons/plus.svg') }}" class="me-1">Tambah Produk
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body table-responsive">
                    <form method="GET" action="{{ route('produk.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>
                                        Nonaktif
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                        value="{{ request('search') }}" placeholder="Cari nama produk..."
                                        aria-label="Search">
                                    <button type="submit" class="input-group-text" id="basic-addon2">
                                        <img src="{{ asset('assets-admin/img/icons/search-white.svg') }}" alt="img">
                                    </button>
                                    @if (request('search'))
                                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                            class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>UMKM</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $item)
                                <tr>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->umkm->nama_usaha ?? '-' }}</td>
                                    <td>{{ $item->deskripsi ?? '-' }}</td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>
                                        <span class="badge {{ $item->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('produk.show', $item->produk_id) }}" class="btn btn-sm btn-info">
                                            <i class="fe fe-eye"></i>
                                        </a>
                                        <a href="{{ route('produk.edit', $item->produk_id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fe fe-edit"></i>
                                        </a>
                                        <form action="{{ route('produk.destroy', $item->produk_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fe fe-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $produk->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
