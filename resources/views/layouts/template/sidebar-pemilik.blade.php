<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('pemilik.dashboard') }}">
            <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Area Pemilik</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}" href="{{ route('pemilik.dashboard') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"><i class="ni ni-shop text-primary text-sm opacity-10"></i></div>
                    <span class="nav-link-text ms-1">Beranda</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pemilik.pets') ? 'active' : '' }}" href="{{ route('pemilik.pets') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"><i class="fas fa-cat text-warning text-sm opacity-10"></i></div>
                    <span class="nav-link-text ms-1">Hewan Saya</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pemilik.reservasi') ? 'active' : '' }}" href="{{ route('pemilik.reservasi') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"><i class="ni ni-calendar-grid-58 text-info text-sm opacity-10"></i></div>
                    <span class="nav-link-text ms-1">Riwayat Reservasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pemilik.rekam-medis.*') ? 'active' : '' }}" href="{{ route('pemilik.rekam-medis') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"><i class="ni ni-single-copy-04 text-danger text-sm opacity-10"></i></div>
                    <span class="nav-link-text ms-1">Rekam Medis</span>
                </a>
            </li>
        </ul>
    </div>
</aside>