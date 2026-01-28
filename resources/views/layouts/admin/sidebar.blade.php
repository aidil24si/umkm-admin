<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}"><i class="fe fe-grid"></i><span> Dashboard</span></a>
                </li>
            </ul>
            <ul>
                <li class="nav-item {{ request()->routeIs('warga.*', 'umkm.*', 'user.*', 'produk.*', 'pesanan.*', 'ulasan.*', 'detail.*') ? 'active' : ''}}">
                    <a><i class="fe fe-layers"></i><span> Data Master</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('warga.*') ? 'active' : '' }}">
                    <a href="{{ route('warga.index') }}"><i class="fe fe-users"></i><span> Warga</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('umkm.*') ? 'active' : '' }}">
                    <a href="{{ route('umkm.index') }}"><i class="fe fe-briefcase"></i><span> UMKM</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('produk.*') ? 'active' : '' }}">
                    <a href="{{ route('produk.index') }}"><i class="fe fe-package"></i><span> Produk</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('pesanan.*') ? 'active' : '' }}">
                    <a href="{{ route('pesanan.index') }}"><i class="fe fe-shopping-cart"></i><span> Pesanan</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('detail.*') ? 'active' : '' }}">
                    <a href="{{ route('detail.index') }}"><i class="fe fe-file-text"></i><span> Detail Pemesanan</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('ulasan.*') ? 'active' : '' }}">
                    <a href="{{ route('ulasan.index') }}"><i class="fe fe-message-square"></i><span> Ulasan</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}"><i class="fe fe-user-check"></i><span> User</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
