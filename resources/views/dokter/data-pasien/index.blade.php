@extends('layouts.contentNavbarLayout')

@section('title', 'Data Pasien')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Manajemen /</span> Data Pasien
    </h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pasien</h5>
            <div class="btn-group" role="group">
                <a href="{{ route('dokter.data-pasien.index', ['status' => 'aktif']) }}" 
                   class="btn btn-sm {{ $status === 'aktif' ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="bx bx-check-circle me-1"></i> Aktif
                </a>
                <a href="{{ route('dokter.data-pasien.index', ['status' => 'Non-Aktif']) }}" 
                   class="btn btn-sm {{ $status === 'Non-Aktif' ? 'btn-warning' : 'btn-outline-warning' }}">
                    <i class="bx bx-x-circle me-1"></i> Non-Aktif
                </a>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Hewan</th>
                        <th>Jenis</th>
                        <th>Ras</th>
                        <th>Pemilik</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($pets as $pet)
                    <tr>
                        <td>
                            <strong>{{ $pet->nama }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-label-info">{{ $pet->jenisHewan->nama_jenis_hewan ?? '-' }}</span>
                        </td>
                        <td>
                            {{ $pet->rasHewan->nama_ras ?? '-' }}
                        </td>
                        <td>
                            {{ $pet->pemilik->user->nama ?? '-' }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('dokter.data-pasien.show', $pet->idpet) }}" class="btn btn-sm btn-info">
                                <i class="bx bx-show me-1"></i> Lihat
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <div class="text-muted mb-2"><i class="bx bx-inbox bx-lg"></i></div>
                            Tidak ada data pasien.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
