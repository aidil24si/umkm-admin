@extends('layouts.admin.app')
@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4>Edit Detail Pesanan</h4>
                <h6>Perbarui item pesanan</h6>
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
                <form action="{{ route('detail.update', $detailPesanan->detail_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mt-3">
                            <label>Pesanan</label>
                            <select name="pesanan_id" class="form-select" required>
                                @foreach ($pesanan as $p)
                                    <option value="{{ $p->pesanan_id }}"
                                        {{ $detailPesanan->pesanan_id == $p->pesanan_id ? 'selected' : '' }}>
                                        {{ $p->nomor_pesanan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Produk</label>
                            <select name="produk_id" class="form-select" required>
                                @foreach ($produk as $pr)
                                    <option value="{{ $pr->produk_id }}"
                                        {{ $detailPesanan->produk_id == $pr->produk_id ? 'selected' : '' }}>
                                        {{ $pr->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>Qty</label>
                            <input type="number" name="qty"
                                   class="form-control"
                                   value="{{ old('qty', $detailPesanan->qty) }}" required>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>Harga Satuan</label>
                            <input type="number" name="harga_satuan"
                                   class="form-control"
                                   value="{{ old('harga_satuan', $detailPesanan->harga_satuan) }}" required>
                        </div>

                        <div class="col-md-12 mt-4">
                            <button class="btn btn-submit me-2">
                                <i class="fe fe-save me-1"></i> Update
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
