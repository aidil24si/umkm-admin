@extends('layouts.admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="content">

            <div class="page-header">
                <div class="page-title">
                    <h4>List Pesanan</h4>
                    <h6>Kelola data pesanan</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('pesanan.create') }}" class="btn btn-added">
                        <i class="fe fe-plus me-1"></i> Tambah Pesanan
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
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>
                                        Diproses
                                    </option>
                                    <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim
                                    </option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>
                                        Dibatalkan</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                        value="{{ request('search') }}" placeholder="Cari nama pemesan..."
                                        aria-label="Search">
                                    <button type="submit" class="input-group-text" id="basic-addon2">
                                        <img src="{{ asset('assets-admin/img/icons/search-white.svg') }}" alt="img">
                                    </button>
                                    @if (request('search'))
                                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                            class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No Pesanan</th>
                                    <th>Nama Pemesan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Metode Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan as $item)
                                    <tr>
                                        <td>{{ $item->nomor_pesanan }}</td>
                                        <td>{{ $item->warga->nama ?? '-' }}</td>
                                        <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <span class="badges bg-lightyellow">Pending</span>
                                            @elseif ($item->status == 'diproses')
                                                <span class="badges bg-darkblue">Diproses</span>
                                            @elseif ($item->status == 'dikirim')
                                                <span class="badges bg-lightpurple">Dikirim</span>
                                            @elseif ($item->status == 'selesai')
                                                <span class="badges bg-lightgreen">Selesai</span>
                                            @elseif ($item->status == 'dibatalkan')
                                                <span class="badges bg-lightred">Dibatalkan</span>
                                            @else
                                                <span class="badges bg-lightgrey">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->metode_bayar }}</td>
                                        <td>
                                            <a href="{{ route('pesanan.show', $item->pesanan_id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fe fe-eye"></i>
                                            </a>
                                            <a href="{{ route('pesanan.edit', $item->pesanan_id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                            <form action="{{ route('pesanan.destroy', $item->pesanan_id) }}" method="POST"
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
                            {{ $pesanan->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
