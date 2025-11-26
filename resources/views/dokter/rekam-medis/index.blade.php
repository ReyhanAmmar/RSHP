@extends('layouts.dokter')
@section('title', 'Riwayat Pasien')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0"><h6>Riwayat Rekam Medis</h6></div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead><tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pasien</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Diagnosa</th><th></th></tr></thead>
            <tbody>
              @foreach($rekamMedis as $rm)
              <tr>
                <td><span class="text-xs font-weight-bold ms-3">{{ $rm->created_at->format('d M Y') }}</span></td>
                <td>
                    <h6 class="mb-0 text-sm">{{ $rm->pet->nama }}</h6>
                    <p class="text-xs text-secondary mb-0">Owner: {{ $rm->pet->pemilik->user->nama ?? '-' }}</p>
                </td>
                <td><span class="text-xs text-secondary">{{ Str::limit($rm->diagnosa, 50) }}</span></td>
                <td class="align-middle text-end px-4">
                  <a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-primary btn-sm">Detail</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection