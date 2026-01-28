<footer class="footer mt-auto bg-white border-top">
    <div class="page-wrapper px-lg-5 px-4">
        <div class="row py-5">
            <div class="col-lg-4 col-md-12 mb-5 mb-lg-0">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('assets-admin/img/logo-kecil.jpeg') }}" alt="Logo UMKM"
                         class="rounded shadow-sm me-3" style="width: 60px; height: 60px; object-fit: cover;">
                    <h3 class="fw-bold mb-0 text-dark tracking-tight">UMKM Kita</h3>
                </div>
                <p class="text-muted lh-lg mb-4" style="max-width: 350px;">
                    Memberdayakan potensi lokal melalui sistem monitoring modern dan promosi produk unggulan Desa Balam Sempurna.
                </p>

                <div class="card border-0 bg-light rounded-4 overflow-hidden shadow-sm" style="max-width: 320px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                <i class="fas fa-user-tie text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Aidil Ikhsan</h6>
                                <small class="text-muted">Lead Developer</small>
                            </div>
                        </div>
                        <a href="{{ route('profile') }}" class="btn btn-primary btn-sm w-100 rounded-pill shadow-sm">
                            <i class="fas fa-external-link-alt me-1 small"></i> Lihat Profile Pengembang
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h6 class="text-uppercase fw-bold mb-4 text-dark small tracking-wider">Navigasi</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-3">
                        <a href="{{ route('dashboard.index') }}" class="text-decoration-none text-muted hover-primary">
                            Dashboard
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('user.index') }}" class="text-decoration-none text-muted hover-primary">
                            Data User
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('warga.index') }}" class="text-decoration-none text-muted hover-primary">
                            Data Warga
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('umkm.index') }}" class="text-decoration-none text-muted hover-primary">
                            Manajemen UMKM
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('produk.index') }}" class="text-decoration-none text-muted hover-primary">
                            Katalog Produk
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                <h6 class="text-uppercase fw-bold mb-4 text-dark small tracking-wider">Hubungi Kami</h6>
                <div class="d-flex mb-3">
                    <i class="fas fa-envelope text-primary mt-1 me-3"></i>
                    <span class="text-muted small">aidil24si@mahasiswa.pcr.ac.id</span>
                </div>
                <div class="d-flex mb-4">
                    <i class="fas fa-phone-alt text-primary mt-1 me-3"></i>
                    <span class="text-muted small">0813-6645-8977</span>
                </div>

                <h6 class="text-uppercase fw-bold mb-3 text-dark small tracking-wider">Media Sosial</h6>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle border-light shadow-sm bg-white social-hover" style="width: 36px; height: 36px; display: grid; place-items: center;">
                        <i class="fab fa-facebook-f fs-6"></i>
                    </a>
                    <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle border-light shadow-sm bg-white social-hover" style="width: 36px; height: 36px; display: grid; place-items: center;">
                        <i class="fab fa-instagram fs-6"></i>
                    </a>
                    <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle border-light shadow-sm bg-white social-hover" style="width: 36px; height: 36px; display: grid; place-items: center;">
                        <i class="fab fa-youtube fs-6"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4">
                <h6 class="text-uppercase fw-bold mb-4 text-dark small tracking-wider">Informasi Sistem</h6>
                <div class="bg-light p-3 rounded-4 border">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 me-2">
                            <i class="fas fa-check-circle me-1"></i> Versi 2.1.0
                        </span>
                    </div>
                    <div class="small text-muted border-bottom pb-2 mb-2">
                        <i class="fas fa-shield-alt me-2 text-primary"></i> SSL 256-bit Encrypted
                    </div>
                    <div class="small text-muted">
                        <i class="fas fa-database me-2 text-primary"></i> Real-time Sync Active
                    </div>
                </div>
            </div>
        </div>

        <div class="row py-4 border-top align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-muted small mb-0">
                    &copy; <script>document.write(new Date().getFullYear())</script>
                    <strong>UMKM Kita</strong>. Semua Hak Dilindungi.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <span class="text-muted small">
                    <i class="fas fa-university me-1 text-primary"></i> UMKM Kita Bersama
                </span>
            </div>
        </div>
    </div>
</footer>

<style>
    .hover-primary:hover { color: #0d6efd !important; transition: 0.3s; }
    .social-hover:hover { background-color: #0d6efd !important; color: white !important; border-color: #0d6efd !important; transition: 0.3s; }
    .footer-links a { font-size: 0.9rem; }
    .tracking-wider { letter-spacing: 0.05em; }
</style>
