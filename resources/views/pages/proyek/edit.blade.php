@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Tambah Proyek</h4>
                    <h6>Membuat data proyek</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('proyek.update', $dataProyek->proyek_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="kode_proyek" class="form-label">Kode Proyek</label>
                                    <input type="text" class="form-control" id="kode_proyek" name="kode_proyek"
                                        placeholder="Masukkan kode proyek" required value="{{ $dataProyek->kode_proyek }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="nama_proyek" class="form-label">Nama Proyek</label>
                                    <input type="text" class="form-control" id="nama_proyek" name="nama_proyek"
                                        placeholder="Masukkan nama proyek" required value="{{ $dataProyek->nama_proyek }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input type="number" class="form-control" id="tahun" name="tahun"
                                        placeholder="Masukkan tahun proyek" required min="1900"
                                        max="{{ date('Y') + 1 }}" value="{{ $dataProyek->tahun }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi"
                                        placeholder="Masukkan lokasi proyek" required value="{{ $dataProyek->lokasi }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="anggaran" class="form-label">Anggaran</label>
                                    <input type="number" step="0.01" class="form-control" id="anggaran" name="anggaran"
                                        placeholder="Masukkan anggaran proyek" required value="{{ $dataProyek->anggaran }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="sumber_dana" class="form-label">Sumber Dana</label>
                                    <input type="text" class="form-control" id="sumber_dana" name="sumber_dana"
                                        placeholder="Masukkan sumber dana" required value="{{ $dataProyek->sumber_dana }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi proyek"
                                        required>{{ $dataProyek->deskripsi }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button href="javascript:void(0);" type="submit" class="btn btn-submit me-2">Update
                                    Data
                                </button>
                                <a href="{{ route('proyek.index') }}" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
