@extends('layouts.perawat')

@section('title', 'Input Rekam Medis')

@section('content')
<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <h6 class="mb-0">Pemeriksaan Awal</h6>
          <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary btn-sm ms-auto">Batal</a>
        </div>
      </div>
      
      <div class="card-body">
        <div class="alert alert-light border-0 bg-gray-100 mb-4 p-3" role="alert">
            <div class="row">
                <div class="col-md-4">
                    <span class="text-xs text-uppercase text-secondary font-weight-bold">Pasien</span>
                    <h6 class="mb-0">{{ $reservasi->pet->nama }}</h6>
                </div>
                <div class="col-md-4">
                    <span class="text-xs text-uppercase text-secondary font-weight-bold">Pemilik</span>
                    <h6 class="mb-0">{{ $reservasi->pet->pemilik->user->nama ?? '-' }}</h6>
                </div>
                <div class="col-md-4">
                    <span class="text-xs text-uppercase text-secondary font-weight-bold">Dokter</span>
                    <h6 class="mb-0">drh. {{ $reservasi->roleUser->user->nama ?? '-' }}</h6>
                </div>
            </div>
        </div>

        <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
            @csrf
            <input type="hidden" name="idreservasi_dokter" value="{{ $reservasi->idreservasi_dokter }}">
            <input type="hidden" name="idpet" value="{{ $reservasi->idpet }}">
            <input type="hidden" name="dokter_pemeriksa" value="{{ $reservasi->idrole_user }}">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Anamnesa (Keluhan Utama)</label>
                        <textarea class="form-control" name="anamnesa" rows="3" required placeholder="Contoh: Muntah sejak pagi, tidak mau makan..."></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Temuan Klinis (Suhu, Berat, dll)</label>
                        <textarea class="form-control" name="temuan_klinis" rows="3" placeholder="Contoh: Suhu 39.2°C, BB 4.5kg, Mukosa pucat..."></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Diagnosa Sementara</label>
                        <textarea class="form-control" name="diagnosa" rows="2" required placeholder="Contoh: Suspect Panleukopenia"></textarea>
                    </div>
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary btn-lg w-100">Simpan & Lanjut ke Tindakan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection