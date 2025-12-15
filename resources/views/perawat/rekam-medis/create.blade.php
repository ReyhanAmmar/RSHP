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
                        {{-- Hidden ID Reservasi & ID Hewan --}}
                        <input type="hidden" name="idreservasi_dokter" value="{{ $reservasi->idreservasi_dokter }}">
                        <input type="hidden" name="idpet" value="{{ $reservasi->idpet }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="berat_badan">Berat Badan (Kg)</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-dumbbell"></i></span>
                                    <input type="number" step="0.01" class="form-control" id="berat_badan" name="berat_badan" placeholder="0.00" required />
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="suhu_tubuh">Suhu Tubuh (°C)</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bxs-thermometer"></i></span>
                                    <input type="number" step="0.1" class="form-control" id="suhu_tubuh" name="suhu_tubuh" placeholder="36.5" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="keluhan">Anamnesa / Keluhan Awal</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-notepad"></i></span>
                                <textarea class="form-control" id="keluhan" name="keluhan" rows="3" placeholder="Jelaskan kondisi hewan saat datang..." required></textarea>
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