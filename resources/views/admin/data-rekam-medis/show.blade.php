@extends('layouts.contentNavbarLayout')

@section('title', 'Detail Rekam Medis')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Rekam Medis /</span> Detail</h4>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <h5 class="card-header">Informasi Pemeriksaan</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Hewan</label>
                        <input type="text" class="form-control" value="{{ $rekamMedis->pet->nama }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pemilik</label>
                        <input type="text" class="form-control" value="{{ $rekamMedis->pet->pemilik->user->nama ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dokter Pemeriksa</label>
                        <input type="text" class="form-control" value="{{ $rekamMedis->dokter->user->nama ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Anamnesa (Keluhan)</label>
                        <textarea class="form-control" rows="2" readonly>{{ $rekamMedis->anamnesa }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Diagnosa Dokter</label>
                        <textarea class="form-control" rows="3" readonly>{{ $rekamMedis->diagnosa }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Tindakan & Obat</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Tindakan/Obat</th>
                            <th>Keterangan Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekamMedis->detailRekamMedis as $detail)
                        <tr>
                            <td>{{ $detail->tindakan->nama_tindakan ?? '-' }}</td>
                            <td>{{ $detail->detail ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="text-center">Tidak ada tindakan tambahan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('admin.data-rekam-medis.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection