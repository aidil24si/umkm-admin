@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            {{-- Slideshow UMKM Indonesia --}}
            <div class="card mb-4">
                <div id="umkmCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">

                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#umkmCarousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#umkmCarousel" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#umkmCarousel" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>

                    <!-- Slides -->
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="https://seleranusantara.id/wp-content/uploads/2025/07/Ilustrasi.Foto-Ari-Saputra-14.webp"
                                class="d-block w-100" style="height:420px; object-fit:cover;">
                            <div class="carousel-caption bg-dark bg-opacity-50 rounded">
                                <h5>UMKM Kuliner Nusantara</h5>
                                <p>Penggerak ekonomi rakyat Indonesia</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="https://asset.kompas.com/crops/jI-gnjUzo9fjcYqHzAKYKhNuxu0=/2x0:780x519/1200x800/data/photo/2022/07/04/62c2b31b3b5c9.jpg"
                                class="d-block w-100" style="height:420px; object-fit:cover;">
                            <div class="carousel-caption bg-dark bg-opacity-50 rounded">
                                <h5>UMKM Kerajinan Lokal</h5>
                                <p>Produk khas daerah berdaya saing global</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="https://img.antarafoto.com/cache/1200x799/2024/10/16/jumlah-umkm-go-digital-2024-1edol-dom.jpg"
                                class="d-block w-100" style="height:420px; object-fit:cover;">
                            <div class="carousel-caption bg-dark bg-opacity-50 rounded">
                                <h5>UMKM Go Digital</h5>
                                <p>Transformasi UMKM menuju ekonomi digital</p>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#umkmCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#umkmCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget">
                        <div class="dash-widgetimg">
                            <i data-feather="users"></i>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>{{ $totalUmkm }}</h5>
                            <h6>Total UMKM</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash1">
                        <div class="dash-widgetimg">
                            <i data-feather="package"></i>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>{{ $totalProduk }}</h5>
                            <h6>Total Produk</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash2">
                        <div class="dash-widgetimg">
                            <i data-feather="layers"></i>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>{{ $totalStok }}</h5>
                            <h6>Total Stok Produk</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash3">
                        <div class="dash-widgetimg">
                            <i data-feather="dollar-sign"></i>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>Rp {{ number_format($totalNilaiProduk, 0, ',', '.') }}</h5>
                            <h6>Total Nilai Produk</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Tabel Pesanan Terbaru --}}
                <div class="col-lg-7 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Pesanan Terbaru</h5>
                            <a href="{{ route('pesanan.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Warga</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pesanan as $item)
                                            <tr>
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
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada pesanan terbaru</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Ulasan Produk --}}
                <div class="col-lg-5 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Rating Produk</h4>
                            <a href="{{ route('ulasan.index') }}" class="btn btn-sm btn-outline-primary">
                                Lihat Semua
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Nama Warga</th>
                                            <th>Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ratingProduk as $rp)
                                            <tr>
                                                <td>{{ $rp->produk->nama_produk ?? '-' }}</td>
                                                <td>{{ $rp->warga->nama ?? '-' }}</td>
                                                <td>
                                                    <span class="badges bg-lightyellow">
                                                        {{ $rp->rating }} ★
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
            {{-- Data Umkm --}}
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">UMKM Terbaru</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama UMKM</th>
                                <th>Kategori</th>
                                <th>Pemilik</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($umkm as $item)
                                <tr>
                                    <td>{{ $item->nama_usaha }}</td>
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
                                    <td>{{ $item->pemilik->nama ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('umkm.index') }}" class="btn btn-sm btn-outline-primary mt-4">Lihat Semua UMKM</a>
                </div>
            </div>
            {{-- Data Produk --}}
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">Produk Terbaru</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>UMKM</th>
                                <th>Harga</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $item)
                                <tr>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->umkm->nama_usaha ?? '-' }}</td>
                                    <td><span class="badges bg-lightgreen">Rp
                                            {{ number_format($item->harga, 0, ',', '.') }}</span></td>
                                    <td>{{ $item->stok }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-primary mt-4">Lihat Semua
                        Produk</a>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
