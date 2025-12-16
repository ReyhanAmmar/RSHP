@extends('layouts.contentNavbarLayout')

@section('title', 'Data Rekam Medis')

@section('content')

<div class="card mb-4">
    <div class="card-header pb-0 d-flex justify-content-between">
        <h5 class="mb-0">Riwayat Pemeriksaan</h5>
        
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pasien</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dokter</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diagnosa</th>
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $item->created_at->format('d/m/Y') }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $item->created_at->format('H:i') }} WIB</p>
                            </div>
                        </div>
                    </td>

                    <td>
                        <h6 class="mb-0 text-sm">{{ $item->pet->nama ?? 'Unknown' }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $item->pet->rasHewan->nama_ras ?? '-' }}</p>
                    </td>

                    <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $item->dokter->user->nama ?? '-' }}</p>
                    </td>

                    <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold">
                            {{ Str::limit($item->diagnosa ?? $item->anamnesa, 40) }}
                        </span>
                    </td>

                    <td class="align-middle text-end pe-4">
                        <a href="{{ route('admin.data-rekam-medis.show', $item->idrekam_medis) }}" class="text-secondary font-weight-bold text-xs me-3" data-toggle="tooltip" data-original-title="Lihat detail">
                            Detail
                        </a>

                        @if(request('status') == 'Non-Aktif')
                            <a href="{{ route('admin.data-rekam-medis.restore', $item->idrekam_medis) }}" class="text-success font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Restore data">
                                Restore
                            </a>
                        @else
                            <form action="{{ route('admin.data-rekam-medis.destroy', $item->idrekam_medis) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger text-xs font-weight-bold p-0 border-0 bg-transparent">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <span class="text-xs text-secondary">Belum ada riwayat medis.</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection