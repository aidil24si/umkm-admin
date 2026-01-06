@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List User</h4>
                    <h6>Kelola data user</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('user.create') }}" class="btn btn-added"><img
                            src="{{ asset('assets-admin/img/icons/plus.svg') }}" alt="img" class="me-1">Tambah Users</a>
                </div>
            </div>
            {{-- Notifikasi Success --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show">
                    {{ session('error') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="role" class="form-select" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        <option value="Super Admin"
                                            {{ request('role') == 'Super Admin' ? 'selected' : '' }}>
                                            Super Admin
                                        </option>
                                        <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>
                                        <option value="Guest" {{ request('role') == 'Guest' ? 'selected' : '' }}>
                                            Guest
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                            value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                                        <button type="submit" class="input-group-text" id="basic-addon2">
                                            <img src="{{ asset('assets-admin/img/icons/search-white.svg') }}"
                                                alt="img">
                                        </button>
                                        @if (request('search'))
                                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                                class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataUser as $item)
                                    <tr>
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
                                        <td>
                                            <div class="action-buttons d-flex align-items-center">
                                                <a class="btn-action btn-edit me-2" title="Edit Data"
                                                    href="{{ route('user.edit', $item->id) }}">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                                    class="d-inline delete-form"
                                                    data-success-message="Data berhasil dihapus!">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete" title="Hapus Data">
                                                        <i class="fe fe-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            Tidak ada data user ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $dataUser->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
