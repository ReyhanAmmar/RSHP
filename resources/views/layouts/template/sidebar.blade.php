<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">RSHP Admin</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
            @php
                // Cek apakah kita sedang berada di salah satu halaman Master Data
                $isMasterDataActive = request()->routeIs('admin.data-user.*') || 
                                      request()->routeIs('admin.manajemen-role.*') ||
                                      request()->routeIs('admin.jenis-hewan.*') ||
                                      request()->routeIs('admin.ras-hewan.*') ||
                                      request()->routeIs('admin.data-pemilik.*') ||
                                      request()->routeIs('admin.data-pet.*');
            @endphp

            <a class="nav-link {{ $isMasterDataActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#masterData" role="button" aria-expanded="{{ $isMasterDataActive ? 'true' : 'false' }}" aria-controls="masterData">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-archive-2 text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Master Data</span>
            </a>
            
            <div class="collapse {{ $isMasterDataActive ? 'show' : '' }}" id="masterData">
                <ul class="nav ms-4">
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.data-user.*') ? 'active' : '' }}" href="{{ route('admin.data-user.index') }}">
                            <span class="sidenav-normal"> Data User </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.manajemen-role.*') ? 'active' : '' }}" href="{{ route('admin.manajemen-role.index') }}">
                            <span class="sidenav-normal"> Manajemen Role </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}" href="{{ route('admin.jenis-hewan.index') }}">
                            <span class="sidenav-normal"> Jenis Hewan </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}" href="{{ route('admin.ras-hewan.index') }}">
                            <span class="sidenav-normal"> Ras Hewan </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.data-pemilik.*') ? 'active' : '' }}" href="{{ route('admin.data-pemilik.index') }}">
                            <span class="sidenav-normal"> Data Pemilik </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.data-pet.*') ? 'active' : '' }}" href="{{ route('admin.data-pet.index') }}">
                            <span class="sidenav-normal"> Data Hewan (Pet) </span>
                        </a>
                    </li>

                </ul>
            </div>
        </li>

        <li class="nav-item">
            @php
                // Cek apakah kita sedang berada di halaman Master Medis
                $isMedisActive = request()->routeIs('admin.kategori.*') || 
                                 request()->routeIs('admin.kategori-klinis.*') ||
                                 request()->routeIs('admin.tindakan.*');
            @endphp

            <a class="nav-link {{ $isMedisActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#masterMedis" role="button" aria-expanded="{{ $isMedisActive ? 'true' : 'false' }}" aria-controls="masterMedis">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-ambulance text-danger text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Master Rekam Medis</span>
            </a>

            <div class="collapse {{ $isMedisActive ? 'show' : '' }}" id="masterMedis">
                <ul class="nav ms-4">
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                            <span class="sidenav-normal"> Data Kategori </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.kategori-klinis.*') ? 'active' : '' }}" href="{{ route('admin.kategori-klinis.index') }}">
                            <span class="sidenav-normal"> Kategori Klinis </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.tindakan.*') ? 'active' : '' }}" href="{{ route('admin.tindakan.index') }}">
                            <span class="sidenav-normal"> Kode Tindakan </span>
                        </a>
                    </li>

                </ul>
            </div>
        </li>

      </ul>
    </div>
</aside>