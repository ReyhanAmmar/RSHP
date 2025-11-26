@extends('layouts.pemilik')

@section('title', 'Dashboard Pemilik')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body p-4">
                    <h2 class="fw-bold">Selamat Datang, {{ Auth::user()->nama }}! 👋</h2>
                    <p class="mb-0 op-8">Ini adalah panel kontrol untuk mengelola hewan peliharaan Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-light text-primary rounded-circle p-3 me-3">
                        <i class="fas fa-paw fa-2x"></i> </div>
                    <div>
                        <p class="text-muted mb-0">Total Hewan Peliharaan</p>
                        <h3 class="fw-bold mb-0">{{ $totalHewan ?? 0 }} Ekor</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3 fw-bold text-dark">Menu Utama</h4>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100 border-start border-4 border-info hover-card">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><i class="fas fa-cat me-2"></i>Daftar Pet Saya</h5>
                    <p class="card-text text-muted">Lihat dan kelola data hewan peliharaan yang terdaftar.</p>
                    <a href="#" class="btn btn-outline-info btn-sm stretched-link">Lihat Daftar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100 border-start border-4 border-warning hover-card">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><i class="fas fa-calendar-alt me-2"></i>Reservasi</h5>
                    <p class="card-text text-muted">Cek jadwal reservasi klinik untuk hewan Anda.</p>
                    <a href="#" class="btn btn-outline-warning btn-sm stretched-link">Lihat Reservasi</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100 border-start border-4 border-danger hover-card">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><i class="fas fa-file-medical me-2"></i>Rekam Medis</h5>
                    <p class="card-text text-muted">Riwayat kesehatan dan detail pengobatan hewan.</p>
                    <a href="#" class="btn btn-outline-danger btn-sm stretched-link">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: transform 0.2s;
    }
    .hover-card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection