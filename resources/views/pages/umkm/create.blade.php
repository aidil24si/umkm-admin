@extends('layouts.admin.app')
@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4>Tambah UMKM</h4>
                <h6>Input data UMKM</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('umkm.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <label>Nama Usaha</label>
                            <input type="text" name="nama_usaha" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Pemilik</label>
                            <select name="pemilik_warga_id" class="form-control" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}">{{ $w->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control" required>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Kontak</label>
                            <input type="text" name="kontak" class="form-control" required>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>RT</label>
                            <input type="text" name="rt" class="form-control" required>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>RW</label>
                            <input type="text" name="rw" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="col-md-12 mt-4">
                            <button class="btn btn-submit">Simpan</button>
                            <a href="{{ route('umkm.index') }}" class="btn btn-cancel">Batal</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
