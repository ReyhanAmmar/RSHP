@extends('layouts.contentNavbarLayout')

@section('title', 'Data Temu Dokter')

@section('content')

<div class="card mb-4">
    <div class="card-header pb-0 d-flex justify-content-between">
        <h5 class="mb-0">Daftar Antrian</h5>
        
        <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-center">
            <select name="status" class="form-select" onchange="this.form.submit()" style="width: 200px; cursor: pointer;">
                <option value="aktif" {{ request('status') != 'Non-Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
            </select>
        </form>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. Antrian</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pasien</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dokter Tujuan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <span class="badge bg-label-primary">{{ $item->no_urut }}</span>
                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $item->pet->nama ?? 'Unknown' }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $item->pet->pemilik->user->nama ?? '-' }}</p>
                        </div>
                    </td>

                    <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $item->dokter->user->nama ?? '-' }}</p>
                        <p class="text-xs text-secondary mb-0">Poli Umum</p> </td>

                    <td>
                        <span class="text-secondary text-xs font-weight-bold">{{ $item->waktu_daftar }}</span>
                    </td>

                    <td class="align-middle text-sm">
                        @if($item->status == 'Menunggu')
                            <span class="badge bg-label-warning">Menunggu</span>
                        @elseif($item->status == 'Selesai')
                            <span class="badge bg-label-success">Selesai</span>
                        @else
                            <span class="badge bg-label-secondary">Lainnya</span>
                        @endif
                    </td>

                    <td class="align-middle text-center">
                        @if(request('status') == 'Non-Aktif')
                            <a href="{{ route('admin.data-temu-dokter.restore', $item->idreservasi_dokter) }}" 
                            class="text-success fw-bold text-xs" 
                            data-bs-toggle="tooltip" 
                            title="Pulihkan Data"
                            onclick="return confirm('Kembalikan data ini menjadi aktif?')">
                            Restore
                            </a>
                        @else
                            <form action="{{ route('admin.data-temu-dokter.destroy', $item->idreservasi_dokter) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus antrian ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger text-xs fw-bold p-0 border-0 bg-transparent">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <span class="text-xs text-secondary">Belum ada data antrian.</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection