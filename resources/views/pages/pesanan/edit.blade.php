@extends('layouts.admin.app')
@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4>Edit Pesanan</h4>
                <h6>Perbarui data pesanan</h6>
            </div>
        </div>

        {{-- Error --}}
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
                <form action="{{ route('pesanan.update', $pesanan->pesanan_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mt-3">
                            <label>Warga</label>
                            <select name="warga_id" class="form-select" required>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}"
                                        {{ old('warga_id', $pesanan->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Total</label>
                            <input type="number" name="total"
                                   class="form-control"
                                   value="{{ old('total', $pesanan->total) }}" required>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                @foreach (['pending','diproses','selesai', 'dibatalkan', 'dikirim'] as $st)
                                    <option value="{{ $st }}"
                                        {{ old('status', $pesanan->status) == $st ? 'selected' : '' }}>
                                        {{ ucfirst($st) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Metode Bayar</label>
                            <input type="text" name="metode_bayar"
                                   class="form-control"
                                   value="{{ old('metode_bayar', $pesanan->metode_bayar) }}" required>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>Alamat Kirim</label>
                            <input type="text" name="alamat_kirim"
                                   class="form-control"
                                   value="{{ old('alamat_kirim', $pesanan->alamat_kirim) }}" required>
                        </div>

                        <div class="col-md-3 mt-3">
                            <label>RT</label>
                            <input type="text" name="rt"
                                   class="form-control"
                                   value="{{ old('rt', $pesanan->rt) }}" required>
                        </div>

                        <div class="col-md-3 mt-3">
                            <label>RW</label>
                            <input type="text" name="rw"
                                   class="form-control"
                                   value="{{ old('rw', $pesanan->rw) }}" required>
                        </div>

                        <div class="col-md-12 mt-4">
                            <button class="btn btn-submit me-2">
                                <i class="fe fe-save me-1"></i> Update
                            </button>
                            <a href="{{ route('pesanan.index') }}" class="btn btn-cancel">
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
