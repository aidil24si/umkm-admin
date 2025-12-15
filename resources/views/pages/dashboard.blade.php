@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            {{-- Slideshow Proyek Desa --}}
            <div class="card mb-4">
                <div id="desaCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner rounded">
                        {{-- Slide 1 --}}
                        <div class="carousel-item active">
                            <img src="https://lintasbalikpapan.com/wp-content/uploads/2024/12/IMG-20241209-WA0298.jpg"
                                class="d-block w-100" style="height:420px; object-fit:cover;" alt="Proyek Desa">
                            <div class="carousel-caption bg-dark bg-opacity-50 rounded px-3 py-2">
                                <h5>Pembangunan Infrastruktur Desa</h5>
                                <p>Sekolah dan fasilitas desa</p>
                            </div>
                        </div>

                        {{-- Slide 2 --}}
                        <div class="carousel-item">
                            <img src="https://cms.disway.id/uploads/0f59c2bba3c652a2e8b386fa3493233f.jpeg"
                                class="d-block w-100" style="height:420px; object-fit:cover;" alt="Pembangunan">
                            <div class="carousel-caption bg-dark bg-opacity-50 rounded px-3 py-2">
                                <h5>Pelaksanaan Proyek Desa</h5>
                                <p>Transparan, terencana, dan berkelanjutan</p>
                            </div>
                        </div>

                        {{-- Slide 3 --}}
                        <div class="carousel-item">
                            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEivpZBFDRHlYDFWV03UE5TLVG-t_WJXgts7JXdSVpdlN_xXyzN-N_IaHrtSfrHYD8W-3I-g3YC4rBeI7nQ60it1o86aKvSQs66Rao57croZPNFQMUXpoqhbMcz6l8n0k5JrfBqyUU8-GXk6QIHZ5UFhqfqhvXjDUlgpt9RxchPGZGjB-RAx2OIpu3JQ16Au/s16000/IMG-20240609-WA0049.jpg"
                                class="d-block w-100" style="height:420px; object-fit:cover;" alt="Partisipasi Warga">
                            <div class="carousel-caption bg-dark bg-opacity-50 rounded px-3 py-2">
                                <h5>Partisipasi Masyarakat Desa</h5>
                                <p>Warga terlibat aktif dalam pembangunan</p>
                            </div>
                        </div>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#desaCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#desaCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>

                </div>
            </div>
            <div class="row">
                {{-- Total Pembayaran --}}
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget">
                        <div class="dash-widgetimg">
                            <span><img src="{{ asset('assets-admin/img/icons/dash1.svg') }}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>Rp.<span class="counters">307.000.144.00</span></h5>
                            <h6>Total Pembayaran</h6>
                        </div>
                    </div>
                </div>
                {{-- Total Anggaran --}}
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash1">
                        <div class="dash-widgetimg">
                            <span><img src="{{ asset('assets-admin/img/icons/dash2.svg') }}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>
                                Rp.<span class="counters">{{ number_format($totalAnggaran, 2, ',', '.') }}</span>
                            </h5>
                            <h6>Total Anggaran</h6>
                        </div>
                    </div>
                </div>
                {{-- Total Pemasukan --}}
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash2">
                        <div class="dash-widgetimg">
                            <span><img src="{{ asset('assets-admin/img/icons/dash3.svg') }}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>Rp.<span class="counters">385.000.656.50</span></h5>
                            <h6>Total Pemasukan</h6>
                        </div>
                    </div>
                </div>
                {{-- Total Pengeluaran --}}
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash3">
                        <div class="dash-widgetimg">
                            <span><img src="{{ asset('assets-admin/img/icons/dash4.svg') }}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>Rp.<span class="counters">400.000.000.00</span></h5>
                            <h6>Total Pengeluaran</h6>
                        </div>
                    </div>
                </div>
                {{-- Jumlah Warga --}}
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>100</h4>
                            <h5>Warga</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                </div>
                {{-- Jumlah Proyek --}}
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <h4>100</h4>
                            <h5>Proyek</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user-check"></i>
                        </div>
                    </div>
                </div>
                {{-- Jumlah Lokasi --}}
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das2">
                        <div class="dash-counts">
                            <h4>100</h4>
                            <h5>Lokasi Proyek</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file-text"></i>
                        </div>
                    </div>
                </div>
                {{-- Jumlah Kontraktor --}}
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das3">
                        <div class="dash-counts">
                            <h4>105</h4>
                            <h5>Kontraktor</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- Grafik --}}
                <div class="col-lg-7 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Progres Proyek</h5>
                            <div class="graph-sets">
                                <ul>
                                    <li>
                                        <span>Selesai</span>
                                    </li>
                                    <li>
                                        <span>Tertunda</span>
                                    </li>
                                </ul>
                                <div class="dropdown">
                                    <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        2022 <img src="{{ asset('assets-admin/img/icons/dropdown.svg') }}" alt="img"
                                            class="ms-2">
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">2020</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="sales_charts"></div>
                        </div>
                    </div>
                </div>
                {{-- Tahapan Proyek --}}
                <div class="col-lg-5 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Tahapan Proyek</h4>
                            <div class="dropdown">
                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"
                                    class="dropset">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="{{ route('tahapan.index') }}" class="dropdown-item">Lihat Detail</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('tahapan.create') }}" class="dropdown-item">Tambah Tahapan
                                            Proyek</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datanew table-striped mb-0 ">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Tahapan</th>
                                            <th>Target Persen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataTahapan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_tahap }}</td>
                                                <td>{{ number_format($item->target_persen, 2) }}%</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Data Warga --}}
            <div class="card mb-50">
                <div class="card-body">
                    <h4 class="card-title">Data Warga</h4>
                    <div class="table-responsive">
                        <table class="table datanew table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        No.
                                    </th>
                                    <th>
                                        NIK
                                    </th>
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Jenis Kelamin
                                    </th>
                                    <th>
                                        Agama
                                    </th>
                                    <th>
                                        Pekerjaan
                                    </th>
                                    <th>
                                        No HP
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataWarga as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_ktp }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            @if ($item->jenis_kelamin == 'Laki-laki')
                                                <span class="badges bg-darkblue">Laki-laki</span>
                                            @else
                                                <span class="badges bg-darkpink">Perempuan</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->agama }}</td>
                                        <td>{{ $item->pekerjaan }}</td>
                                        <td>{{ $item->telp }}</td>
                                        <td><span class="badges bg-lightgrey">{{ $item->email }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Data Proyek --}}
            <div class="card mb-50">
                <div class="card-body">
                    <h4 class="card-title">Data Proyek</h4>
                    <div class="table-responsive">
                        <table class="table datanew table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        No.
                                    </th>
                                    <th>
                                        Kode Proyek
                                    </th>
                                    <th>
                                        Nama Proyek
                                    </th>
                                    <th>
                                        Tahun
                                    </th>
                                    <th>
                                        Lokasi
                                    </th>
                                    <th>
                                        Anggaran
                                    </th>
                                    <th>
                                        Sumber Dana
                                    </th>
                                    <th class="px-2 text-muted deskripsi-cell">
                                        Deskripsi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataProyek as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="px-2">{{ $item->kode_proyek }}</td>
                                        <td class="px-2">{{ $item->nama_proyek }}</td>
                                        <td class="px-2">{{ $item->tahun }}</td>
                                        <td class="px-2">{{ $item->lokasi }}</td>
                                        <td class="px-2"><span class="badges bg-lightgreen">Rp
                                                {{ number_format($item->anggaran, 2, ',', '.') }}
                                            </span></td>
                                        <td class="px-2">{{ $item->sumber_dana }}</td>
                                        <td class="px-2 deskripsi-cell">{{ $item->deskripsi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Data User --}}
            <div class="card mb-50">
                <div class="card-body">
                    <h4 class="card-title">Data User</h4>
                    <div class="table-responsive">
                        <table class="table datanew table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Foto</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataUser as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item->profile_picture)
                                                <div class="position-relative">
                                                    <img src="{{ asset('storage/' . $item->profile_picture) }}"
                                                        class="rounded-circle border border-3 border-white shadow-sm"
                                                        style="width: 48px; height: 48px; object-fit: cover; background: #f8f9fa;">
                                                </div>
                                            @else
                                                <div class="position-relative">
                                                    <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 48px; height: 48px; background: ;">
                                                        <i data-feather="user" style="width: 32px; height: 32px;"></i>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td><span class="badges bg-lightgrey">{{ $item->email }}</span></td>
                                        <td>
                                            <div class="password-field">
                                                <span class="password-text">••••••••</span>
                                                <small class="text-muted d-block">Hashed</small>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $roleColors = [
                                                    'Super Admin' => 'bg-danger',
                                                    'Admin' => 'bg-success',
                                                    'Company' => 'bg-info',
                                                ];
                                            @endphp
                                            <span class="badges {{ $roleColors[$item->role] ?? 'bg-secondary' }}">
                                                {{ $item->role }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
