@extends('layouts.contentNavbarLayout')
@section('title', 'Edit Perawat')
@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card">
      <div class="card-header pb-0"><h6 class="mb-0">Edit Data Perawat</h6></div>
      <div class="card-body">
        <form action="{{ route('admin.data-perawat.update', $perawat->id_perawat) }}" method="POST">
            @csrf @method('PUT')
            
            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Info Akun</h6>
            <div class="row">
                <div class="col-md-6"><div class="form-group"><label class="form-control-label">Nama Lengkap</label><input class="form-control" type="text" name="nama" value="{{ $perawat->user->nama }}" required></div></div>
                <div class="col-md-6"><div class="form-group"><label class="form-control-label">Email</label><input class="form-control" type="email" name="email" value="{{ $perawat->user->email }}" required></div></div>
                <div class="col-md-12"><div class="form-group"><label class="form-control-label">Password Baru (Opsional)</label><input class="form-control" type="password" name="password"></div></div>
            </div>
            <hr class="horizontal dark">
            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Data Profil</h6>
            <div class="row">
                <div class="col-md-6"><div class="form-group"><label class="form-control-label">No HP</label><input class="form-control" type="number" name="no_hp" value="{{ $perawat->no_hp }}" required></div></div>
                <div class="col-md-6"><div class="form-group"><label class="form-control-label">Pendidikan Terakhir</label><input class="form-control" type="text" name="pendidikan" value="{{ $perawat->pendidikan }}" required></div></div>
                <div class="col-md-6">
                    <div class="form-group"><label class="form-control-label">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin">
                            <option value="L" {{ $perawat->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $perawat->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6"><div class="form-group"><label class="form-control-label">Alamat</label><input class="form-control" type="text" name="alamat" value="{{ $perawat->alamat }}" required></div></div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('admin.data-perawat.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection