@extends('layouts.contentNavbarLayout')
@section('title', 'Tambah Jenis Hewan')
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h6 class="mb-3">Tambah Jenis Hewan</h6>
        <form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-control-label">Nama Jenis</label>
                <input class="form-control" type="text" name="nama_jenis_hewan" placeholder="Contoh: Kucing" required>
            </div>
            <div class="text-end">
                <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection