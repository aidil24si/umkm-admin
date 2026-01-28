@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">

            <div class="page-header">
                <div class="page-title">
                    <h4>Detail UMKM</h4>
                    <h6>Informasi dan Foto UMKM</h6>
                </div>
                <a href="{{ route('umkm.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

            @php
                $alamatLengkap = $umkm->alamat . ', RT ' . $umkm->rt . ', RW ' . $umkm->rw;
            @endphp

            <div class="row">
                {{-- Informasi UMKM --}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Informasi UMKM</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Nama Usaha</th>
                                    <td>{{ $umkm->nama_usaha }}</td>
                                </tr>
                                <tr>
                                    <th>Pemilik</th>
                                    <td>{{ $umkm->pemilik->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>
                                        @if ($umkm->kategori == 'Kuliner')
                                            <span class="badges bg-lightgreen">Kuliner</span>
                                        @elseif ($umkm->kategori == 'Kerajinan')
                                            <span class="badges bg-lightpurple">Kerajinan</span>
                                        @elseif ($umkm->kategori == 'Pertanian')
                                            <span class="badges bg-lightyellow">Pertanian</span>
                                        @elseif ($umkm->kategori == 'Fashion')
                                            <span class="badges bg-lightred">Fashion</span>
                                        @else
                                            <span class="badges bg-lightgrey">{{ $item->kategori }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $umkm->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>RT / RW</th>
                                    <td>{{ $umkm->rt }} / {{ $umkm->rw }}</td>
                                </tr>
                                <tr>
                                    <th>Kontak</th>
                                    <td>{{ $umkm->kontak }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $umkm->deskripsi }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Google Map Lokasi --}}
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>Lokasi UMKM</h5>
                        </div>
                        <div class="card-body p-0">
                            <iframe width="100%" height="320" frameborder="0" style="border:0" loading="lazy"
                                allowfullscreen referrerpolicy="no-referrer-when-downgrade"
                                src="https://www.google.com/maps?q={{ urlencode($alamatLengkap) }}&output=embed">
                            </iframe>
                        </div>
                        <div class="card-footer text-muted small">
                            📍 {{ $alamatLengkap }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Upload Foto --}}
            <div class="col-lg-6 ">
                <div class="card">
                    <div class="card-header">
                        <h5>Upload Foto UMKM</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('umkm.uploadFoto', $umkm->umkm_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="files[]" multiple class="form-control mb-3" required>
                            <button class="btn btn-primary">
                                <i class="fe fe-upload"></i> Upload Foto
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Daftar Foto --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Foto UMKM</h5>
                </div>
                <div class="card-body">
                    @if ($umkm->foto->count())
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
                                @foreach ($umkm->foto as $i => $foto)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <img src="{{ asset('storage/umkm_foto/' . $foto->file_name) }}"
                                                style="width:80px;height:80px;object-fit:cover;">
                                        </td>
                                        <td>
                                            <form
                                                action="{{ route('umkm.updateCaption', [$umkm->umkm_id, $foto->media_id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="caption" class="form-control"
                                                        value="{{ $foto->caption }}">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fe fe-save"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('umkm.downloadFoto', [$umkm->umkm_id, $foto->media_id]) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fe fe-download"></i>
                                            </a>
                                            <form action="{{ route('umkm.hapusFoto', [$umkm->umkm_id, $foto->media_id]) }}"
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
                        <p class="text-muted text-center">Belum ada foto UMKM</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
