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

                        <div class="mb-3">
                            <label class="form-label">Anamnesa (Riwayat Keluhan) <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="anamnesa" rows="3" required>{{ $rekamMedis->anamnesa }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Temuan Klinis</label>
                            <textarea class="form-control" name="temuan_klinis" rows="3">{{ $rekamMedis->temuan_klinis }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Diagnosa <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="diagnosa" rows="3" required>{{ $rekamMedis->diagnosa }}</textarea>
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