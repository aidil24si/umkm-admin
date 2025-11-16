<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="nav-item  {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}"><img
                            src="{{ asset('assets-admin/img/icons/dashboard.svg') }}" alt="img"></i><span>
                            Dashboard</span> </a>
                </li>
            </ul>
            <ul>
                <li class="nav-item {{ request()->routeIs('warga.*') || request()->routeIs('proyek.*') || request()->routeIs('user.*') ? 'active' : '' }}">
                    <a><span>
                            Master Data</span> </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('warga.*') ? 'active' : '' }}">
                    <a href="{{ route('warga.index') }}"><i class="fe fe-users" data-bs-toggle="tooltip"
                            title="fe fe-users"></i><span>
                            Warga</span> </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('proyek.*') ? 'active' : '' }} ">
                    <a href="{{ route('proyek.index') }}"><i class="fe fe-activity" data-bs-toggle="tooltip"
                            title="fe fe-activity"></i><span>
                            Proyek</span> </a>
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
