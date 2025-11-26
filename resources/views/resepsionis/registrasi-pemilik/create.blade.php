@extends('layouts.resepsionis')
@section('title', 'Registrasi Pemilik')
@section('content')
<div class="row"><div class="col-md-10"><div class="card"><div class="card-header pb-0"><h6>Registrasi Pemilik Baru</h6></div>
<div class="card-body">
    <form action="{{ route('resepsionis.registrasi-pemilik.store') }}" method="POST">@csrf
        <p class="text-uppercase text-sm font-weight-bolder text-primary">Data Akun</p>
        <div class="row">
            <div class="col-md-6"><div class="form-group"><label class="form-control-label">Nama Lengkap</label><input class="form-control" type="text" name="nama" required></div></div>
            <div class="col-md-6"><div class="form-group"><label class="form-control-label">Email</label><input class="form-control" type="email" name="email" required></div></div>
            <div class="col-md-12"><div class="form-group"><label class="form-control-label">Password</label><input class="form-control" type="password" name="password" required></div></div>
        </div>
        <hr><p class="text-uppercase text-sm font-weight-bolder text-primary">Data Kontak</p>
        <div class="row">
            <div class="col-md-6"><div class="form-group"><label class="form-control-label">No WA</label><input class="form-control" type="number" name="no_wa" required></div></div>
            <div class="col-md-6"><div class="form-group"><label class="form-control-label">Alamat</label><input class="form-control" type="text" name="alamat" required></div></div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm w-100 mt-3">Simpan</button>
    </form>
</div></div></div></div>
@endsection