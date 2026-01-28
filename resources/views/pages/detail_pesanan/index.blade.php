@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content">

            <div class="page-header">
                <div class="page-title">
                    <h4>List Detail Pesanan</h4>
                    <h6>Kelola data detail pesanan</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('detail.create') }}" class="btn btn-added">
                        <i class="fe fe-plus me-1"></i> Tambah Detail
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <form method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="pesanan_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Pesanan</option>
                                    @foreach ($detailPesanan as $dp)
                                        <option value="{{ $dp->pesanan_id }}"
                                            {{ request('pesanan_id') == $dp->pesanan_id ? 'selected' : '' }}>
                                            {{ $dp->pesanan->nomor_pesanan ?? '-' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari qty / harga / subtotal" value="{{ request('search') }}">
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No Pesanan</th>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailPesanan as $item)
                                    <tr>
                                        <td>{{ $item->pesanan->nomor_pesanan ?? '-' }}</td>
                                        <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                        <td><span class="badges bg-lightgreen">Rp
                                                {{ number_format($item->subtotal, 0, ',', '.') }}</span>`</td>
                                        <td>
                                            <a href="{{ route('detail.edit', $item->detail_id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                            <form action="{{ route('detail.destroy', $item->detail_id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fe fe-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $detailPesanan->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
