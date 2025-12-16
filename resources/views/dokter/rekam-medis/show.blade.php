@extends('layouts.contentNavbarLayout')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Rekam Medis /</span> Detail Pemeriksaan
        </h4>
        <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6 class="alert-heading mb-2"><i class="bx bx-error-circle me-2"></i>Validasi Error</h6>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- KOLOM KIRI: INFO PASIEN -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-xl mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-success">
                            <i class="bx bx-paw bx-md"></i>
                        </span>
                    </div>
                    <h5 class="mb-1">{{ $rekamMedis->pet->nama }}</h5>
                    <small class="text-muted">{{ $rekamMedis->pet->jenisHewan->nama_jenis_hewan ?? 'Hewan' }}</small>
                </div>
                <hr class="my-0">
                <div class="card-body">
                    <div class="alert alert-info small mb-0">
                        <strong>Pemilik:</strong> {{ $rekamMedis->pet->pemilik->user->nama ?? '-' }}<br>
                        <strong>Tanggal:</strong> {{ $rekamMedis->created_at->format('d-m-Y H:i') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: DETAIL PEMERIKSAAN -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Data Pemeriksaan Medis</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('dokter.rekam-medis.update', $rekamMedis->idrekam_medis) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Anamnesa (Riwayat Keluhan)</label>
                            <textarea class="form-control" name="anamnesa" rows="3" required>{{ $rekamMedis->anamnesa }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Temuan Klinis</label>
                            <textarea class="form-control" name="temuan_klinis" rows="3">{{ $rekamMedis->temuan_klinis }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Diagnosa</label>
                            <textarea class="form-control" name="diagnosa" rows="3" required>{{ $rekamMedis->diagnosa }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Suhu Tubuh (°C)</label>
                                <input type="number" step="0.1" class="form-control" name="suhu" value="{{ $rekamMedis->suhu }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Berat Badan (kg)</label>
                                <input type="number" step="0.1" class="form-control" name="berat" value="{{ $rekamMedis->berat }}">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- DETAIL TINDAKAN TERAPI -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Tindakan Terapi</h5>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addDetailModal">
                        <i class="bx bx-plus me-1"></i> Tambah Tindakan
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Kode Tindakan</th>
                                <th>Deskripsi</th>
                                <th>Detail</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekamMedis->detailRekamMedis as $detail)
                            <tr>
                                <td>
                                    <strong>{{ $detail->tindakan->kode ?? '-' }}</strong>
                                </td>
                                <td>
                                    {{ $detail->tindakan->deskripsi_tindakan_terapi ?? '-' }}
                                </td>
                                <td>
                                    <small>{{ $detail->detail ?? '-' }}</small>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('dokter.rekam-medis.destroy-detail', $detail->id_detail_rekam_medis) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus tindakan ini?')">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3">
                                    <span class="text-muted">Belum ada detail tindakan</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH DETAIL -->
<div class="modal fade" id="addDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tindakan Terapi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dokter.rekam-medis.store-detail', $rekamMedis->idrekam_medis) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Tindakan <span class="text-danger">*</span></label>
                        <select class="form-control" name="idkode_tindakan_terapi" required>
                            <option value="">-- Pilih Tindakan --</option>
                            @foreach($tindakan as $t)
                                <option value="{{ $t->idkode_tindakan_terapi }}">
                                    [{{ $t->kode }}] {{ $t->deskripsi_tindakan_terapi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Keterangan / Detail</label>
                        <textarea class="form-control" name="detail" rows="3" placeholder="Masukkan detail tindakan (opsional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-plus me-1"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection