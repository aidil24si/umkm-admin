@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content">

            <div class="page-header">
                <div class="page-title">
                    <h4>List Ulasan</h4>
                    <h6>Kelola data ulasan produk</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('ulasan.create') }}" class="btn btn-added">
                        <i class="fe fe-plus me-1"></i> Tambah Ulasan
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <form method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="rating" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Rating</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                            {{ $i }} Bintang
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari ID Warga / ID Produk" value="{{ request('search') }}">
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Warga</th>
                                    <th>Rating</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ulasan as $item)
                                    <tr>
                                        <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                                        <td>{{ $item->warga->nama ?? '-' }}</td>
                                        <td>
                                            <span class="badges bg-lightyellow">
                                                {{ $item->rating }} ★
                                            </span>
                                        </td>
                                        <td>{{ Str::limit($item->komentar, 40) }}</td>
                                        <td>
                                            <a href="{{ route('ulasan.edit', $item->ulasan_id) }}" class="btn btn-sm btn-warning">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                            <form action="{{ route('ulasan.destroy', $item->ulasan_id) }}" method="POST"
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
                            {{ $ulasan->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
