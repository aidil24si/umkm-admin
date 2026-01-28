@extends('layouts.admin.app')
@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4>Detail Pesanan</h4>
                <h6>Informasi pesanan dan bukti pembayaran</h6>
            </div>
            <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">
                <i class="fe fe-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row">

            {{-- Informasi Pesanan --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Informasi Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr><th>No Pesanan</th><td class="fw-bold">{{ $pesanan->nomor_pesanan }}</td></tr>
                            <tr><th>Warga</th><td>{{ $pesanan->warga->nama }}</td></tr>
                            <tr><th>Total</th><td>Rp {{ number_format($pesanan->total,0,',','.') }}</td></tr>
                            <tr><th>Status</th><td><span class="badges bg-lightgreen">{{ ucfirst($pesanan->status) }}</span></td></tr>
                            <tr><th>Metode Bayar</th><td>{{ ucfirst($pesanan->metode_bayar) }}</td></tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $pesanan->alamat_kirim }}</td>
                            </tr>
                            <tr>
                                <th>RT / RW</th>
                                <td>{{ $pesanan->rt }} / {{ $pesanan->rw }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Upload Bukti --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Upload Bukti Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pesanan.uploadFoto', $pesanan->pesanan_id) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="files[]" multiple class="form-control mb-3" required>
                            <button class="btn btn-primary">
                                <i class="fe fe-upload"></i> Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Foto Bukti --}}
        <div class="card mt-4">
            <div class="card-header">
                <h5>Bukti Pembayaran</h5>
            </div>
            <div class="card-body">
                @if ($pesanan->foto->count())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Caption</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan->foto as $i => $foto)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>
                                        <img src="{{ asset('storage/pesanan_bukti/' . $foto->file_name) }}"
                                             style="width:80px;height:80px;object-fit:cover;border-radius:6px;">
                                    </td>
                                    <td>{{ $foto->caption ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('pesanan.downloadFoto', [$pesanan->pesanan_id, $foto->media_id]) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fe fe-download"></i>
                                        </a>
                                        <form action="{{ route('pesanan.hapusFoto', [$pesanan->pesanan_id, $foto->media_id]) }}"
                                              method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fe fe-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted text-center">Belum ada bukti pembayaran</p>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
