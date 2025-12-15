@extends('layouts.contentNavbarLayout')

@section('title', 'Edit Pemeriksaan Awal')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Rekam Medis /</span> Edit Data</h4>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Tanda Vital Pasien</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('perawat.rekam-medis.update', $rekamMedis->idrekam_medis) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Berat Badan (Kg)</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-dumbbell"></i></span>
                                    <input type="number" step="0.01" class="form-control" name="berat_badan" value="{{ $rekamMedis->berat_badan }}" required />
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Suhu Tubuh (°C)</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bxs-thermometer"></i></span>
                                    <input type="number" step="0.1" class="form-control" name="suhu_tubuh" value="{{ $rekamMedis->suhu_tubuh }}" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Anamnesa</label>
                            <textarea class="form-control" name="keluhan" rows="3" required>{{ $rekamMedis->keluhan }}</textarea>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-outline-secondary me-2">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection