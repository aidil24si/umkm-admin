@extends('layouts.admin.app')
@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4>Edit Produk</h4>
                <h6>Perbarui data produk</h6>
            </div>
        </div>

        {{-- Error Validation --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('produk.update', $produk->produk_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- UMKM --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>UMKM</label>
                                <select name="umkm_id" class="form-control" required>
                                    <option value="">-- Pilih UMKM --</option>
                                    @foreach ($umkm as $u)
                                        <option value="{{ $u->umkm_id }}"
                                            {{ old('umkm_id', $produk->umkm_id) == $u->umkm_id ? 'selected' : '' }}>
                                            {{ $u->nama_usaha }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Nama Produk --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control"
                                    value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                            </div>
                        </div>

                        {{-- Harga --}}
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control"
                                    value="{{ old('harga', $produk->harga) }}" required>
                            </div>
                        </div>

                        {{-- Stok --}}
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stok" class="form-control"
                                    value="{{ old('stok', $produk->stok) }}" required>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="aktif" {{ old('status', $produk->status) == 'aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="nonaktif" {{ old('status', $produk->status) == 'nonaktif' ? 'selected' : '' }}>
                                        Nonaktif
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3"
                                    placeholder="Masukkan deskripsi produk">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                            </div>
                        </div>

                        {{-- Button --}}
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-submit me-2">
                                <i class="fe fe-save me-1"></i> Update Data
                            </button>
                            <a href="{{ route('produk.index') }}" class="btn btn-cancel">
                                <i class="fe fe-x"></i> Batal
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
