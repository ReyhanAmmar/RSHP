<!DOCTYPE html>
<html lang="id">

<head>
    @include('layouts.partials.head') 
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ route('dashboard.resepsionis') }}">
                <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Resepsionis</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.resepsionis') ? 'active' : '' }}" href="{{ route('dashboard.resepsionis') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('resepsionis.registrasi-pemilik.*') ? 'active' : '' }}" href="{{ route('resepsionis.registrasi-pemilik.create') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Registrasi Pemilik</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('resepsionis.registrasi-pet.*') ? 'active' : '' }}" href="{{ route('resepsionis.registrasi-pet.create') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-paw text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Registrasi Hewan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('temu-dokter.*') ? 'active' : '' }}" href="{{ route('temu-dokter.index') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-ambulance text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Temu Dokter</span>
                    </a>
                </li>

            </ul>
        </div>
    </aside>

    <main class="main-content position-relative border-radius-lg">
        @include('layouts.partials.navbar')

        <div class="container-fluid py-4">
            @yield('content')
            @include('layouts.partials.footer')
        </div>
    </main>

    @include('layouts.partials.scripts')
</body>
</html>