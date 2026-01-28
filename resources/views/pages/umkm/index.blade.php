@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">

            <div class="page-header">
                <div class="page-title">
                    <h4>Daftar UMKM</h4>
                    <h6>Kelola data UMKM</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('umkm.create') }}" class="btn btn-added">
                        <img src="{{ asset('assets-admin/img/icons/plus.svg') }}" class="me-1"> Tambah UMKM
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('umkm.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="kategori" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Kategori</option>
                                    <option value="Kuliner" {{ request('kategori') == 'Kuliner' ? 'selected' : '' }}>Kuliner
                                    </option>
                                    <option value="Kerajinan" {{ request('kategori') == 'Kerajinan' ? 'selected' : '' }}>
                                        Kerajinan
                                    </option>
                                    <option value="Pertanian" {{ request('kategori') == 'Pertanian' ? 'selected' : '' }}>
                                        Pertanian
                                    </option>
                                    <option value="Fashion" {{ request('kategori') == 'Fashion' ? 'selected' : '' }}>Fashion
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                        value="{{ request('search') }}" placeholder="Cari nama UMKM..." aria-label="Search">
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
                                    <th>Nama UMKM</th>
                                    <th>Pemilik</th>
                                    <th>Kategori</th>
                                    <th>Alamat</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Kontak</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($umkm as $item)
                                    <tr>
                                        <td>{{ $item->nama_usaha }}</td>
                                        <td>{{ $item->pemilik->nama ?? '-' }}</td>
                                        <td>
                                            @if ($item->kategori == 'Kuliner')
                                                <span class="badges bg-lightgreen">Kuliner</span>
                                            @elseif ($item->kategori == 'Kerajinan')
                                                <span class="badges bg-lightpurple">Kerajinan</span>
                                            @elseif ($item->kategori == 'Pertanian')
                                                <span class="badges bg-lightyellow">Pertanian</span>
                                            @elseif ($item->kategori == 'Fashion')
                                                <span class="badges bg-lightred">Fashion</span>
                                            @else
                                                <span class="badges bg-lightgrey">{{ $item->kategori }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->rt }}</td>
                                        <td>{{ $item->rw }}</</td>
                                        <td>{{ $item->kontak }}</td>
                                        <td>
                                            <a href="{{ route('umkm.show', $item->umkm_id) }}" class="btn btn-sm btn-info">
                                                <i class="fe fe-eye"></i>
                                            </a>
                                            <a href="{{ route('umkm.edit', $item->umkm_id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                            <form action="{{ route('umkm.destroy', $item->umkm_id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fe fe-trash-2"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                        {{ $umkm->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
