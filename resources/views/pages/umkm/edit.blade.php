@extends('layouts.admin.app')
@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4>Edit UMKM</h4>
                <h6>Perbarui data UMKM</h6>
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
                <form action="{{ route('umkm.update', $umkm->umkm_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- Nama Usaha --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Usaha</label>
                                <input type="text" name="nama_usaha" class="form-control"
                                    value="{{ old('nama_usaha', $umkm->nama_usaha) }}" required>
                            </div>
                        </div>

                        {{-- Pemilik --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pemilik UMKM</label>
                                <select name="pemilik_warga_id" class="form-control" required>
                                    <option value="">-- Pilih Warga --</option>
                                    @foreach ($warga as $w)
                                        <option value="{{ $w->warga_id }}"
                                            {{ $umkm->pemilik_warga_id == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Kategori --}}
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label>Kategori</label>
                                <input type="text" name="kategori" class="form-control"
                                    value="{{ old('kategori', $umkm->kategori) }}" required>
                            </div>
                        </div>

                        {{-- Kontak --}}
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label>Kontak</label>
                                <input type="text" name="kontak" class="form-control"
                                    value="{{ old('kontak', $umkm->kontak) }}" required>
                            </div>
                        </div>

                        {{-- RT --}}
                        <div class="col-md-3 mt-3">
                            <div class="form-group">
                                <label>RT</label>
                                <input type="text" name="rt" class="form-control"
                                    value="{{ old('rt', $umkm->rt) }}" required>
                            </div>
                        </div>

                        {{-- RW --}}
                        <div class="col-md-3 mt-3">
                            <div class="form-group">
                                <label>RW</label>
                                <input type="text" name="rw" class="form-control"
                                    value="{{ old('rw', $umkm->rw) }}" required>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $umkm->alamat) }}</textarea>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                            </div>
                        </div>

                        {{-- Button --}}
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-submit me-2">
                                <i class="fe fe-save me-1"></i> Update Data
                            </button>
                            <a href="{{ route('umkm.index') }}" class="btn btn-cancel">
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
