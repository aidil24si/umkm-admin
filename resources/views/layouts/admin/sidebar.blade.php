<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="nav-item  {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}"><i class="fe fe-home"></i><span>
                            Dashboard</span> </a>
                </li>
            </ul>
            <ul>
                <li class="nav-item {{ request()->routeIs('warga.*') || request()->routeIs('proyek.*') || request()->routeIs('user.*') || request()->routeIs('tahapan.*')
                || request()->routeIs('progres.*') || request()->routeIs('lokasi.*') || request()->routeIs('kontraktor.*') ? 'active' : ''}}">
                    <a><i class="fe fe-database"></i><span>
                            Master Data</span> </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('warga.*') ? 'active' : '' }}">
                    <a href="{{ route('warga.index') }}"><i class="fe fe-users" data-bs-toggle="tooltip"
                            title="fe fe-users"></i><span>
                            Warga</span> </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('proyek.*') ? 'active' : '' }} ">
                    <a href="{{ route('proyek.index') }}"><i class="fe fe-clipboard"></i><span>
                            Proyek</span> </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('tahapan.*') ? 'active' : '' }} ">
                    <a href="{{ route('tahapan.index') }}"><i class="fe fe-list"></i><span>
                            Tahapan</span> </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('progres.*') ? 'active' : '' }} ">
                    <a href="{{ route('progres.index') }}"><i class="fe fe-trending-up"></i><span>
                            Progres</span> </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('lokasi.*') ? 'active' : '' }} ">
                    <a href="{{ route('lokasi.index') }}"><i class="fe fe-map-pin"></i><span>
                            Lokasi</span> </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('kontraktor.*') ? 'active' : '' }} ">
                    <a href="{{ route('kontraktor.index') }}"><i class="fe fe-briefcase"></i><span>
                            Kontraktor</span> </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('user.*') ? 'active' : '' }} ">
                    <a href="{{ route('user.index') }}"><i class="fe fe-user" data-bs-toggle="tooltip"
                            title="fe fe-user"></i><span>
                            User</span> </a>
                </li>
            </ul>
        </div>
    </div>
</div>
