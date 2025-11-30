@extends('layouts.pemilik')
@section('title', 'Hewan Saya')
@section('content')
<div class="row"><div class="col-12"><div class="card mb-4"><div class="card-header pb-0"><h6>Hewan Peliharaan</h6></div>
<div class="card-body px-0 pt-0 pb-2"><div class="table-responsive p-0"><table class="table align-items-center mb-0">
<thead><tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis</th></tr></thead>
<tbody>@foreach($pets as $p)<tr>
    <td><h6 class="mb-0 text-sm px-3">{{ $p->nama }}</h6></td>
    <td><span class="text-xs font-weight-bold">{{ $p->rasHewan->nama_ras ?? '-' }}</span></td>
</tr>@endforeach</tbody></table></div></div></div></div></div>
@endsection