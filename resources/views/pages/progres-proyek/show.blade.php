@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Detail Progres Proyek</h4>
                    <h6>Informasi lengkap dan foto progres</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('progres.edit', $progres->progres_id) }}" class="btn btn-edit me-2">
                        <i class="fe fe-edit"></i> Edit Progres
                    </a>
                    <a href="{{ route('progres.index') }}" class="btn btn-secondary">
                        <i class="fe fe-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-light py-3">
                            <h5 class="card-title mb-0"><i class="fe fe-info me-2"></i>Informasi Progres</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="w-40 ps-0">Proyek</th>
                                            <td class="fw-bold">{{ $progres->proyek->nama_proyek }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0">Tahap</th>
                                            <td>{{ $progres->tahapan->nama_tahap }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0">Persen Real</th>
                                            <td><span class="badges bg-lightgreen">{{ $progres->persen_real }}%</span></td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0">Tanggal</th>
                                            <td><span class="badge bg-primary">{{ \Carbon\Carbon::parse($progres->tanggal)->format('d/m/Y') }}</span></td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0 align-top">Catatan</th>
                                            <td class="px-2 catatan-cell">{{ $progres->catatan }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Upload Foto Progres</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('progres-proyek.uploadFoto', $progres->progres_id) }}" method="POST"
                                enctype="multipart/form-data" id="uploadForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="files" class="form-label">Pilih File</label>
                                    <input type="file" class="form-control" id="files" name="files[]" multiple
                                        required accept=".jpg,.jpeg,.png,.gif,.webp,.bmp,.svg,.tiff,.heic,.heif">
                                    <div class="form-text">
                                        Format: JPG, JPEG, PNG, GIF, WEBP, BMP, SVG, TIFF, HEIC, HEIF. Maksimal 2MB per file.
                                    </div>
                                </div>
                                
                                <div id="captionContainer"></div>

                                <button type="submit" class="btn btn-primary" id="uploadBtn">
                                    <i class="fe fe-upload"></i> Upload Files
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-light py-3">
                    <h5 class="card-title mb-0"><i class="fe fe-image me-2"></i>Foto Progres</h5>
                </div>
                <div class="card-body p-4">
                    @if ($progres->foto->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="ps-3">No</th>
                                        <th width="25%">Nama File</th>
                                        <th width="10%">Tipe</th>
                                        <th width="25%">Caption</th>
                                        <th width="15%">Ukuran</th>
                                        <th width="20%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($progres->foto as $index => $foto)
                                        @php
                                            $filePath = storage_path('app/public/progres_proyek_files/' . $foto->file_name);
                                            $fileSize = file_exists($filePath) ? round(filesize($filePath) / 1024, 2) : 0;
                                            $fileExt = strtoupper(pathinfo($foto->file_name, PATHINFO_EXTENSION));
                                        @endphp
                                        <tr>
                                            <td class="ps-3">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ Storage::url('progres_proyek_files/' . $foto->file_name) }}"
                                                         alt="thumb" style="width:70px; height:70px; object-fit:cover; border-radius:6px;">
                                                    <span class="text-truncate" style="max-width: 200px;">
                                                        {{ pathinfo($foto->file_name, PATHINFO_FILENAME) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $fileExt }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('progres-proyek.updateCaption', [$progres->progres_id, $foto->media_id]) }}"
                                                    method="POST" class="d-inline-block w-100">
                                                    @csrf
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="caption"
                                                            class="form-control form-control-sm border-end-0"
                                                            value="{{ $foto->caption ?? '' }}" placeholder="Tambahkan caption">
                                                        <button type="submit" class="btn btn-outline-primary btn-sm border" title="Simpan">
                                                            <i class="fe fe-save"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td><span class="text-muted">{{ $fileSize }} KB</span></td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ Storage::url('progres_proyek_files/' . $foto->file_name) }}"
                                                        class="btn btn-outline-info border" target="_blank" title="Lihat Gambar">
                                                        <i class="fe fe-eye"></i>
                                                    </a>
                                                    <a href="{{ route('progres-proyek.downloadFoto', [$progres->progres_id, $foto->media_id]) }}"
                                                        class="btn btn-outline-primary border" title="Download">
                                                        <i class="fe fe-download"></i>
                                                    </a>
                                                    <form action="{{ route('progres-proyek.hapusFoto', [$progres->progres_id, $foto->media_id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger border" title="Hapus">
                                                            <i class="fe fe-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fe fe-file-text display-4 text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-3">Belum ada dokumen</h5>
                            <p class="text-muted">Upload dokumen untuk proyek ini menggunakan form di atas.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
