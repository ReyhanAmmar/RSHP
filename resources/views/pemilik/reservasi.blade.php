@extends('layouts.contentNavbarLayout')

@section('title', 'Riwayat Reservasi')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Riwayat Reservasi
    </h4>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Jadwal Temu Dokter</h5>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Hewan</th>
                        <th>Dokter Tujuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($reservasi as $index => $res)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <i class="bx bx-calendar me-1 text-muted"></i> 
                            {{ \Carbon\Carbon::parse($res->waktu_daftar)->format('d M Y') }}
                        </td>
                        <td><strong>{{ $res->pet->nama }}</strong></td>
                        <td>drh. {{ $res->roleUser->user->nama ?? '-' }}</td>
                        <td>
                            @if($res->status == '0')
                                <span class="badge bg-label-warning">Menunggu</span>
                            @elseif($res->status == '1')
                                <span class="badge bg-label-info">Diperiksa</span>
                            @elseif($res->status == '2')
                                <span class="badge bg-label-success">Selesai</span>
                            @else
                                <span class="badge bg-label-danger">Batal</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">Belum ada riwayat reservasi.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection