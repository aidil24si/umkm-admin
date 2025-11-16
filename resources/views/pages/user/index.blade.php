@extends('layouts.admin.app')
@section('content')
    {{-- Start Main Content --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List Users</h4>
                    <h6>Kelola Data Users</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('user.create') }}" class="btn btn-added"><img
                            src="{{ asset('assets-admin/img/icons/plus.svg') }}" alt="img" class="me-1">Tambah Users</a>
                </div>
            </div>
            {{-- Notifikasi Success --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{ asset('assets-admin/img/icons/filter.svg') }}" alt="img">
                                    <span><img src="{{ asset('assets-admin/img/icons/closes.svg') }}" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img
                                        src="{{ asset('assets-admin/img/icons/search-white.svg') }}" alt="img"></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table  datanew">
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
                                                <form action="{{ route('user.destroy', $item->id) }}"
                                                    method="POST" class="d-inline delete-form"
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
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- End Main Content --}}
@endsection
