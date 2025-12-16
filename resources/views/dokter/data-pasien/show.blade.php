@extends('layouts.contentNavbarLayout')

@section('title', 'Detail Pasien')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Data Pasien /</span> {{ $pet->nama }}
        </h4>
        <a href="{{ route('dokter.data-pasien.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-xl mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-success">
                            <i class="bx bx-paw bx-lg"></i>
                        </span>
                    </div>
                    <h5 class="mb-1">{{ $pet->nama }}</h5>
                    <p class="text-muted mb-3">
                        {{ $pet->jenisHewan->nama_jenis_hewan ?? '-' }} - {{ $pet->rasHewan->nama_ras ?? '-' }}
                    </p>
                    <div class="divider"></div>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-bold d-block text-muted small">Jenis Kelamin</span>
                                @if($pet->jenis_kelamin == 'J')
                                    <span class="badge bg-label-info">Jantan</span>
                                @elseif($pet->jenis_kelamin == 'B')
                                    <span class="badge bg-label-danger">Betina</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold d-block text-muted small">Warna/Tanda Khusus</span>
                                <span>{{ $pet->warna_tanda ?? '-' }}</span>
                            </li>
                            <li>
                                <span class="fw-bold d-block text-muted small">Tanggal Registrasi</span>
                                <span>{{ $pet->created_at->format('d-m-Y') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-label-primary">
                    <h6 class="mb-0 text-primary"><i class="bx bx-user me-2"></i>Informasi Pemilik</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <span class="fw-bold d-block text-muted small">Nama</span>
                            <span>{{ $pet->pemilik->user->nama ?? '-' }}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-bold d-block text-muted small">Email</span>
                            <span>{{ $pet->pemilik->user->email ?? '-' }}</span>
                        </li>
                        <li class="mb-2">
                            <span class="fw-bold d-block text-muted small">WhatsApp</span>
                            <span>{{ $pet->pemilik->no_wa ?? '-' }}</span>
                        </li>
                        <li>
                            <span class="fw-bold d-block text-muted small">Alamat</span>
                            <span>{{ $pet->pemilik->alamat ?? '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-label-success">
                    <h6 class="mb-0 text-success"><i class="bx bx-band-aid me-2"></i>Riwayat Rekam Medis</h6>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Dokter</th>
                                <th>Diagnosa</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pet->rekamMedis as $rm)
                            <tr>
                                <td>
                                    <small>{{ $rm->created_at->format('d-m-Y H:i') }}</small>
                                </td>
                                <td>
                                    <small>drh. {{ $rm->dokter->user->nama ?? '-' }}</small>
                                </td>
                                <td>
                                    <small>{{ Str::limit($rm->diagnosa, 50) }}</small>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-show"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3">
                                    <small class="text-muted">Belum ada rekam medis</small>
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
@endsection
