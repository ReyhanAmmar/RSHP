@extends('layouts.contentNavbarLayout')

@section('title', 'Pemeriksaan Awal')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Antrian /</span> Pemeriksaan Awal
    </h4>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="avatar avatar-xl mx-auto mb-2">
                            <span class="avatar-initial rounded-circle bg-label-info">
                                <i class="bx bx-paw bx-md"></i>
                            </span>
                        </div>
                        <h5 class="mb-0">{{ $reservasi->pet->nama }}</h5>
                        <small class="text-muted">{{ $reservasi->pet->jenisHewan->nama_jenis_hewan ?? 'Hewan' }}</small>
                    </div>
                    
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <span class="fw-bold d-block">Pemilik:</span>
                                {{ $reservasi->pet->pemilik->user->nama ?? '-' }}
                            </li>
                            <li class="mb-2">
                                <span class="fw-bold d-block">Dokter Tujuan:</span>
                                drh. {{ $reservasi->roleUser->user->nama ?? '-' }}
                            </li>
                            <li>
                                <span class="fw-bold d-block">No. Antrian:</span>
                                <span class="badge bg-primary">{{ $reservasi->no_urut }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Tanda Vital</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="idreservasi_dokter" value="{{ $reservasi->idreservasi_dokter }}">
                        <input type="hidden" name="idpet" value="{{ $reservasi->idpet }}">

                        <div class="mb-3">
                            <label class="form-label" for="anamnesa">Anamnesa (Riwayat Keluhan) <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-notepad"></i></span>
                                <textarea class="form-control" id="anamnesa" name="anamnesa" rows="3" placeholder="Jelaskan kondisi hewan saat datang, keluhan pemilik, dan riwayat kesehatan..." required></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="temuan_klinis">Temuan Klinis</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-pulse"></i></span>
                                <textarea class="form-control" id="temuan_klinis" name="temuan_klinis" rows="3" placeholder="Hasil pemeriksaan fisik dan klinis yang ditemukan..."></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="diagnosa">Diagnosa <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-stethoscope"></i></span>
                                <textarea class="form-control" id="diagnosa" name="diagnosa" rows="3" placeholder="Diagnosa penyakit atau kondisi yang teridentifikasi..." required></textarea>
                            </div>
                        </div>

                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="bx bx-error-circle me-2"></i>
                            <div>
                                Pastikan data sudah benar. Setelah disimpan, data akan masuk ke dashboard dokter.
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan & Lanjutkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection