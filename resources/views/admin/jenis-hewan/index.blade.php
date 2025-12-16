@extends('layouts.contentNavbarLayout')
@section('title', 'Jenis Hewan')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Jenis Hewan</h5>
        <div class="d-flex gap-2">
            <form action="{{ url()->current() }}" method="GET">
                <select name="status" class="form-select" onchange="this.form.submit()" style="width: 200px; cursor: pointer;">
                    <option value="aktif" {{ request('status') != 'Non-Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </form>
            @if(request('status') != 'Non-Aktif')
                <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-primary"><span class="bx bx-plus me-1"></span> Tambah</a>
            @endif
        </div>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Jenis</th>
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenis as $item)
                <tr>
                    <td>
                        <div class="d-flex px-3 py-1">
                            <span class="fw-bold text-sm">{{ $item->nama_jenis_hewan }}</span>
                        </div>
                    </td>
                    <td class="align-middle text-end pe-4">
                        @if(request('status') == 'Non-Aktif')
                            <a href="{{ route('admin.jenis-hewan.restore', $item->getKey()) }}" class="text-success fw-bold text-xs me-3" onclick="return confirm('Restore data ini?')">Restore</a>
                        @else
                            <a href="{{ route('admin.jenis-hewan.edit', $item->getKey()) }}" class="text-secondary fw-bold text-xs me-3">Edit</a>
                            <form action="{{ route('admin.jenis-hewan.destroy', $item->getKey()) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-danger fw-bold text-xs border-0 bg-transparent p-0">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="2" class="text-center py-4 text-xs">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection