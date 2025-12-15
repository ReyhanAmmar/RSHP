@extends('layouts.contentNavbarLayout')

@section('title', 'Antrian Temu Dokter')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Layanan /</span> Temu Dokter
    </h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Antrian Pasien Hari Ini</h5>
            <a href="{{ route('temu-dokter.create') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-plus"></span> Daftar Pasien Baru
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>Pasien</th>
                        <th>Dokter Tujuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($temuDokter as $i)
                    <tr>
                        <td class="text-center">
                            <span class="badge bg-label-primary rounded-circle p-2">{{ $i->no_urut }}</span>
                        </td>
                        <td>
                            <strong class="d-block">{{ $i->pet->nama }}</strong>
                            <small class="text-muted">{{ $i->pet->pemilik->user->nama ?? 'Tanpa Pemilik' }}</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xs me-2">
                                    <span class="avatar-initial rounded-circle bg-label-info">Dr</span>
                                </div>
                                <span>{{ $i->roleUser->user->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td>
                            @if($i->status == '0')
                                <span class="badge bg-label-warning">Menunggu</span>
                            @elseif($i->status == '1')
                                <span class="badge bg-label-success">Selesai</span>
                            @else
                                <span class="badge bg-label-danger">Batal</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($i->status == '0')
                                <form action="{{ route('temu-dokter.update-status', $i->idreservasi_dokter) }}" method="POST" class="d-inline" onsubmit="return confirm('Tandai pasien ini sudah selesai diperiksa?');">
                                    @csrf 
                                    @method('PUT')
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-sm btn-icon btn-outline-success" title="Selesai">
                                        <i class="bx bx-check"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-muted"><i class="bx bx-check-double"></i></span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Belum ada antrian hari ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection