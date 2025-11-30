@extends('layouts.perawat')

@section('title', 'Antrian Pemeriksaan')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Daftar Antrian Pasien</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Urut</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Identitas Pasien</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pemilik</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dokter Tujuan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @forelse($antrian as $item)
              <tr>
                <td class="text-center">
                  <span class="badge bg-gradient-info rounded-circle py-2 px-2 fs-6">{{ $item->no_urut }}</span>
                </td>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $item->pet->nama }}</h6>
                      <p class="text-xs text-secondary mb-0">
                        {{ $item->pet->jenisHewan->nama_jenis_hewan ?? '-' }} ({{ $item->pet->rasHewan->nama_ras ?? '-' }})
                      </p>
                    </div>
                  </div>
                </td>
                <td>
                    <h6 class="mb-0 text-sm">{{ $item->pet->pemilik->user->nama ?? '-' }}</h6>
                    <p class="text-xs text-secondary mb-0">WA: {{ $item->pet->pemilik->no_wa ?? '-' }}</p>
                </td>
                <td>
                    <span class="text-xs font-weight-bold">drh. {{ $item->roleUser->user->nama ?? '-' }}</span>
                </td>
                <td>
                    <span class="badge badge-sm bg-gradient-warning">Menunggu</span>
                </td>
                <td class="align-middle text-end px-4">
                  <a href="{{ route('perawat.rekam-medis.create', $item->idreservasi_dokter) }}" class="btn btn-primary btn-sm mb-0">
                    Proses
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                  <td colspan="6" class="text-center py-5">
                      <div class="text-secondary mb-2"><i class="ni ni-check-bold text-success text-3xl"></i></div>
                      <h6 class="text-secondary">Tidak ada antrian pasien saat ini.</h6>
                  </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection