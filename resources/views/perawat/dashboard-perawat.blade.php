@extends('layouts.perawat')
@section('title', 'Dashboard Perawat')
@section('content')
<div class="row"><div class="col-12"><div class="card"><div class="card-body p-3">
    <h5 class="font-weight-bolder">Selamat Datang, {{ Auth::user()->nama }}</h5>
    <p class="mb-0">Anda memiliki <span class="text-danger font-weight-bold">{{ $pasienMenunggu }}</span> pasien menunggu pemeriksaan hari ini.</p>
</div></div></div></div>
@endsection