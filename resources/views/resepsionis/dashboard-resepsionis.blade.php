@extends('layouts.resepsionis')
@section('title', 'Dashboard Resepsionis')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Selamat Datang</p>
              <h5 class="font-weight-bolder">{{ Auth::user()->nama }}</h5>
              <p class="mb-0">Silakan gunakan menu di sidebar untuk pendaftaran pasien.</p>
            </div>
          </div>
          <div class="col-4 text-end"><div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle"><i class="ni ni-shop text-lg opacity-10" aria-hidden="true"></i></div></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection