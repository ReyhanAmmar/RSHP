<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo-ct-dark.png') }}" alt="Logo" style="height: 25px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">RSHP </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        @if(session('user_role') == 1)
            
            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>Dashboard Admin</div>
                </a>
            </li>

            @php
                $isMasterActive = request()->routeIs('admin.data-user.*') || 
                                  request()->routeIs('admin.manajemen-role.*') ||
                                  request()->routeIs('admin.jenis-hewan.*') ||
                                  request()->routeIs('admin.ras-hewan.*') ||
                                  request()->routeIs('admin.data-pemilik.*') ||
                                  request()->routeIs('admin.data-pet.*') ||
                                  request()->routeIs('admin.data-dokter.*') ||
                                  request()->routeIs('admin.data-perawat.*');
            @endphp
            <li class="menu-item {{ $isMasterActive ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-layout"></i>
                    <div>Data Master</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('admin.data-user.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.data-user.index') }}" class="menu-link"><div>Data User</div></a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.manajemen-role.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.manajemen-role.index') }}" class="menu-link"><div>Manajemen Role</div></a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.jenis-hewan.index') }}" class="menu-link"><div>Jenis Hewan</div></a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.ras-hewan.index') }}" class="menu-link"><div>Ras Hewan</div></a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.data-pemilik.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.data-pemilik.index') }}" class="menu-link"><div>Data Pemilik</div></a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.data-pet.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.data-pet.index') }}" class="menu-link"><div>Data Hewan</div></a>
                    <li class="menu-item {{ request()->routeIs('admin.data-dokter.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.data-dokter.index') }}" class="menu-link"><div>Data Dokter</div></a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.data-perawat.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.data-perawat.index') }}" class="menu-link"><div>Data Perawat</div></a>
                    </li>
                    </li>
                </ul>
            </li>

            @php
                $isMedisActive = request()->routeIs('admin.kategori.*') || 
                                 request()->routeIs('admin.kategori-klinis.*') ||
                                 request()->routeIs('admin.tindakan.*');
            @endphp
            <li class="menu-item {{ $isMedisActive ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-first-aid"></i>
                    <div>Rekam Medis</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.kategori.index') }}" class="menu-link"><div>Kategori</div></a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.kategori-klinis.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.kategori-klinis.index') }}" class="menu-link"><div>Kategori Klinis</div></a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.tindakan.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.tindakan.index') }}" class="menu-link"><div>Kode Tindakan</div></a>
                    </li>
                </ul>
            </li>

            @php
                $isTransaksiActive = request()->routeIs('admin.data-temu-dokter.*') || 
                                 request()->routeIs('admin.data=rekam-medis.*');
            @endphp
            <li class="menu-item {{ $isTransaksiActive ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Transaksi">Transaksi</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('admin.data-temu-dokter.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.data-temu-dokter.index') }}" class="menu-link">
                            <div data-i18n="Temu Dokter">Temu Dokter</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.data-rekam-medis.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.data-rekam-medis.index') }}" class="menu-link">
                            <div data-i18n="Rekam Medis">Rekam Medis</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif


        @if(session('user_role') == 2)
            
            <li class="menu-item {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                <a href="{{ route('dokter.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-pulse"></i>
                    <div>Dashboard</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Pemeriksaan</span>
            </li>

            <li class="menu-item {{ request()->routeIs('dokter.data-pasien.*') ? 'active' : '' }}">
                <a href="{{ route('dokter.data-pasien.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-heart-pulse"></i>
                    <div>Data Pasien</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('dokter.rekam-medis.*') ? 'active' : '' }}">
                <a href="{{ route('dokter.rekam-medis.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file-blank"></i>
                    <div>Rekam Medis</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Akun</span>
            </li>

            <li class="menu-item {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                <a href="{{ route('profile.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div>Profil Saya</div>
                </a>
            </li>
        @endif

        @if(session('user_role') == 3)
            
            <li class="menu-item {{ request()->routeIs('perawat.dashboard') ? 'active' : '' }}">
                <a href="{{ route('perawat.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>Dashboard</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Tugas Medis</span>
            </li>

            <li class="menu-item {{ request()->routeIs('perawat.data-pasien.*') ? 'active' : '' }}">
                <a href="{{ route('perawat.data-pasien.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-stethoscope"></i>
                    <div>Data Pasien</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('perawat.rekam-medis.*') ? 'active' : '' }}">
                <a href="{{ route('perawat.rekam-medis.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-band-aid"></i>
                    <div>Rekam Medis</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Akun</span>
            </li>

            <li class="menu-item {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                <a href="{{ route('profile.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div>Profil Saya</div>
                </a>
            </li>
        @endif


        @if(session('user_role') == 4)
            
            <li class="menu-item {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}">
                <a href="{{ route('resepsionis.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-smile"></i>
                    <div>Dashboard</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Layanan Front Office</span>
            </li>

            @php
                $isRegistrasiActive = request()->routeIs('resepsionis.registrasi-pemilik.*') || 
                                      request()->routeIs('resepsionis.registrasi-pet.*');
            @endphp
            <li class="menu-item {{ $isRegistrasiActive ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-user-plus"></i>
                    <div>Registrasi Baru</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('resepsionis.registrasi-pemilik.*') ? 'active' : '' }}">
                        <a href="{{ route('resepsionis.registrasi-pemilik.index') }}" class="menu-link">
                            <div>Registrasi Pemilik</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('resepsionis.registrasi-pet.*') ? 'active' : '' }}">
                        <a href="{{ route('resepsionis.registrasi-pet.create') }}" class="menu-link">
                            <div>Registrasi Hewan</div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item {{ request()->routeIs('temu-dokter.*') ? 'active' : '' }}">
                <a href="{{ route('temu-dokter.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                    <div>Pendaftaran / Temu Dokter</div>
                </a>
            </li>
        @endif


        @if(session('user_role') == 5)
            
            <li class="menu-item {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
                <a href="{{ route('pemilik.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-heart"></i>
                    <div>Dashboard</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('pemilik.pets') ? 'active' : '' }}">
                <a href="{{ route('pemilik.pets') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-heart"></i>
                    <div>Hewan Peliharaan Saya</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('pemilik.reservasi') ? 'active' : '' }}">
                <a href="{{ route('pemilik.reservasi') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-history"></i>
                    <div>Riwayat Reservasi</div>
                </a>
            </li>
        @endif

    </ul>
</aside>