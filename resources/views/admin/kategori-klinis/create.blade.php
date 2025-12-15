@extends('layouts.contentNavbarLayout')
@section('title', 'Tambah Kategori Klinis')
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0 font-weight-bold">Tambah Kategori Klinis</p>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Nama Kategori Klinis</label>
                        <input class="form-control @error('nama_kategori_klinis') is-invalid @enderror" type="text" name="nama_kategori_klinis" value="{{ old('nama_kategori_klinis') }}" placeholder="Contoh: Bedah Minor" required>
                        @error('nama_kategori_klinis')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary btn-sm">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection