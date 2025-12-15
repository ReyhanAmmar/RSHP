@extends('layouts.contentNavbarLayout')
@section('title', 'Edit Pemilik')
@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card">
      <div class="card-header pb-0"><h6 class="mb-0">Edit Pemilik</h6></div>
      <div class="card-body">
        <form action="{{ route('admin.data-pemilik.update', $pemilik->idpemilik) }}" method="POST">
            @csrf @method('PUT')
            <p class="text-uppercase text-sm font-weight-bolder text-primary">Data Akun</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"><label class="form-control-label">Nama Lengkap</label><input class="form-control" type="text" name="nama" value="{{ $pemilik->user->nama }}" required></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label class="form-control-label">Email</label><input class="form-control" type="email" name="email" value="{{ $pemilik->user->email }}" required></div>
                </div>
                <div class="col-md-12">
                    <div class="form-group"><label class="form-control-label">Password Baru (Opsional)</label><input class="form-control" type="password" name="password"></div>
                </div>
            </div>
            <hr>
            <p class="text-uppercase text-sm font-weight-bolder text-primary">Data Kontak</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"><label class="form-control-label">No WhatsApp</label><input class="form-control" type="number" name="no_wa" value="{{ $pemilik->no_wa }}" required></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label class="form-control-label">Alamat</label><input class="form-control" type="text" name="alamat" value="{{ $pemilik->alamat }}" required></div>
                </div>
            </div>
            <div class="text-end">
                <a href="{{ route('admin.data-pemilik.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection