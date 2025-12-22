@extends('layouts.admin.app')

@section('content')
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">

                {{-- Page Header --}}
                <div class="page-header mb-4">
                    <div class="page-title">
                        <h4>Profile Pengembang</h4>
                        <h6>Mengenal Developer Sistem</h6>
                    </div>
                </div>

                {{-- Profile Card --}}
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center" style="min-height: 70vh;">

                            {{-- LEFT COLUMN --}}
                            <div class="col-lg-4 text-center border-end">
                                <img src="{{asset('assets-admin/img/FOTO GUA.jpg')}}"
                                    class="rounded-circle mb-3" width="160" height="160" style="object-fit: cover;"
                                    alt="Profile">

                                <h3 class="fw-bold">Dzikri Maulana</h3>
                                <span class="badge bg-primary mb-2">Full Stack Developer</span>

                                <p class="text-muted mt-3">
                                    “Jangan pernah takut menghadapi masalah,
                                    karena dari sanalah kita belajar.”
                                </p>

                                {{-- Social Media --}}
                                <div class="social-links">
                                    <a href="https://github.com/dzikripcr" class="text-dark fs-4 btn btn-light btn-sm rounded-circle me-2 shadow-sm"><i class="fab fa-github"></i></a>
                                    <a href="https://www.linkedin.com/in/dzikri-maulana-952134381" class="text-primary fs-4 btn btn-light btn-sm rounded-circle me-2 shadow-sm"><i class="fab fa-linkedin"></i></a>
                                    <a href="https://www.instagram.com/dziikrri._08?igsh=MXEyeW52bW43NHkyOA==" class="text-danger fs-4 btn btn-light btn-sm rounded-circle me-2 shadow-sm"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>

                            {{-- RIGHT COLUMN --}}
                            <div class="col-lg-8 ps-4">
                                <h5 class="fw-bold mb-2">👨‍💻 Tentang Saya</h5>
                                <p class="text-muted">
                                    Saya adalah pengembang aplikasi yang fokus pada pengembangan
                                    sistem berbasis web menggunakan Laravel. Terbiasa membangun
                                    aplikasi yang rapi, aman, dan scalable.
                                </p>

                                <hr>

                                <h5 class="fw-bold mb-3">🚀 Skill</h5>
                                <div class="mb-3">
                                    <span class="badge bg-dark me-2 mb-2">Laravel</span>
                                    <span class="badge bg-dark me-2 mb-2">PHP</span>
                                    <span class="badge bg-dark me-2 mb-2">MySQL</span>
                                    <span class="badge bg-dark me-2 mb-2">REST API</span>
                                    <span class="badge bg-dark me-2 mb-2">Bootstrap</span>
                                    <span class="badge bg-dark me-2 mb-2">Git</span>
                                </div>

                                <hr>

                                <h5 class="fw-bold mb-3">📌 Informasi</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <p><strong>Nama Lengkap :</strong><br>Dzikri Maulana</p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <p><strong>Email :</strong><br>dzikri24si@mahasiswa.pcr.ac.id</p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <p><strong>NIM :</strong><br>2457301037</p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <p><strong>Role :</strong><br>Super Admin / Developer</p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <p><strong>Kelas :</strong><br>2 SI B</p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <p><strong>Prodi :</strong><br>D4 Sistem Informasi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
