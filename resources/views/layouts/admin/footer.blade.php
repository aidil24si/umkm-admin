<footer class="footer mt-auto">
    <div class="page-wrapper">
        <div class="container-fluid px-4">
            <!-- Bagian Utama Footer -->
            <div class="row py-4 border-top border-bottom">
                <!-- Kolom 1: Logo dan Deskripsi Sistem -->
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="d-flex align-items-start">
                        <div class="bg-primary rounded-3 p-3 me-3 shadow-sm">
                            <i class="fas fa-hard-hat text-white fs-4"></i>
                        </div>

                        <div>
                            <h4 class="fw-bold mb-1 text-dark">ProyekDesa Track</h4>
                            <p class="text-muted mb-4">
                                Sistem Monitoring Proyek Pembangunan Desa
                            </p>

                            {{-- PROFILE PENGEMBANG --}}
                            <div class="bg-white border rounded-4 p-4 mt-4 shadow-sm">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-user-circle text-primary fs-3 me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-0">Profile Pengembang</h6>
                                        <small class="text-muted">Lihat detail pembuat sistem</small>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('profile') }}" class="btn btn-warning btn-sm rounded-pill px-4">
                                        Lihat Profile
                                        <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom 2: Menu Cepat -->
                <div class="col-lg-2 col-md-6 col-sm-6 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3 text-dark">Menu Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('dashboard.index') }}" class="text-decoration-none text-dark">
                                <i class="fas fa-home me-2 text-primary"></i>Dashboard
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('user.index') }}" class="text-decoration-none text-dark">
                                <i class="fas fa-user me-2 text-primary"></i>Data User
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('warga.index') }}" class="text-decoration-none text-dark">
                                <i class="fas fa-users me-2 text-primary"></i>Data Warga
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('proyek.index') }}" class="text-decoration-none text-dark">
                                <i class="fe fe-map me-2 text-primary"></i>Proyek
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('tahapan.index') }}" class="text-decoration-none text-dark">
                                <i class="fas fa-project-diagram me-2 text-primary"></i>Tahapan Proyek
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 3: Kontak & Media Sosial -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3 text-dark">Hubungi Kami</h5>
                    <div class="mb-3">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <span class="text-dark">dzikri24si@mahasiswa.pcr.ac.id</span>
                    </div>
                    <div class="mb-4">
                        <i class="fas fa-phone text-primary me-2"></i>
                        <span class="text-dark">0896-5322-1383</span>
                    </div>

                    <h5 class="fw-bold mb-3 text-dark">Media Sosial</h5>
                    <div class="social-links">
                        <a href="#" class="btn btn-light btn-sm rounded-circle me-2 shadow-sm" title="Facebook">
                            <i class="fab fa-facebook-f text-primary"></i>
                        </a>
                        <a href="#" class="btn btn-light btn-sm rounded-circle me-2 shadow-sm" title="Twitter">
                            <i class="fab fa-twitter text-info"></i>
                        </a>
                        <a href="#" class="btn btn-light btn-sm rounded-circle me-2 shadow-sm" title="Instagram">
                            <i class="fab fa-instagram text-danger"></i>
                        </a>
                        <a href="#" class="btn btn-light btn-sm rounded-circle shadow-sm" title="YouTube">
                            <i class="fab fa-youtube text-danger"></i>
                        </a>
                    </div>
                </div>

                <!-- Kolom 4: Info Sistem -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm bg-light">
                        <div class="card-body p-3">
                            <h5 class="fw-bold mb-3 text-dark">Info Sistem</h5>
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-code text-success"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-semibold">Versi 2.1.0</p>
                                    <small class="text-muted">Terbaru</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-shield-alt text-warning"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-semibold">Keamanan Terenkripsi</p>
                                    <small class="text-muted">SSL 256-bit</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-database text-info"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-semibold">Database Terpusat</p>
                                    <small class="text-muted">Real-time sync</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Bawah Footer -->
            <div class="row py-3">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <!-- Copyright -->
                        <div class="mb-2 mb-md-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-copyright text-muted me-2"></i>
                                <span class="text-muted">
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                    Semua Hak Dilindungi.
                                </span>
                            </div>
                        </div>

                        <!-- Garis Pemisah -->
                        <div class="d-none d-md-block mx-3">
                            <span class="text-muted">|</span>
                        </div>

                        <!-- Informasi Pengembang -->
                        <div class="text-center text-md-end mb-2 mb-md-0">
                            <div
                                class="d-flex align-items-center justify-content-center justify-content-md-end flex-wrap">
                                <i class="fas fa-laptop-code text-primary me-2"></i>
                                <span class="text-dark">
                                    Dikembangkan oleh
                                    <a href="{{ route('profile') }}"
                                        class="text-decoration-none fw-bold text-primary">
                                        Dzikri Maulana
                                    </a>
                                </span>
                            </div>
                        </div>

                        <!-- Garis Pemisah -->
                        <div class="d-none d-md-block mx-3">
                            <span class="text-muted">|</span>
                        </div>

                        <!-- Informasi Institusi -->
                        <div class="mb-2 mb-md-0 text-center text-md-start">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                <i class="fas fa-university text-primary me-2"></i>
                                <span class="text-dark fw-semibold">
                                    Pembangunan dan Monitoring Proyek Desa Balam Sempurna
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
