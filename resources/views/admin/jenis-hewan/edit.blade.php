@extends('layouts.argon')
@section('title', 'Edit Jenis Hewan')
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h6 class="mb-3">Edit Jenis Hewan</h6>
        <form action="{{ route('admin.jenis-hewan.update', $jenisHewan->idjenis_hewan) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-control-label">Nama Jenis</label>
                <input class="form-control" type="text" name="nama_jenis_hewan" value="{{ $jenisHewan->nama_jenis_hewan }}" required>
            </div>
            <div class="text-end">
                <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection