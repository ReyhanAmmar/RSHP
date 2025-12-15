@extends('layouts.contentNavbarLayout')
@section('title', 'Edit Tindakan')
@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0 font-weight-bold">Edit Kode Tindakan</p>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.tindakan.update', $tindakan->idkode_tindakan_terapi) }}" method="POST">
            @csrf @method('PUT')
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Kode Tindakan</label>
                        <input class="form-control @error('kode') is-invalid @enderror" type="text" name="kode" value="{{ old('kode', $tindakan->kode) }}" required>
                        @error('kode')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-control-label">Deskripsi Tindakan</label>
                        <input class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror" type="text" name="deskripsi_tindakan_terapi" value="{{ old('deskripsi_tindakan_terapi', $tindakan->deskripsi_tindakan_terapi) }}" required>
                        @error('deskripsi_tindakan_terapi')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Kategori</label>
                        <select class="form-control" name="idkategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->idkategori }}" {{ $tindakan->idkategori == $k->idkategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Kategori Klinis</label>
                        <select class="form-control" name="idkategori_klinis" required>
                            <option value="">-- Pilih Kategori Klinis --</option>
                            @foreach($klinis as $kl)
                                <option value="{{ $kl->idkategori_klinis }}" {{ $tindakan->idkategori_klinis == $kl->idkategori_klinis ? 'selected' : '' }}>
                                    {{ $kl->nama_kategori_klinis }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('admin.tindakan.index') }}" class="btn btn-secondary btn-sm">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection