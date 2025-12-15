@extends('layouts.contentNavbarLayout')

@section('title', 'Pemeriksaan Medis')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Pemeriksaan /</span> Rekam Medis
        </h4>
        <a href="{{ route('dokter.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="avatar avatar-xl mx-auto mb-2">
                            <span class="avatar-initial rounded-circle bg-label-success">
                                <i class="bx bx-paw bx-md"></i>
                            </span>
                        </div>
                        <h5 class="mb-0">{{ $reservasi->pet->nama }}</h5>
                        <small class="text-muted">{{ $reservasi->pet->jenisHewan->nama_jenis_hewan ?? 'Hewan' }} - {{ $reservasi->pet->rasHewan->nama_ras ?? '-' }}</small>
                    </div>
                    <hr>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <span class="fw-bold d-block">Pemilik:</span>
                                {{ $reservasi->pet->pemilik->user->nama ?? '-' }}
                            </li>
                            <li class="mb-2">
                                <span class="fw-bold d-block">Kontak:</span>
                                {{ $reservasi->pet->pemilik->no_wa ?? '-' }}
                            </li>
                            <li>
                                <span class="fw-bold d-block">Jenis Kelamin:</span>
                                @if($reservasi->pet->jenis_kelamin == 'Jantan')
                                    <span class="badge bg-label-info">Jantan</span>
                                @else
                                    <span class="badge bg-label-danger">Betina</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-label-primary">
                    <h5 class="mb-0 text-primary"><i class="bx bx-band-aid me-2"></i>Pemeriksaan Awal</h5>
                </div>
                <div class="card-body mt-3">
                    @if($rekamMedis)
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <span class="d-block text-muted">Berat Badan</span>
                                <span class="fs-4 fw-bold text-dark">{{ $rekamMedis->berat_badan }} <small>Kg</small></span>
                            </div>
                            <div class="col-6 mb-3">
                                <span class="d-block text-muted">Suhu Tubuh</span>
                                <span class="fs-4 fw-bold text-dark">{{ $rekamMedis->suhu_tubuh }} <small>°C</small></span>
                            </div>
                        </div>
                        <div class="mb-0">
                            <span class="d-block text-muted mb-1">Anamnesa / Keluhan:</span>
                            <div class="p-3 bg-lighter rounded">
                                {{ $rekamMedis->keluhan }}
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">Data pemeriksaan awal perawat belum tersedia.</div>
                    @endif
                </div>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-success"><i class="bx bx-stethoscope me-2"></i>Diagnosa & Tindakan</h5>
                    <span class="badge bg-success">drh. {{ Auth::user()->nama }}</span>
                </div>
                <div class="card-body">
                    
                    {{-- Form Update Rekam Medis (Diagnosa) --}}
                    @if($rekamMedis)
                    <form action="{{ route('dokter.update', $rekamMedis->idrekam_medis) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" for="diagnosa">Diagnosa Medis</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-search-alt"></i></span>
                                <textarea class="form-control" id="diagnosa" name="diagnosa" rows="3" placeholder="Masukkan hasil diagnosa penyakit..." required>{{ $rekamMedis->diagnosa }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="tindakan">Tindakan / Terapi</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-injection"></i></span>
                                <textarea class="form-control" id="tindakan" name="tindakan" rows="3" placeholder="Jelaskan tindakan medis yang dilakukan..." required>{{ $rekamMedis->tindakan }}</textarea>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="resep">Resep Obat</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-capsule"></i></span>
                                <textarea class="form-control" id="resep" name="resep" rows="3" placeholder="Tuliskan resep obat untuk pasien..." required>{{ $rekamMedis->resep }}</textarea>
                            </div>
                        </div>

                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="bx bx-info-circle me-2"></i>
                            <div>
                                Pastikan diagnosa sudah final sebelum menekan tombol Simpan. Status pasien akan berubah menjadi <strong>Selesai</strong>.
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bx bx-save me-1"></i> Simpan Rekam Medis
                            </button>
                        </div>
                    </form>
                    @else
                    <div class="text-center py-5">
                        <i class="bx bx-error-circle bx-lg text-warning mb-3"></i>
                        <p>Data rekam medis belum dibuat oleh perawat. Silakan hubungi perawat.</p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection