@extends('layouts.resepsionis')
@section('title', 'Registrasi Hewan')
@section('content')
<div class="row"><div class="col-md-8"><div class="card"><div class="card-header pb-0"><h6>Registrasi Hewan Baru</h6></div>
<div class="card-body">
    <form action="{{ route('resepsionis.registrasi-pet.store') }}" method="POST">@csrf
        <div class="form-group"><label class="form-control-label">Pilih Pemilik</label>
            <select class="form-control" name="idpemilik" required>
                <option value="">-- Cari Pemilik --</option>
                @foreach($pemilik as $p) <option value="{{ $p->idpemilik }}">{{ $p->user->nama }} ({{ $p->alamat }})</option> @endforeach
            </select>
        </div>
        <div class="form-group"><label class="form-control-label">Nama Hewan</label><input class="form-control" type="text" name="nama" required></div>
        <div class="row">
            <div class="col-6"><div class="form-group"><label class="form-control-label">Jenis</label><select class="form-control" id="idjenis" name="idjenis_hewan">@foreach($jenisHewan as $j)<option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>@endforeach</select></div></div>
            <div class="col-6"><div class="form-group"><label class="form-control-label">Ras</label><select class="form-control" id="idras" name="idras_hewan"></select></div></div>
        </div>
        <div class="row">
            <div class="col-6"><div class="form-group"><label class="form-control-label">Kelamin</label><select class="form-control" name="jenis_kelamin"><option value="J">Jantan</option><option value="B">Betina</option></select></div></div>
            <div class="col-6"><div class="form-group"><label class="form-control-label">Warna</label><input class="form-control" type="text" name="warna_tanda" required></div></div>
        </div>
        <div class="form-group"><label class="form-control-label">Tgl Lahir</label><input class="form-control" type="date" name="tanggal_lahir"></div>
        <button type="submit" class="btn btn-primary btn-sm w-100">Simpan</button>
    </form>
</div></div></div></div>
<script>document.addEventListener("DOMContentLoaded",function(){const j=document.getElementById('idjenis'),r=document.getElementById('idras'),d=@json($rasHewan);function f(){r.innerHTML='';d.filter(x=>x.idjenis_hewan==j.value).forEach(x=>{r.innerHTML+=`<option value="${x.idras_hewan}">${x.nama_ras}</option>`})}j.addEventListener('change',f);f()});</script>
@endsection