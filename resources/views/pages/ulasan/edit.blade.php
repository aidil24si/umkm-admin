@extends('layouts.admin.app')

@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4>Edit Ulasan</h4>
                <h6>Perbarui data ulasan</h6>
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
                <form action="{{ route('ulasan.update', $ulasan->ulasan_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mt-3">
                            <label>Produk</label>
                            <select name="produk_id" class="form-select" required>
                                @foreach ($produk as $p)
                                    <option value="{{ $p->produk_id }}"
                                        {{ $ulasan->produk_id == $p->produk_id ? 'selected' : '' }}>
                                        {{ $p->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Warga</label>
                            <select name="warga_id" class="form-select" required>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}"
                                        {{ $ulasan->warga_id == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>Rating</label>
                            <select name="rating" class="form-select" required>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}"
                                        {{ $ulasan->rating == $i ? 'selected' : '' }}>
                                        {{ $i }} Bintang
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label>Komentar</label>
                            <textarea name="komentar" class="form-control" rows="4">
                                {{ old('komentar', $ulasan->komentar) }}
                            </textarea>
                        </div>

                        <div class="col-md-12 mt-4">
                            <button class="btn btn-submit me-2">
                                <i class="fe fe-save me-1"></i> Update
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
