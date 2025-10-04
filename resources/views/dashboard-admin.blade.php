<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Monitoring Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c5f2d;
            --secondary-color: #97bc62;
            --accent-color: #204529;
            --light-bg: #f8f9fa;
            --dark-bg: #1a1a1a;
            --text-light: #ffffff;
            --text-dark: #333333;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        /* Sidebar Styling */
        .sidebar {
            background: linear-gradient(to bottom, var(--primary-color), var(--accent-color));
            color: var(--text-light);
            min-height: 100vh;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sidebar-header h5 {
            margin: 0;
            font-weight: 600;
            color: white;
        }

        .user-info {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-info .nav-link {
            padding: 5px 0;
            color: rgba(255, 255, 255, 0.9);
        }

        .user-info .nav-link.active {
            background: none;
            color: white;
            font-weight: 600;
        }

        .user-info .small {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Main Content Styling */
        .main-content {
            background-color: var(--light-bg);
        }

        .page-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 20px;
            border-radius: 0 0 10px 10px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .table thead {
            background-color: var(--primary-color);
            color: white;
        }

        .table th {
            border: none;
            padding: 15px;
            font-weight: 600;
        }

        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(44, 95, 45, 0.05);
            transform: translateY(-1px);
        }

        /* Status Indicators */
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-active {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .status-pending {
            background-color: #fff3e0;
            color: #ef6c00;
        }

        .status-completed {
            background-color: #e3f2fd;
            color: #1565c0;
        }

        /* Cards for Stats */
        .stats-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border-left: 4px solid var(--primary-color);
        }

        .stats-card i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .stats-card h4 {
            font-size: 1.8rem;
            margin: 10px 0;
            color: var(--text-dark);
        }

        .stats-card p {
            color: #6c757d;
            margin: 0;
        }

        /* Button Styling */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }

            .stats-card {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="sidebar-header">
                    <h5><i class="fas fa-hard-hat me-2"></i>Monitoring Proyek</h5>
                </div>
                <div class="position-sticky pt-3">
                    <div class="user-info">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <span class="nav-link active"><i class="fas fa-user-circle me-2"></i>Selamat datang, {{ $username }}</span>
                                <span class="nav-link small"><i class="fas fa-user-tag me-2"></i>Role: {{ $role }}</span>
                                <span class="nav-link small"><i class="fas fa-clock me-2"></i>Last Login: {{ $last_login }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Navigation Menu -->
                    <ul class="nav flex-column mt-4">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">
                                <i class="fas fa-project-diagram me-2"></i> Daftar Proyek
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">
                                <i class="fa-regular fa-calendar me-2"></i> Tahapan Proyek
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">
                                <i class="fas fa-chart-line me-2"></i> Laporan Progress
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">
                                <i class="fas fa-map-location-dot me-2"></i> Lokasi Proyek
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">
                                <i class="fas fa-users me-2"></i> Kontraktor Proyek
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="page-header">
                    <h2><i class="fas fa-project-diagram me-2"></i>Daftar Proyek</h2>
                    <p class="mb-0">Monitor dan kelola semua proyek pembangunan</p>
                </div>

                <!-- Alert Login Berhasil -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <i class="fas fa-hard-hat"></i>
                            <h4>{{ count($list_proyek) }}</h4>
                            <p>Total Proyek</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <i class="fas fa-play-circle"></i>
                            <h4>{{ $active_projects ?? 5 }}</h4>
                            <p>Proyek Aktif</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <i class="fas fa-pause-circle"></i>
                            <h4>{{ $pending_projects ?? 2 }}</h4>
                            <p>Proyek Tertunda</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <i class="fas fa-check-circle"></i>
                            <h4>{{ $completed_projects ?? 3 }}</h4>
                            <p>Proyek Selesai</p>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode Proyek</th>
                                <th>Nama Proyek</th>
                                <th>Tahun</th>
                                <th>Lokasi</th>
                                <th>Anggaran</th>
                                <th>Sumber Dana</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list_proyek as $proyek)
                            <tr>
                                <td><strong>{{ $proyek['kode_proyek'] }}</strong></td>
                                <td>{{ $proyek['nama_proyek'] }}</td>
                                <td>{{ $proyek['tahun'] }}</td>
                                <td><i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $proyek['lokasi'] }}</td>
                                <td>Rp {{ number_format($proyek['anggaran'], 0, ',', '.') }}</td>
                                <td>{{ $proyek['sumber_dana'] }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
