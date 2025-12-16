@extends('layouts.contentNavbarLayout')
@section('title', 'Data Pet')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Hewan Peliharaan</h5>
        <div class="d-flex gap-2">
            <form action="{{ url()->current() }}" method="GET">
                <select name="status" class="form-select" onchange="this.form.submit()" style="width: 200px; cursor: pointer;">
                    <option value="aktif" {{ request('status') != 'Non-Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </form>
            @if(request('status') != 'Non-Aktif')
                <a href="{{ route('admin.data-pet.create') }}" class="btn btn-primary"><span class="bx bx-plus me-1"></span> Tambah</a>
            @endif
        </div>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Nama Hewan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pemilik</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ras</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Hewan</th>
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($pet as $item)
                <tr>
                    <td>
                        <div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $item->nama }}</h6>
                                <p class="text-xs text-secondary mb-0">
                                    {{ $item->jenis_kelamin == 'J' ? 'Jantan' : ($item->jenis_kelamin == 'B' ? 'Betina' : '-') }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-sm font-weight-bold">{{ $item->pemilik->user->nama ?? 'Owner Terhapus' }}</span>
                    </td>
                    <td>
                        <span class="text-xs font-weight-bold">{{ $item->rasHewan->nama_ras ?? '-' }}</span>
                    </td>
                    <td>
                        <span class="badge bg-label-warning">{{ $item->jenisHewan->nama_jenis_hewan ?? '-' }}</span>
                    </td>
                    <td class="align-middle text-end pe-4">
                        @if(request('status') == 'Non-Aktif')
                            <a href="{{ route('admin.data-pet.restore', $item->getKey()) }}" class="text-success fw-bold text-xs me-3" onclick="return confirm('Restore hewan ini?')">Restore</a>
                        @else
                            <a href="{{ route('admin.data-pet.edit', $item->getKey()) }}" class="text-secondary fw-bold text-xs me-3">Edit</a>
                            <form action="{{ route('admin.data-pet.destroy', $item->getKey()) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus hewan ini?')">
                                @csrf @method('DELETE')
                                <button class="text-danger fw-bold text-xs border-0 bg-transparent p-0">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-xs">Tidak ada data hewan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection