@extends('layouts.admin.app')
@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4>Tambah Detail Pesanan</h4>
                <h6>Menambahkan item pesanan</h6>
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
                <form action="{{ route('detail.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mt-3">
                            <label>Pesanan</label>
                            <select name="pesanan_id" class="form-select" required>
                                <option value="">-- Pilih Pesanan --</option>
                                @foreach ($pesanan as $p)
                                    <option value="{{ $p->pesanan_id }}">
                                        {{ $p->nomor_pesanan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Produk</label>
                            <select name="produk_id" class="form-select" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($produk as $pr)
                                    <option value="{{ $pr->produk_id }}">
                                        {{ $pr->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>Qty</label>
                            <input type="number" name="qty" class="form-control"
                                   value="{{ old('qty') }}" min="1" required>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>Harga Satuan</label>
                            <input type="number" name="harga_satuan" class="form-control"
                                   value="{{ old('harga_satuan') }}" min="0" required>
                        </div>

                        <div class="col-md-12 mt-4">
                            <button class="btn btn-submit me-2">
                                <i class="fe fe-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('detail.index') }}" class="btn btn-cancel">
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
