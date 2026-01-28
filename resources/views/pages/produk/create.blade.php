@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('produk.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label>UMKM</label>
                                <select name="umkm_id" class="form-select" required>
                                    <option value="">-- Pilih UMKM --</option>
                                    @foreach ($umkm as $u)
                                        <option value="{{ $u->umkm_id }}">{{ $u->nama_usaha }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" required>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Stok</label>
                                <input type="number" name="stok" class="form-control" required>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Status</label>
                                <select name="status" class="form-select">
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12 mt-3">
                                <button class="btn btn-primary">Simpan</button>
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
