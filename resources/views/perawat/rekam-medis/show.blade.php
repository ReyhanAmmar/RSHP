@extends('layouts.contentNavbarLayout')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Rekam Medis /</span> Detail
    </h4>

    <div class="row">
        <div class="col-xl-10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Pemeriksaan Hewan</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('perawat.rekam-medis.edit', $rekamMedis->idrekam_medis) }}" class="btn btn-sm btn-warning">
                            <i class="bx bx-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-sm btn-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- DATA HEWAN -->
                    <h6 class="text-muted text-uppercase font-weight-bolder mb-3">Informasi Hewan</h6>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Hewan</label>
                            <p class="text-muted">{{ $rekamMedis->pet->nama ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jenis Hewan</label>
                            <p class="text-muted">{{ $rekamMedis->pet->jenisHewan->nama_jenis_hewan ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Ras</label>
                            <p class="text-muted">{{ $rekamMedis->pet->rasHewan->nama_ras ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <p class="text-muted">
                                @if($rekamMedis->pet->jenis_kelamin == 'J')
                                    Jantan
                                @elseif($rekamMedis->pet->jenis_kelamin == 'B')
                                    Betina
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- DATA PEMILIK -->
                    <hr class="my-4">
                    <h6 class="text-muted text-uppercase font-weight-bolder mb-3">Informasi Pemilik</h6>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Pemilik</label>
                            <p class="text-muted">{{ $rekamMedis->pet->pemilik->user->nama ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">No. WhatsApp</label>
                            <p class="text-muted">{{ $rekamMedis->pet->pemilik->no_wa ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Alamat</label>
                            <p class="text-muted">{{ $rekamMedis->pet->pemilik->alamat ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- DATA PEMERIKSAAN -->
                    <hr class="my-4">
                    <h6 class="text-muted text-uppercase font-weight-bolder mb-3">Data Pemeriksaan</h6>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Dokter Pemeriksa</label>
                            <p class="text-muted">drh. {{ $rekamMedis->dokter->user->nama ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Pemeriksaan</label>
                            <p class="text-muted">{{ $rekamMedis->created_at ? $rekamMedis->created_at->format('d-m-Y H:i') : '-' }}</p>
                        </div>
                    </div>

                    <!-- ANAMNESA -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Anamnesa (Riwayat Keluhan)</label>
                        <div class="p-3 bg-light rounded">
                            <p class="text-muted mb-0">{{ $rekamMedis->anamnesa ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- TEMUAN KLINIS -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Temuan Klinis</label>
                        <div class="p-3 bg-light rounded">
                            <p class="text-muted mb-0">{{ $rekamMedis->temuan_klinis ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- DIAGNOSA -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Diagnosa</label>
                        <div class="p-3 bg-light rounded">
                            <p class="text-muted mb-0">{{ $rekamMedis->diagnosa ?? 'Belum ada diagnosa' }}</p>
                        </div>
                    </div>

                    <!-- DETAIL TINDAKAN TERAPI -->
                    <hr class="my-4">
                    <h6 class="text-muted text-uppercase font-weight-bolder mb-3">Detail Tindakan Terapi</h6>
                    <div class="mb-3">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTindakanModal">
                            <i class="bx bx-plus me-1"></i> Tambah Tindakan
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
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
                                        <strong>{{ $detail->kodeTindakan->kode ?? '-' }}</strong>
                                    </td>
                                    <td>
                                        <small>{{ $detail->kodeTindakan->deskripsi_tindakan_terapi ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <small>{{ $detail->detail ?? '-' }}</small>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('perawat.rekam-medis.destroy-detail', $detail->iddetail_rekam_medis) }}" method="POST" class="d-inline">
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
                                        <small class="text-muted">Belum ada tindakan terapi</small>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('perawat.rekam-medis.edit', $rekamMedis->idrekam_medis) }}" class="btn btn-warning">
                            <i class="bx bx-edit me-1"></i> Edit Data
                        </a>
                        <form action="{{ route('perawat.rekam-medis.destroy', $rekamMedis->idrekam_medis) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus rekam medis ini?')">
                                <i class="bx bx-trash me-1"></i> Hapus
                            </button>
                        </form>
                        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH TINDAKAN TERAPI -->
<div class="modal fade" id="addTindakanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tindakan Terapi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('perawat.rekam-medis.store-detail', $rekamMedis->idrekam_medis) }}" method="POST">
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
