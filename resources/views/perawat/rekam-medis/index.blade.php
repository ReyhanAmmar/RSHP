@extends('layouts.contentNavbarLayout')

@section('title', 'Rekam Medis')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Tugas Medis /</span> Rekam Medis
    </h4>

    {{-- ANTRIAN MENUNGGU --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pasien Menunggu Pemeriksaan</h5>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nama Hewan</th>
                        <th>Pemilik</th>
                        <th>Dokter Tujuan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($antrian as $index => $item)
                    <tr>
                        <td class="text-center">
                            <span class="badge bg-label-primary rounded-circle p-2">{{ $item->no_urut }}</span>
                        </td>
                        <td>
                            <strong>{{ $item->pet->nama }}</strong>
                            <div class="text-muted text-xs">{{ $item->pet->jenisHewan->nama_jenis_hewan ?? '-' }}</div>
                        </td>
                        <td>
                            {{ $item->pet->pemilik->user->nama ?? '-' }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bx bx-plus-medical text-danger me-2"></i>
                                <span>drh. {{ $item->roleUser->user->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td>
                            @if($item->status == '0')
                                <span class="badge bg-label-warning">Menunggu</span>
                            @else
                                <span class="badge bg-label-secondary">Diproses</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('perawat.rekam-medis.create', $item->idreservasi_dokter) }}" class="btn btn-sm btn-primary">
                                <span class="bx bx-edit me-1"></span> Periksa
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="text-muted mb-2"><i class="bx bx-check-circle bx-lg"></i></div>
                            Tidak ada pasien yang menunggu saat ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- HISTORY REKAM MEDIS --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Riwayat Rekam Medis</h5>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Hewan</th>
                        <th>Pemilik</th>
                        <th>Dokter Pemeriksa</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($rekamMedisHistory as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->pet->nama }}</strong>
                            <div class="text-muted text-xs">{{ $item->pet->jenisHewan->nama_jenis_hewan ?? '-' }}</div>
                        </td>
                        <td>
                            {{ $item->pet->pemilik->user->nama ?? '-' }}
                        </td>
                        <td>
                            drh. {{ $item->dokter->user->nama ?? '-' }}
                        </td>
                        <td>
                            {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                        </td>
                        <td>
                            <span class="badge bg-label-success">Selesai</span>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('perawat.rekam-medis.show', $item->idrekam_medis) }}">
                                        <i class="bx bx-show me-1"></i> Lihat Detail
                                    </a>
                                    <a class="dropdown-item" href="{{ route('perawat.rekam-medis.edit', $item->idrekam_medis) }}">
                                        <i class="bx bx-edit me-1"></i> Edit
                                    </a>
                                    <hr class="dropdown-divider">
                                    <form action="{{ route('perawat.rekam-medis.destroy', $item->idrekam_medis) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Hapus rekam medis ini?')">
                                            <i class="bx bx-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="text-muted mb-2"><i class="bx bx-inbox bx-lg"></i></div>
                            Belum ada rekam medis.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection