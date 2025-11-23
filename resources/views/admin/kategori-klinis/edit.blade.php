@extends('layouts.argon')
@section('title', 'Edit Kategori Klinis')
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0 font-weight-bold">Edit Kategori Klinis</p>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.kategori-klinis.update', $kategori->idkategori_klinis) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Nama Kategori Klinis</label>
                        <input class="form-control @error('nama_kategori_klinis') is-invalid @enderror" type="text" name="nama_kategori_klinis" value="{{ old('nama_kategori_klinis', $kategori->nama_kategori_klinis) }}" required>
                        @error('nama_kategori_klinis')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary btn-sm">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection