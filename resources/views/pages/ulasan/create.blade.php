@extends('layouts.admin.app')

@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4>Tambah Ulasan</h4>
                <h6>Membuat ulasan produk</h6>
            </div>
        </div>

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
                <form action="{{ route('ulasan.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mt-3">
                            <label>Produk</label>
                            <select name="produk_id" class="form-select" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($produk as $p)
                                    <option value="{{ $p->produk_id }}">
                                        {{ $p->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Warga</label>
                            <select name="warga_id" class="form-select" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}">
                                        {{ $w->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>Rating</label>
                            <select name="rating" class="form-select" required>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} Bintang</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label>Komentar</label>
                            <textarea name="komentar" class="form-control" rows="4"
                                      placeholder="Tulis komentar (opsional)">{{ old('komentar') }}</textarea>
                        </div>

                        <div class="col-md-12 mt-4">
                            <button class="btn btn-submit me-2">
                                <i class="fe fe-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('ulasan.index') }}" class="btn btn-cancel">
                                Batal
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
