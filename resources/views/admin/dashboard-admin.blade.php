@extends('layouts.argon')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Selamat Datang</p>
                <h5 class="font-weight-bolder">
                  {{ Auth::user()->nama ?? 'Admin' }}
                </h5>
                <p class="mb-0">
                  Pantau statistik Rumah Sakit Hewan secara real-time hari ini.
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="ni ni-shop text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="row mt-4">
    
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total User</p>
                <h5 class="font-weight-bolder">
                  {{ $totalUser }}
                </h5>
                <p class="mb-0 text-sm">
                  <span class="text-success font-weight-bolder">Akun</span> terdaftar
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Dokter Aktif</p>
                <h5 class="font-weight-bolder">
                  {{ $totalDokter }}
                </h5>
                <p class="mb-0 text-sm">
                  <span class="text-success font-weight-bolder">Personil</span> siap
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                <i class="ni ni-ambulance text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pasien</p>
                <h5 class="font-weight-bolder">
                  {{ $totalPet }}
                </h5>
                <p class="mb-0 text-sm">
                  <span class="text-primary font-weight-bolder">Ekor</span> hewan
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="fas fa-paw text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Antrian Hari Ini</p>
                <h5 class="font-weight-bolder">
                  {{ $kunjunganHariIni }}
                </h5>
                <p class="mb-0 text-sm">
                    @if($kunjunganHariIni > 0)
                        <span class="text-danger font-weight-bolder">Sedang berlangsung</span>
                    @else
                        <span class="text-secondary">Belum ada</span>
                    @endif
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Info Sistem</h6>
          <p class="text-sm mb-0">
            <i class="fa fa-check text-success"></i>
            <span class="font-weight-bold">Status Server:</span> Online
          </p>
        </div>
        <div class="card-body p-3">
          <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
          <div class="container border-radius-lg">
             <p class="text-sm">Grafik kunjungan pasien (Dummy Data)</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-5">
      <div class="card card-carousel overflow-hidden h-100 p-0">
        <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
          <div class="carousel-inner border-radius-lg h-100">
            <div class="carousel-item h-100 active" style="background-image: url('{{ asset('assets/img/carousel-1.jpg') }}'); background-size: cover;">
              <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                <h5 class="text-white mb-1">RSHP Admin Panel</h5>
                <p>Kelola data medis dan administrasi dengan lebih efisien.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection