@extends('layouts.contentNavbarLayout')

@section('title', 'Detail Pasien')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Pasien /</span> Detail</h4>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="mx-auto mb-3">
                    <span class="avatar p-2 rounded-circle bg-label-primary" style="width: 80px; height: 80px; font-size: 2.5rem; display:flex; align-items:center; justify-content:center;">
                        <i class='bx bxs-dog'></i>
                    </span>
                </div>
                <h5 class="card-title mb-1">{{ $pet->nama }}</h5>
                <p class="text-muted mb-3">{{ $pet->rasHewan->nama_ras ?? 'Unknown' }}</p>
                
                <div class="text-start mt-4">
                    <p class="mb-1"><strong>Pemilik:</strong> {{ $pet->pemilik->user->nama ?? '-' }}</p>
                    <p class="mb-1"><strong>Gender:</strong> {{ $pet->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}</p>
                    <p class="mb-1"><strong>Tgl Lahir:</strong> {{ $pet->tanggal_lahir }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 mb-4">
        <div class="card h-100">
            <h5 class="card-header">Riwayat Rekam Medis</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Dokter</th>
                            <th>Diagnosa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pet->rekamMedis as $rm)
                        <tr>
                            <td>{{ $rm->created_at->format('d/m/Y') }}</td>
                            <td>{{ $rm->dokter->user->nama ?? '-' }}</td>
                            <td>{{ Str::limit($rm->diagnosa ?? $rm->anamnesa, 40) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">Belum ada riwayat medis.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-12">
        <a href="{{ route('perawat.data-pasien.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection