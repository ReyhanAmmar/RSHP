@extends('layouts.contentNavbarLayout')

@section('title', 'Dashboard - Pemilik')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card h-100">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang, {{ Auth::user()->nama }}! 👋</h5>
                            <p class="mb-4">
                                Ini adalah panel kontrol pribadi Anda untuk memantau kesehatan dan jadwal perawatan hewan kesayangan Anda.
                            </p>
                            <a href="{{ route('pemilik.pets') }}" class="btn btn-sm btn-outline-primary">Lihat Hewan Saya</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Hewan</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $totalHewan ?? 0 }}</h4>
                                <small class="text-success">(Ekor)</small>
                            </div>
                            <small>Hewan terdaftar</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="bx bx-paw bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Reservasi Aktif</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $reservasiAktif ?? 0 }}</h4>
                                <small class="text-warning">(Menunggu)</small>
                            </div>
                            <small>Jadwal temu dokter</small>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
                            <i class="bx bx-calendar-event bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Pemeriksaan</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $totalPemeriksaan ?? 0 }}</h4>
                                <small class="text-info">(Kali)</small>
                            </div>
                            <small>Riwayat rekam medis</small>
                        </div>
                        <span class="badge bg-label-info rounded p-2">
                            <i class="bx bx-history bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h5 class="pb-1 mb-4">Akses Cepat</h5>
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar avatar-xl bg-label-primary rounded-circle mx-auto mb-3">
                        <i class="bx bx-cat fs-1"></i>
                    </div>
                    <h5 class="card-title">Daftar Hewan</h5>
                    <p class="card-text">Lihat detail profil hewan peliharaan Anda.</p>
                    <a href="{{ route('pemilik.pets') }}" class="btn btn-outline-primary">Buka Halaman</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar avatar-xl bg-label-warning rounded-circle mx-auto mb-3">
                        <i class="bx bx-calendar fs-1"></i>
                    </div>
                    <h5 class="card-title">Riwayat Reservasi</h5>
                    <p class="card-text">Cek status antrian atau jadwal kunjungan Anda.</p>
                    <a href="{{ route('pemilik.reservasi') }}" class="btn btn-outline-warning">Lihat Jadwal</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar avatar-xl bg-label-danger rounded-circle mx-auto mb-3">
                        <i class="bx bx-file fs-1"></i>
                    </div>
                    <h5 class="card-title">Rekam Medis</h5>
                    <p class="card-text">Lihat hasil diagnosa dan resep obat dokter.</p>
                    <a href="{{ route('pemilik.rekam-medis') }}" class="btn btn-outline-danger">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection