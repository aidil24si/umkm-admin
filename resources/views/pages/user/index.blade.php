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
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="email" class="form-select" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        <option value="@gmail.com" {{ request('email') == '@gmail.com' ? 'selected' : '' }}>@gmail.com
                                        </option>
                                        <option value="@yahoo.com" {{ request('email') == '@yahoo.com' ? 'selected' : '' }}>@yahoo.com
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
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataUser as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td><span class="badges bg-lightgrey">{{ $item->email }}</span></td>
                                        <td>{{ $item->password }}</td>
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
                                @endforeach
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
