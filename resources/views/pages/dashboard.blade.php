@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="card mb-50">
                <div class="card-body">
                    <h4 class="card-title">Data Warga</h4>
                    <div class="table-responsive dataview">
                        <table class="table datanew">
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
                                                <span class="badges bg-lightblue">Laki-laki</span>
                                            @else
                                                <span class="badges bg-lightpink">Perempuan</span>
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
                    <div class="table-responsive dataview">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 text-muted" style="width: 100px;">
                                        No.
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 100px;">
                                        Kode Proyek
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 120px;">
                                        Nama Proyek
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 80px;">
                                        Tahun
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 120px;">
                                        Lokasi
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 120px;">
                                        Anggaran
                                    </th>
                                    <th scope="col" class="px-2 text-muted" style="width: 120px;">
                                        Sumber Dana
                                    </th>
                                    <th scope="col" class="px-2 text-muted deskripsi-cell">
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
                    <div class="table-responsive dataview">
                        <table class="table datanew">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataUser as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td><span class="badges bg-lightgrey">{{ $item->email }}</span></td>
                                        <td>{{ $item->password }}</td>
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
