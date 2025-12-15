@extends('layouts.contentNavbarLayout')
@section('title', 'Tambah Role')
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h6 class="mb-3">Tambah Role Baru</h6>
        <form action="{{ route('admin.manajemen-role.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-control-label">Nama Role</label>
                <input class="form-control" type="text" name="nama_role" placeholder="Contoh: HRD" required>
            </div>
            <div class="text-end">
                <a href="{{ route('admin.manajemen-role.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection