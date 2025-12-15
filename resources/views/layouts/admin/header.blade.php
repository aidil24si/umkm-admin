<div class="header">

    <div class="header-left active">
        <a href="{{ route('dashboard.index') }}" class="logo">
            <img src="{{ asset('assets-admin/img/logo.svg') }}" alt="">
        </a>
        <a href="{{ route('dashboard.index') }}" class="logo-small">
            <img src="{{ asset('assets-admin/img/logo-small.png') }}" alt="">
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">

        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="#">
                    <div class="searchinputs">
                        <input type="text" placeholder="Cari disini....">
                        <div class="search-addon">
                            <span><img src="{{ asset('assets-admin/img/icons/closes.svg') }}" alt="img"></span>
                        </div>
                    </div>
                    <a class="btn" id="searchdiv"><img src="{{ asset('assets-admin/img/icons/search.svg') }}"
                            alt="img"></a>
                </form>
            </div>
        </li>


        <li class="nav-item dropdown has-arrow flag-nav">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
                <img src="{{ asset('assets-admin/img/flags/id.png') }}" alt="" height="20">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('assets-admin/img/flags/us.png') }}" alt="" height="16">
                    English
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('assets-admin/img/flags/fr.png') }}" alt="" height="16">
                    French
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('assets-admin/img/flags/es.png') }}" alt="" height="16">
                    Spanish
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('assets-admin/img/flags/de.png') }}" alt="" height="16">
                    German
                </a>
            </div>
        </li>


        <li class="nav-item dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <img src="{{ asset('assets-admin/img/icons/notification-bing.svg') }}" alt="img"> <span
                    class="badge rounded-pill">4</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifikasi</span>
                    <a href="javascript:void(0)" class="clear-noti"> Bersihkan Semua </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt=""
                                            src="{{ asset('assets-admin/img/profiles/avatar-02.jpg') }}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Hadi Pratama</span> menambah
                                            tugas baru <span class="noti-title">perjanjian meeting</span>
                                        </p>
                                        <p class="noti-time"><span class="notification-time">4 menit lalu</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt=""
                                            src="{{ asset('assets-admin/img/profiles/avatar-03.jpg') }}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Hadi Pratama</span> menambah
                                            tugas baru <span class="noti-title">perjanjian meeting</span>
                                        </p>
                                        <p class="noti-time"><span class="notification-time">4 menit lalu</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt=""
                                            src="{{ asset('assets-admin/img/profiles/avatar-06.jpg') }}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Hadi Pratama</span> menambah
                                            tugas baru <span class="noti-title">perjanjian meeting</span>
                                        </p>
                                        <p class="noti-time"><span class="notification-time">4 menit lalu</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt=""
                                            src="{{ asset('assets-admin/img/profiles/avatar-17.jpg') }}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Hadi Pratama</span> menambah
                                            tugas baru <span class="noti-title">perjanjian meeting</span>
                                        </p>
                                        <p class="noti-time"><span class="notification-time">4 menit lalu</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt=""
                                            src="{{ asset('assets-admin/img/profiles/avatar-13.jpg') }}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Hadi Pratama</span> menambah
                                            tugas baru <span class="noti-title">perjanjian meeting</span>
                                        </p>
                                        <p class="noti-time"><span class="notification-time">4 menit lalu</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="">Lihat Semua Notifikasi</a>
                </div>
            </div>
        </li>

        @if (Auth::user())
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-img">
                        <img src="{{ Auth::user()->profile_picture
                            ? asset('storage/' . Auth::user()->profile_picture)
                            : asset('assets-admin/img/profiles/avator1.jpg') }}"
                            alt="Profile">
                        <span class="status online"></span>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilename">
                        <div class="profileset">
                            <span class="user-img">
                                <img src="{{ Auth::user()->profile_picture
                                    ? asset('storage/' . Auth::user()->profile_picture)
                                    : asset('assets-admin/img/profiles/avator1.jpg') }}"
                                    alt="Profile">
                                <span class="status online"></span>
                            </span>
                            <div class="profilesets">
                                <h6>{{ Auth::user()->name }}</h6>
                                <h5>{{ Auth::user()->role }}</h5>
                            </div>
                        </div>
                        <hr class="m-0">
                        <a class="dropdown-item" href=""> <i class="me-2" data-feather="clock"></i>
                            {{ session('last_login') }}</a>
                        <a class="dropdown-item" href=""> <i class="me-2" data-feather="user"></i>
                            My
                            Profile</a>
                        <a class="dropdown-item" href=""><i class="me-2"
                                data-feather="settings"></i>Settings</a>
                        <hr class="m-0">
                        <a class="dropdown-item logout pb-0" href="{{ route('auth.logout') }}"><img
                                src="{{ asset('assets-admin/img/icons/log-out.svg') }}" class="me-2"
                                alt="img">Logout</a>
                    </div>
                </div>
            </li>
        @else
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);"
                    class="dropdown-toggle nav-link userset border border-primary rounded-3 px-3 py-2"
                    data-bs-toggle="dropdown">
                    <span class="user-img">
                        <img src="{{ asset('assets-admin/img/icons/user-circle.svg') }}" alt=""
                            style="width: 35px;">
                    </span>
                    <span class="ps-2 fw-semibold text-primary">Account</span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <a class="dropdown-item" href="{{ route('auth.login') }}">
                        <i class="me-2" data-feather="log-in"></i> Login
                    </a>
                    <a class="dropdown-item" href="{{ route('register') }}">
                        <i class="me-2" data-feather="user-plus"></i> Register
                    </a>
                </div>
            </li>
        @endif
    </ul>

    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="">My Profile</a>
            <a class="dropdown-item" href="">Settings</a>
            <a class="dropdown-item" href="{{ route('login') }}">Logout</a>
        </div>
    </div>

</div>
