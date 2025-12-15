@extends('layouts.contentNavbarLayout')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Rekam Medis /</span> Detail Pemeriksaan
        </h4>
        <a href="{{ route('pemilik.rekam-medis') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar avatar-xl bg-label-success rounded-circle mx-auto mb-3">
                        <i class="bx bx-paw fs-1"></i>
                    </div>
                    <h4 class="card-title text-success mb-1">{{ $rm->pet->nama }}</h4>
                    <p class="text-muted">{{ $rm->pet->jenisHewan->nama_jenis_hewan }}</p>
                    
                    <hr>
                    
                    <div class="text-start">
                        <p class="mb-1"><span class="fw-bold">Tanggal:</span> {{ $rm->created_at->format('d F Y') }}</p>
                        <p class="mb-1"><span class="fw-bold">Dokter:</span> drh. {{ $rm->temuDokter->roleUser->user->nama ?? '-' }}</p>
                        <p class="mb-1"><span class="fw-bold">Berat:</span> {{ $rm->berat_badan }} Kg</p>
                        <p class="mb-1"><span class="fw-bold">Suhu:</span> {{ $rm->suhu_tubuh }} °C</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white"><i class="bx bx-file me-2"></i>Hasil Pemeriksaan</h5>
                </div>
                <div class="card-body mt-4">
                    
                    <div class="mb-4">
                        <label class="fw-bold text-uppercase text-muted small">Keluhan Awal</label>
                        <div class="p-3 bg-lighter rounded mt-1">
                            {{ $rm->keluhan ?? '-' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-uppercase text-muted small">Diagnosa</label>
                            <div class="alert alert-primary mt-1 mb-0" role="alert">
                                {{ $rm->diagnosa ?? '-' }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-uppercase text-muted small">Tindakan Medis</label>
                            <div class="alert alert-info mt-1 mb-0" role="alert">
                                {{ $rm->tindakan ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold text-uppercase text-muted small">Resep Obat / Catatan</label>
                        <div class="p-3 border border-success rounded bg-label-success mt-1 text-dark">
                            <i class="bx bx-capsule me-2"></i>
                            {{ $rm->resep ?? 'Tidak ada resep khusus.' }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection