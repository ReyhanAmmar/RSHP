@extends('layouts.contentNavbarLayout')

@section('title', 'Tindakan Terapi')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Rekam Medis /</span> Tambah Tindakan Terapi
    </h4>

    <div class="row">
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
                    
                    <div class="divider my-3"></div>
                    
                    <div class="alert alert-light small mb-0">
                        <strong>Pemilik:</strong> {{ $rekamMedis->pet->pemilik->user->nama ?? '-' }}<br>
                        <strong>Tanggal:</strong> {{ $rekamMedis->created_at->format('d-m-Y H:i') }}<br>
                        <strong>Diagnosa:</strong> {{ Str::limit($rekamMedis->diagnosa, 50) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Tindakan yang Diterapkan</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Deskripsi Tindakan</th>
                                <th>Detail</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekamMedis->detailRekamMedis as $detail)
                            <tr>
                                <td><strong>{{ $detail->kodeTindakan->kode ?? '-' }}</strong></td>
                                <td>{{ $detail->kodeTindakan->deskripsi_tindakan_terapi ?? '-' }}</td>
                                <td><small>{{ $detail->detail ?? '-' }}</small></td>
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
                                    <span class="text-muted">Belum ada tindakan yang ditambahkan</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Tambah Tindakan Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('perawat.rekam-medis.store-detail', $rekamMedis->idrekam_medis) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Pilih Tindakan <span class="text-danger">*</span></label>
                            <select class="form-control @error('idkode_tindakan_terapi') is-invalid @enderror" name="idkode_tindakan_terapi" required>
                                <option value="">-- Pilih Tindakan --</option>
                                @foreach($tindakan as $t)
                                    <option value="{{ $t->idkode_tindakan_terapi }}">
                                        [{{ $t->kode }}] {{ $t->deskripsi_tindakan_terapi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idkode_tindakan_terapi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Keterangan / Detail Tindakan</label>
                            <textarea class="form-control" name="detail" rows="3" placeholder="Jelaskan detail atau hasil dari tindakan yang dilakukan..."></textarea>
                        </div>

                        <div class="alert alert-info small mb-3">
                            <i class="bx bx-info-circle me-1"></i>
                            Anda dapat menambahkan beberapa tindakan untuk satu rekam medis.
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i> Tambah Tindakan
                            </button>
                            <a href="{{ route('perawat.rekam-medis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-secondary">
                                <i class="bx bx-show me-1"></i> Lihat Detail
                            </a>
                            <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
