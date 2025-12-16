@extends('layouts.contentNavbarLayout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Selamat Datang, {{ Auth::user()->nama ?? 'Admin' }}! 🎉</h5>
                        <p class="mb-4">
                            Pantau statistik <span class="fw-bold">Rumah Sakit Hewan</span> secara real-time hari ini.
                            Cek jadwal dan antrian pasien terbaru.
                        </p>
                        <a href="{{ route('profile.index') }}" class="btn btn-sm btn-outline-primary">Lihat Profil</a>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('assets/img/illustrations/man-with-laptop.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-user"></i></span>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a class="dropdown-item" href="{{ route('admin.data-user.index') }}">View Detail</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total User</span>
                        <h3 class="card-title mb-2">{{ $totalUser }}</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-check"></i> Terdaftar</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-success"><i class="bx bx-plus-medical"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Dokter</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $totalDokter }}</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Aktif</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-warning"><i class="bx bxs-dog"></i></span>
                    </div>
                </div>
                <span class="d-block mb-1">Total Pasien (Hewan)</span>
                <h3 class="card-title text-nowrap mb-2">{{ $totalPet }}</h3>
                <small class="text-muted">Ekor hewan terdaftar</small>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-info"><i class="bx bx-calendar-event"></i></span>
                    </div>
                </div>
                <span class="d-block mb-1">Antrian Hari Ini</span>
                <h3 class="card-title text-nowrap mb-2">{{ $kunjunganHariIni }}</h3>
                @if($kunjunganHariIni > 0)
                    <small class="text-danger fw-semibold"><i class="bx bx-time-five"></i> Sedang berlangsung</small>
                @else
                    <small class="text-muted">Belum ada antrian</small>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Status Sistem</h5>
                </div>
            </div>
            <div class="card-body pt-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                        <h2 class="mb-2">Online</h2>
                        <span>Server Status</span>
                    </div>
                    <div id="orderStatisticsChart">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success p-4">
                                <i class="bx bx-server fs-1"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <ul class="p-0 m-0">
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Mobile Friendly</h6>
                                <small class="text-muted">Responsive Layout</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">Yes</small>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection