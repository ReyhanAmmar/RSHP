@extends('layouts.dokter')
@section('title', 'Detail Rekam Medis')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h6>Detail Pasien: {{ $rm->pet->nama }}</h6>
        <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nama Hewan:</strong> &nbsp; {{ $rm->pet->nama }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Pemilik:</strong> &nbsp; {{ $rm->pet->pemilik->user->nama ?? '-' }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tanggal:</strong> &nbsp; {{ $rm->created_at->format('d M Y H:i') }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                 <h6 class="text-uppercase text-body text-xs font-weight-bolder">Diagnosa</h6>
                 <p class="text-sm">{{ $rm->diagnosa }}</p>
                 <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-3">Anamnesa</h6>
                 <p class="text-sm">{{ $rm->anamnesa }}</p>
            </div>
        </div>
        <hr class="horizontal dark">
        <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Tindakan & Terapi</h6>
        <ul class="list-group">
            @foreach($rm->detailRekamMedis as $detail)
            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">{{ $detail->kodeTindakan->deskripsi_tindakan_terapi }}</h6>
                    <span class="mb-2 text-xs">Keterangan: <span class="text-dark font-weight-bold ms-sm-2">{{ $detail->detail ?? '-' }}</span></span>
                    <span class="text-xs">Kode: <span class="text-dark ms-sm-2 font-weight-bold">{{ $detail->kodeTindakan->kode }}</span></span>
                </div>
            </li>
            @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection