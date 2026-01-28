@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">

            <div class="page-header">
                <div class="page-title">
                    <h4>Tambah Pesanan</h4>
                    <h6>Membuat data pesanan baru</h6>
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
                    <form action="{{ route('pesanan.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mt-3">
                                <label>Nomor Pesanan</label>
                                <input type="text" name="nomor_pesanan" class="form-control"
                                    value="{{ old('nomor_pesanan') }}" required>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Warga</label>
                                <select name="warga_id" class="form-select" required>
                                    <option value="">-- Pilih Warga --</option>
                                    @foreach ($warga as $w)
                                        <option value="{{ $w->warga_id }}"
                                            {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Total</label>
                                <input type="number" name="total" class="form-control" value="{{ old('total') }}"
                                    required>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="pending">Pending</option>
                                    <option value="diproses">Diproses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dikirim">Dikirim</option>
                                    <option value="dibatalkan">Dibatalkan</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Metode Bayar</label>
                                <select name="metode_bayar" class="form-select" required>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                    <option value="Cash">Cash</option>
                                    <option value="QRIS">QRIS</option>
                                    <option value="W-Wallet">E-Wallet</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Alamat Kirim</label>
                                <input type="text" name="alamat_kirim" class="form-control"
                                    value="{{ old('alamat_kirim') }}" required>
                            </div>

                            <div class="col-md-3 mt-3">
                                <label>RT</label>
                                <input type="text" name="rt" class="form-control" value="{{ old('rt') }}"
                                    required>
                            </div>

                            <div class="col-md-3 mt-3">
                                <label>RW</label>
                                <input type="text" name="rw" class="form-control" value="{{ old('rw') }}"
                                    required>
                            </div>

                            <div class="col-md-12 mt-4">
                                <button class="btn btn-submit me-2">
                                    <i class="fe fe-save me-1"></i> Simpan
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
