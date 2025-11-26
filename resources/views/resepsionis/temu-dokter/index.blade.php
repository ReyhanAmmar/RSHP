@extends('layouts.resepsionis')
@section('title', 'Antrian Pasien')
@section('content')
<div class="row"><div class="col-12"><div class="card mb-4"><div class="card-header pb-0 d-flex justify-content-between"><h6>Antrian Temu Dokter</h6><a href="{{ route('temu-dokter.create') }}" class="btn btn-primary btn-sm">Daftar Pasien</a></div>
<div class="card-body px-0 pt-0 pb-2"><div class="table-responsive p-0"><table class="table align-items-center mb-0">
<thead><tr><th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pasien</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dokter</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th><th></th></tr></thead>
<tbody>@foreach($temuDokter as $i)<tr>
    <td class="text-center"><span class="badge bg-gradient-primary rounded-circle">{{ $i->no_urut }}</span></td>
    <td><h6 class="mb-0 text-sm">{{ $i->pet->nama }}</h6><p class="text-xs text-secondary mb-0">{{ $i->pet->pemilik->user->nama ?? '-' }}</p></td>
    <td><span class="text-xs font-weight-bold">drh. {{ $i->roleUser->user->nama ?? '-' }}</span></td>
    <td>@if($i->status=='0')<span class="badge badge-sm bg-gradient-warning">Menunggu</span>@elseif($i->status=='1')<span class="badge badge-sm bg-gradient-success">Selesai</span>@else<span class="badge badge-sm bg-gradient-danger">Batal</span>@endif</td>
    <td class="align-middle text-end px-4">@if($i->status=='0')<form action="{{ route('temu-dokter.update-status',$i->idreservasi_dokter) }}" method="POST" style="display:inline" onsubmit="return confirm('Selesai?')">@csrf @method('PUT')<input type="hidden" name="status" value="1"><button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm"><i class="fas fa-check"></i></button></form>@endif</td>
</tr>@endforeach</tbody></table></div></div></div></div></div>
@endsection