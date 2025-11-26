@extends('layouts.perawat')
@section('title', 'Pemeriksaan Pasien')
@section('content')
<div class="row"><div class="col-12"><div class="card mb-4"><div class="card-header pb-0"><h6>Antrian Pemeriksaan</h6></div>
<div class="card-body px-0 pt-0 pb-2"><div class="table-responsive p-0"><table class="table align-items-center mb-0">
<thead><tr><th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pasien</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dokter</th><th></th></tr></thead>
<tbody>@foreach($antrian as $i)<tr>
    <td class="text-center"><span class="badge bg-gradient-info rounded-circle">{{ $i->no_urut }}</span></td>
    <td><h6 class="mb-0 text-sm">{{ $i->pet->nama }}</h6></td>
    <td><span class="text-xs font-weight-bold">drh. {{ $i->roleUser->user->nama ?? '-' }}</span></td>
    <td class="align-middle text-end px-4"><a href="{{ route('perawat.rekam-medis.create',$i->idreservasi_dokter) }}" class="btn btn-primary btn-sm">Proses</a></td>
</tr>@endforeach</tbody></table></div></div></div></div></div>
@endsection