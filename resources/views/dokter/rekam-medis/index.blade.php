@extends('layouts.contentNavbarLayout')

@section('title', 'Pemeriksaan Dokter')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pemeriksaan /</span> Daftar Pasien
    </h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Antrian Pemeriksaan Dokter</h5>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Tanggal</th>
                        <th>Nama Hewan</th>
                        <th>Pemilik</th>
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
                            {{-- PERBAIKAN DI SINI: Gunakan waktu_daftar --}}
                            {{ \Carbon\Carbon::parse($item->waktu_daftar)->format('d M Y') }}
                        </td>
                        <td>
                            <strong>{{ $item->pet->nama }}</strong>
                            <div class="text-muted text-xs">{{ $item->pet->jenisHewan->nama_jenis_hewan ?? '-' }}</div>
                        </td>
                        <td>
                            {{ $item->pet->pemilik->user->nama ?? '-' }}
                        </td>
                        <td>
                            @if($item->status == '1') 
                                <span class="badge bg-label-warning">Menunggu Dokter</span>
                            @elseif($item->status == '2')
                                <span class="badge bg-label-success">Selesai</span>
                            @else
                                <span class="badge bg-label-secondary">Belum Siap</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->status == '1')
                                <a href="{{ route('dokter.show', $item->idreservasi_dokter) }}" class="btn btn-sm btn-success">
                                    <span class="bx bx-stethoscope me-1"></span> Periksa
                                </a>
                            @elseif($item->status == '2')
                                <a href="{{ route('dokter.show', $item->idreservasi_dokter) }}" class="btn btn-sm btn-outline-secondary">
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