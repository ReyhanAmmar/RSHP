@extends('layouts.argon')
@section('title', 'Edit Dokter')
@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card">
      <div class="card-header pb-0"><h6 class="mb-0">Edit Data Dokter</h6></div>
      <div class="card-body">
        <form action="{{ route('admin.data-dokter.update', $dokter->id_dokter) }}" method="POST">
            @csrf @method('PUT')
            
            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Info Akun</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"><label class="form-control-label">Nama Lengkap</label><input class="form-control" type="text" name="nama" value="{{ $dokter->user->nama }}" required></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label class="form-control-label">Email</label><input class="form-control" type="email" name="email" value="{{ $dokter->user->email }}" required></div>
                </div>
                <div class="col-md-12">
                    <div class="form-group"><label class="form-control-label">Password Baru (Opsional)</label><input class="form-control" type="password" name="password"></div>
                </div>
            </div>
            <hr class="horizontal dark">
            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Data Profil</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"><label class="form-control-label">No HP</label><input class="form-control" type="number" name="no_hp" value="{{ $dokter->no_hp }}" required></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label class="form-control-label">Bidang Keahlian</label><input class="form-control" type="text" name="bidang_dokter" value="{{ $dokter->bidang_dokter }}" required></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin">
                            <option value="L" {{ $dokter->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $dokter->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label class="form-control-label">Alamat</label><input class="form-control" type="text" name="alamat" value="{{ $dokter->alamat }}" required></div>
                </div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('admin.data-dokter.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection