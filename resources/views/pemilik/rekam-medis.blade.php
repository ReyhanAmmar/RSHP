@extends('layouts.contentNavbarLayout')

@section('title', 'Rekam Medis Hewan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Kesehatan /</span> Rekam Medis
    </h4>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Riwayat Kesehatan Hewan</h5>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal Periksa</th>
                        <th>Nama Hewan</th>
                        <th>Diagnosa Dokter</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($rekamMedis as $index => $rm)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $rm->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xs me-2">
                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                        <i class="bx bx-paw"></i>
                                    </span>
                                </div>
                                <strong>{{ $rm->pet->nama }}</strong>
                            </div>
                        </td>
                        <td>
                            <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                {{ $rm->diagnosa ?? 'Belum ada diagnosa' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pemilik.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-sm btn-info">
                                <span class="bx bx-search-alt me-1"></span> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bx bx-folder-open bx-lg text-secondary mb-2"></i>
                            <p class="text-muted">Belum ada data rekam medis.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection