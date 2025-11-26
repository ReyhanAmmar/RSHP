@extends('layouts.perawat')
@section('title', 'Input Rekam Medis')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header pb-0"><h6 class="mb-0">Input Pemeriksaan Awal</h6></div>
      <div class="card-body">
        <div class="alert alert-light border mb-3">
            <strong>Pasien:</strong> {{ $reservasi->pet->nama }} | 
            <strong>Pemilik:</strong> {{ $reservasi->pet->pemilik->user->nama ?? '-' }} | 
            <strong>Dokter:</strong> drh. {{ $reservasi->roleUser->user->nama ?? '-' }}
        </div>

        <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
            @csrf
            <input type="hidden" name="idreservasi_dokter" value="{{ $reservasi->idreservasi_dokter }}">
            <input type="hidden" name="idpet" value="{{ $reservasi->idpet }}">
            <input type="hidden" name="dokter_pemeriksa" value="{{ $reservasi->idrole_user }}">

            <div class="form-group">
                <label class="form-control-label">Anamnesa (Keluhan)</label>
                <textarea class="form-control" name="anamnesa" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-control-label">Temuan Klinis</label>
                <textarea class="form-control" name="temuan_klinis" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label class="form-control-label">Diagnosa Sementara</label>
                <textarea class="form-control" name="diagnosa" rows="3" required></textarea>
            </div>

            <div class="text-end">
                <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary btn-sm">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan & Lanjut</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection