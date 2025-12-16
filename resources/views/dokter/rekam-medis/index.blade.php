@extends('layouts.contentNavbarLayout')

@section('title', 'Rekam Medis')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Manajemen /</span> Rekam Medis
    </h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Rekam Medis Pasien</h5>
            <span class="badge bg-info">{{ count($rekamMedisList) }} Rekam</span>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Hewan</th>
                        <th>Pemilik</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>Diagnosa</th>
                        <th class="text-center">Tindakan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($rekamMedisList as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->pet->nama }}</strong>
                            <div class="text-muted text-xs">{{ $item->pet->jenisHewan->nama_jenis_hewan ?? '-' }}</div>
                        </td>
                        <td>
                            {{ $item->pet->pemilik->user->nama ?? '-' }}
                        </td>
                        <td>
                            {{ $item->created_at->format('d-m-Y H:i') }}
                        </td>
                        <td>
                            <small>{{ Str::limit($item->diagnosa, 40) }}</small>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-label-primary">{{ count($item->detailRekamMedis) }} Item</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('dokter.rekam-medis.show', $item->idrekam_medis) }}" class="btn btn-sm btn-info">
                                <i class="bx bx-show me-1"></i> Lihat
                            </a>
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
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->status == '1')
                                <a href="{{ route('dokter.rekam-medis.show', $item->idreservasi_dokter) }}" class="btn btn-sm btn-success">
                                    <span class="bx bx-stethoscope me-1"></span> Periksa
                                </a>
                            @elseif($item->status == '2')
                                <a href="{{ route('dokter.rekam-medis.show', $item->idreservasi_dokter) }}" class="btn btn-sm btn-outline-secondary">
                                    <span class="bx bx-file me-1"></span> Detail
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted mb-2"><i class="bx bx-check-circle bx-lg"></i></div>
                            Tidak ada pasien yang menunggu pemeriksaan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection