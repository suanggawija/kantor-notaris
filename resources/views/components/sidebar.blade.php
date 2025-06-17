<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="/" class="logo">
                <span class="text-white ">Notaris</span>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section ">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Permohonan</h4>
                </li>

                <li class="nav-item {{ request()->routeIs('klien.*') ? 'active' : '' }}">
                    <a href={{ route('klien.index') }}>
                        <i class="fas fa-user-tie"></i>
                        <p>Klien</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('permohonan.*') ? 'active' : '' }}">
                    <a href={{ route('permohonan.index') }}>
                        <i class="fas fa-pen-square"></i>
                        <p>Permohonan</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
                    <a href={{ route('pembayaran.index') }}>
                        <i class="fas fa-dollar-sign"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Kelola</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('rak.*') ? 'active' : '' }}">
                    <a href={{ route('rak.index') }}>
                        <i class="fas fa-layer-group"></i>
                        <p>Rak</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                    <a href={{ route('user.index') }}>
                        <i class="fas fa-user"></i>
                        <p>Karyawan</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Laporan</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-file-alt"></i>
                        <p>Laporan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href={{ route('laporan.permohonan') }}>
                                    <span class="sub-item">Permohonan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- none --}}

            </ul>
        </div>
    </div>
</div>
