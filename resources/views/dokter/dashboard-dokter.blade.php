@extends('layouts.contentNavbarLayout')

@section('title', 'Dashboard - Dokter')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card h-100">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-success">Selamat Datang, drh. {{ Auth::user()->nama }}! 🩺</h5>
                            <p class="mb-4">
                                Semoga hari Anda menyenangkan. Silakan cek daftar antrian pasien untuk memulai pemeriksaan medis hari ini.
                            </p>
                            <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-sm btn-outline-success">Mulai Pemeriksaan</a>
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

        <div class="col-lg-4 col-md-4 order-1">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Total Pasien</h5>
                        <small class="text-muted">Riwayat Penanganan</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                            <a class="dropdown-item" href="{{ route('dokter.rekam-medis.index') }}">Lihat Semua</a>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-success">{{ $totalPasienSaya ?? 0 }}</h2>
                            <span>Selesai</span>
                        </div>
                        <div class="avatar avatar-xl">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bx-plus-medical bx-md"></i>
                            </span>
                        </div>
                    </div>
                    <p class="text-muted mb-0">
                        Jumlah pasien yang telah Anda tangani dan rekam medisnya tersimpan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection