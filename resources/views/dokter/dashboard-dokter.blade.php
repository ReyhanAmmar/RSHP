@extends('layouts.dokter')
@section('title', 'Dashboard Dokter')
@section('content')
<div class="row">
  <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Selamat Datang</p>
              <h5 class="font-weight-bolder">drh. {{ Auth::user()->nama }}</h5>
              <p class="mb-0">Anda telah menangani <span class="text-success font-weight-bold">{{ $totalPasienSaya }}</span> pasien.</p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
              <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection