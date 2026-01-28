@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">

            {{-- Header --}}
            <div class="page-header">
                <div class="page-title">
                    <h4>Detail Produk</h4>
                    <h6>Informasi dan Foto Produk</h6>
                </div>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                    <i class="fe fe-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="row">
                {{-- Informasi Produk --}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Informasi Produk</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th>UMKM</th>
                                    <td>{{ $produk->umkm->nama_usaha }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Produk</th>
                                    <td class="fw-bold">{{ $produk->nama_produk }}</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <td>{{ $produk->stok }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($produk->status == 'aktif')
                                            <span class="badges bg-lightgreen">Aktif</span>
                                        @else
                                            <span class="badges bg-lightred">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $produk->deskripsi ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Upload Foto Produk --}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Upload Foto Produk</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('produk.uploadFoto', $produk->produk_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="files[]" multiple class="form-control mb-3" required>
                                <button class="btn btn-primary">
                                    <i class="fe fe-upload"></i> Upload Foto
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Daftar Foto Produk --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Foto Produk</h5>
                </div>
                <div class="card-body">
                    @if ($produk->foto->count())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Caption</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk->foto as $i => $foto)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <img src="{{ asset('storage/produk_foto/' . $foto->file_name) }}"
                                                style="width:80px;height:80px;object-fit:cover;border-radius:6px;">
                                        </td>
                                        <td>
                                            <form
                                                action="{{ route('produk.updateCaption', [$produk->produk_id, $foto->media_id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="caption" class="form-control"
                                                        value="{{ $foto->caption }}">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fe fe-save"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('produk.downloadFoto', [$produk->produk_id, $foto->media_id]) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fe fe-download"></i>
                                            </a>
                                            <form
                                                action="{{ route('produk.hapusFoto', [$produk->produk_id, $foto->media_id]) }}"
                                                method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fe fe-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted text-center">Belum ada foto produk</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
