@extends('layouts.pemilik')

@section('title', 'Dashboard Pemilik')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 bg-primary overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="position-absolute end-0 top-0 d-none d-lg-block opacity-1 me-4 mt-2">
                        <i class="ni ni-shop fa-5x text-white"></i>
                    </div>
                    <h2 class="fw-bold text-white mb-2">Selamat Datang, {{ Auth::user()->nama }}! 👋</h2>
                    <p class="mb-0 text-white opacity-8">Panel kontrol untuk memantau kesehatan hewan kesayangan Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100 card-hover">
                <div class="card-body d-flex align-items-center">
                    <div class="icon icon-shape bg-white text-primary rounded-circle shadow text-center border-radius-md me-3">
                        <i class="fas fa-paw fa-lg mt-3"></i>
                    </div>
                    <div>
                        <p class="text-sm text-muted text-uppercase fw-bold mb-0">Total Hewan</p>
                        <h4 class="fw-bold mb-0 text-dark">{{ $totalHewan ?? 0 }} <span class="text-xs text-muted fw-normal">Ekor</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h5 class="mb-3 fw-bold text-dark ps-1">Menu Akses Cepat</h5>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 card-hover border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                            <i class="fas fa-cat text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                        <h5 class="ms-3 mb-0 fw-bold text-dark">Hewan Saya</h5>
                    </div>
                    <p class="text-sm text-muted mb-4">Kelola data hewan peliharaan Anda.</p>
                    <a href="{{ route('pemilik.pets') }}" class="btn btn-link text-info px-0 mb-0 fw-bold stretched-link">
                        Lihat Daftar <i class="fas fa-arrow-right ms-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 card-hover border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                            <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                        <h5 class="ms-3 mb-0 fw-bold text-dark">Reservasi</h5>
                    </div>
                    <p class="text-sm text-muted mb-4">Buat janji temu atau cek jadwal.</p>
                    <a href="{{ route('pemilik.reservasi') }}" class="btn btn-link text-warning px-0 mb-0 fw-bold stretched-link">
                        Lihat Jadwal <i class="fas fa-arrow-right ms-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 card-hover border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="ni ni-single-copy-04 text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                        <h5 class="ms-3 mb-0 fw-bold text-dark">Rekam Medis</h5>
                    </div>
                    <p class="text-sm text-muted mb-4">Riwayat pengobatan & diagnosa.</p>
                    <a href="{{ route('pemilik.rekam-medis') }}" class="btn btn-link text-danger px-0 mb-0 fw-bold stretched-link">
                        Lihat Detail <i class="fas fa-arrow-right ms-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; }
    .icon-shape { width: 48px; height: 48px; display: inline-flex; align-items: center; justify-content: center; }
    .icon-shape i { top: 0; }
</style>
@endsection