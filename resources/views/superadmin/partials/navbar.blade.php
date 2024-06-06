<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center" style="background-color: #007bff;">
                    <a style="color: white;" class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                        data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                        aria-expanded="false">
                        <img src="{{ asset('assets/superadmin/images/users/avatar-1.jpg') }}" alt="user"
                            class="rounded-circle">
                        Intravilligence
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <a class="dropdown-item" href="{{ route('logout.index') }}"><i
                                class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                    </div>
                    <!-- <a href="index.html" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
                </div>
            </div>

            <div class="sidebar-inner slimscrollleft">

                <div id="sidebar-menu">
                    <ul>

                        <li>
                            <a href="{{ route('superadmin.dashboard.index') }}" class="waves-effect">
                                <i class="mdi mdi-airplay"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.users.index') }}" class="waves-effect">
                                <i class="mdi mdi-account"></i>
                                <span> User</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.officers.index') }}" class="waves-effect">
                                <i class="mdi mdi-account"></i>
                                <span> Officer</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.operasional.index') }}" class="waves-effect">
                                <i class="fa fa-users"></i>
                                <span> Operasional</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.category.index') }}" class="waves-effect">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                <span> Kategori</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.komponen.index') }}" class="waves-effect">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                <span> Komponen</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.stasioning.index') }}" class="waves-effect">
                                <i class="material-icons">location_on</i>
                                <span>Stasioning</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.lokasi.index') }}" class="waves-effect">
                                <i class="material-icons">location_on</i>
                                <span> Lokasi Aset</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.gangguan.index') }}" class="waves-effect">
                                <i class="fa fa-gear"></i>
                                <span> Jenis Gangguan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.golonganKendaraan.index') }}" class="waves-effect">
                                <i class="fa fa-car"></i>
                                <span>Golongan Kendaraan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.jenisKendaraan.index') }}" class="waves-effect">
                                <i class="fa fa-car"></i>
                                <span>Jenis Kendaraan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.cuaca.index') }}" class="waves-effect">
                                <i class="fa fa-cloud"></i>
                                <span>Cuaca</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.sumberInformasi.index') }}" class="waves-effect">
                                <i class="mdi mdi-phone-in-talk"></i>
                                <span>Sumber Informasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.unitPerawatan.index') }}" class="waves-effect">
                                <i class="mdi mdi-google-circles-extended"></i>
                                <span>Unit Perawatan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.jenisPerawatan.index') }}" class="waves-effect">
                                <i class="mdi mdi-auto-fix"></i>
                                <span>Jenis Perawatan</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->
