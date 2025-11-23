@extends('layouts.argon')
@section('title', 'Ras Hewan')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h6>Data Ras Hewan</h6>
        <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-primary btn-sm mb-0">Tambah Ras</a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Hewan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Daftar Ras</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($jenisHewan as $jenis)
              <tr>
                <td><h6 class="mb-0 text-sm ms-3">{{ $jenis->nama_jenis_hewan }}</h6></td>
                <td>
                  @foreach($jenis->rasHewan as $ras)
                    <span class="badge bg-gradient-secondary me-1 mb-1">{{ $ras->nama_ras }}
                        <a href="{{ route('admin.ras-hewan.edit', $ras->idras_hewan) }}" class="text-white ms-1"><i class="fas fa-pencil-alt text-xxs"></i></a>
                    </span>
                  @endforeach
                </td>
                <td class="align-middle text-end px-4">
                   <a href="{{ route('admin.ras-hewan.create', ['idjenis' => $jenis->idjenis_hewan]) }}" class="text-success font-weight-bold text-xs me-3">+ Ras</a>
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