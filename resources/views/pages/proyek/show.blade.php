@extends('layouts.admin.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Detail Proyek</h4>
                    <h6>Informasi lengkap dan dokumen proyek</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('proyek.edit', $proyek->proyek_id) }}" class="btn btn-edit me-2">
                        <i class="fe fe-edit"></i> Edit Proyek
                    </a>
                    <a href="{{ route('proyek.index') }}" class="btn btn-secondary">
                        <i class="fe fe-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            {{-- Notifikasi --}}
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
                {{-- Informasi Proyek --}}
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-light py-3">
                            <h5 class="card-title mb-0"><i class="fe fe-info me-2"></i>Informasi Proyek</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="w-40 ps-0">Kode Proyek</th>
                                            <td class="fw-bold">{{ $proyek->kode_proyek }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0">Nama Proyek</th>
                                            <td>{{ $proyek->nama_proyek }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0">Tahun</th>
                                            <td><span class="badge bg-primary">{{ $proyek->tahun }}</span></td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0">Lokasi</th>
                                            <td>{{ $proyek->lokasi }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0">Anggaran</th>
                                            <td><span class="badges bg-lightgreen">Rp
                                                    {{ number_format($proyek->anggaran, 2, ',', '.') }}</span></td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0">Sumber Dana</th>
                                            <td>{{ $proyek->sumber_dana }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0 align-top">Deskripsi</th>
                                            <td class="px-2 deskripsi-cell">{{ $proyek->deskripsi }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Upload Dokumen --}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Upload Dokumen Proyek</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('proyek.uploadDokumen', $proyek->proyek_id) }}" method="POST"
                                enctype="multipart/form-data" id="uploadForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="files" class="form-label">Pilih File</label>
                                    <input type="file" class="form-control" id="files" name="files[]" multiple
                                        required accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.gif">
                                    <div class="form-text">
                                        Format: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG, GIF. Maksimal 2MB per file.
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

            {{-- Daftar Dokumen --}}
            <div class="card">
                <div class="card-header bg-light py-3">
                    <h5 class="card-title mb-0"><i class="fe fe-file me-2"></i>Dokumen Proyek</h5>
                </div>
                <div class="card-body p-4">
                    @if ($proyek->dokumen->count() > 0)
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
                                    @foreach ($proyek->dokumen as $index => $dokumen)
                                        @php
                                            $filePath = storage_path('app/public/proyek_files/' . $dokumen->file_name);
                                            $fileSize = file_exists($filePath)
                                                ? round(filesize($filePath) / 1024, 2)
                                                : 0;
                                            $fileExt = strtoupper(pathinfo($dokumen->file_name, PATHINFO_EXTENSION));
                                        @endphp
                                        <tr>
                                            <td class="ps-3">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    {{-- TAMPILKAN THUMBNAIL JIKA GAMBAR --}}
                                                    @if ($dokumen->file_type == 'image')
                                                        <div class="me-3">
                                                            <img src="{{ $dokumen->file_url }}"
                                                                alt="{{ $dokumen->caption ?? 'Gambar dokumen' }}"
                                                                class="img-thumbnail"
                                                                style="width: 50px; height: 50px; object-fit: cover;">
                                                        </div>
                                                    @else
                                                        <div class="me-3">
                                                            <i class="{{ $dokumen->file_icon }}"
                                                                style="font-size: 1.5rem;"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="fw-medium text-truncate" style="max-width: 200px;">
                                                            {{ $dokumen->display_name }}
                                                        </div>
                                                        <small
                                                            class="text-muted">.{{ strtolower($dokumen->file_extension) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{ in_array($fileExt, ['JPG', 'JPEG', 'PNG', 'GIF']) ? 'bg-info' : 'bg-warning' }}">
                                                    {{ $fileExt }}
                                                </span>
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('proyek.updateCaption', [$proyek->proyek_id, $dokumen->media_id]) }}"
                                                    method="POST" class="d-inline-block w-100">
                                                    @csrf
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="caption"
                                                            class="form-control form-control-sm border-end-0"
                                                            value="{{ $dokumen->caption ?? '' }}"
                                                            placeholder="Tambahkan caption">
                                                        <button type="submit"
                                                            class="btn btn-outline-primary btn-sm border" title="Simpan">
                                                            <i class="fe fe-save"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <span class="text-muted">{{ $fileSize }} KB</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    @if ($dokumen->file_type == 'image')
                                                        <a href="{{ $dokumen->file_url }}"
                                                            class="btn btn-outline-info border" target="_blank"
                                                            data-bs-toggle="tooltip" title="Lihat Gambar">
                                                            <i class="fe fe-eye"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('proyek.downloadDokumen', [$proyek->proyek_id, $dokumen->media_id]) }}"
                                                        class="btn btn-outline-primary border" data-bs-toggle="tooltip"
                                                        title="Download">
                                                        <i class="fe fe-download"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('proyek.hapusDokumen', [$proyek->proyek_id, $dokumen->media_id]) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger border"
                                                            data-bs-toggle="tooltip" title="Hapus">
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
