@extends('layouts.argon')
@section('title', 'Tambah Ras Hewan')
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0"><h6 class="mb-0">Tambah Ras Hewan</h6></div>
      <div class="card-body">
        <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Jenis Hewan</label>
                        <select class="form-control" name="idjenis_hewan" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($jenisHewan as $j)
                                <option value="{{ $j->idjenis_hewan }}" {{ (isset($selectedJenis) && $selectedJenis == $j->idjenis_hewan) ? 'selected' : '' }}>
                                    {{ $j->nama_jenis_hewan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Nama Ras</label>
                        <input class="form-control" type="text" name="nama_ras" placeholder="Contoh: Persia" required>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection