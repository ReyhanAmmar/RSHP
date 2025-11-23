@extends('layouts.argon')
@section('title', 'Tambah Tindakan')
@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0 font-weight-bold">Tambah Tindakan Baru</p>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.tindakan.store') }}" method="POST">
            @csrf
            
            <div class="alert alert-light text-dark border-0 d-flex align-items-center" role="alert">
                <i class="ni ni-active-40 text-lg me-2 text-primary"></i>
                <span class="text-sm"><strong>Info:</strong> Kode Tindakan akan dibuat secara otomatis oleh sistem (Contoh: T001).</span>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Deskripsi Tindakan</label>
                        <input class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror" type="text" name="deskripsi_tindakan_terapi" value="{{ old('deskripsi_tindakan_terapi') }}" placeholder="Contoh: Suntik Vitamin C" required>
                        @error('deskripsi_tindakan_terapi')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Kategori</label>
                        <select class="form-control @error('idkategori') is-invalid @enderror" name="idkategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('idkategori')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Kategori Klinis</label>
                        <select class="form-control @error('idkategori_klinis') is-invalid @enderror" name="idkategori_klinis" required>
                            <option value="">-- Pilih Kategori Klinis --</option>
                            @foreach($klinis as $kl)
                                <option value="{{ $kl->idkategori_klinis }}">{{ $kl->nama_kategori_klinis }}</option>
                            @endforeach
                        </select>
                        @error('idkategori_klinis')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('admin.tindakan.index') }}" class="btn btn-secondary btn-sm">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection