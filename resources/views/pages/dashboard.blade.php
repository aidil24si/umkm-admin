@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget">
                        <div class="dash-widgetimg">
                            <span><img src="{{asset('assets-admin/img/icons/dash1.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>Rp.<span class="counters">307.000.144.00</span></h5>
                            <h6>Total Pembayaran</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash1">
                        <div class="dash-widgetimg">
                            <span><img src="{{asset('assets-admin/img/icons/dash2.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>Rp.<span class="counters">400.000.385.00</span></h5>
                            <h6>Total Anggaran</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash2">
                        <div class="dash-widgetimg">
                            <span><img src="{{asset('assets-admin/img/icons/dash3.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>Rp.<span class="counters">385.000.656.50</span></h5>
                            <h6>Total Pemasukan</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash3">
                        <div class="dash-widgetimg">
                            <span><img src="{{asset('assets-admin/img/icons/dash4.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>Rp.<span class="counters">400.000.000.00</span></h5>
                            <h6>Total Pengeluaran</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>100</h4>
                            <h5>Customers</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <h4>100</h4>
                            <h5>Suppliers</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user-check"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das2">
                        <div class="dash-counts">
                            <h4>100</h4>
                            <h5>Purchase Invoice</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file-text"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das3">
                        <div class="dash-counts">
                            <h4>105</h4>
                            <h5>Sales Invoice</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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
                                        <a href="{{ route('tahapan.create') }}" class="dropdown-item">Tambah Tahapan Proyek</a>
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
            <div class="card mb-50">
                <div class="card-body">
                    <h4 class="card-title">Data User</h4>
                    <div class="table-responsive">
                        <table class="table datanew table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        No.
                                    </th>
                                    <th>
                                        Username
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Password
                                    </th>
                                    <th>
                                        Role
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataUser as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td><span class="badges bg-lightgrey">{{ $item->email }}</span></td>
                                        <td>{{ $item->password }}</td>
                                        <td>{{ $item->role }}</td>
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
