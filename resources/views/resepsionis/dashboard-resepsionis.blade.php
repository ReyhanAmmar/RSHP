@extends('layouts.contentNavbarLayout')

@section('title', 'Dashboard - Resepsionis')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang, {{ Auth::user()->nama }}! 🎉</h5>
                            <p class="mb-4">
                                Anda login sebagai <span class="fw-bold">Resepsionis</span>. Silakan gunakan menu di sidebar untuk melakukan pendaftaran pasien baru atau reservasi.
                            </p>
                            <a href="{{ route('resepsionis.registrasi-pemilik.index') }}" class="btn btn-sm btn-outline-primary">Mulai Pendaftaran</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection