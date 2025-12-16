@extends('layouts.contentNavbarLayout')
@section('title', 'Tindakan Terapi')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Tindakan & Terapi</h5>
        <div class="d-flex gap-2">
            <form action="{{ url()->current() }}" method="GET">
                <select name="status" class="form-select" onchange="this.form.submit()" style="width: 200px; cursor: pointer;">
                    <option value="aktif" {{ request('status') != 'non-aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="non-aktif" {{ request('status') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </form>
            @if(request('status') != 'non-aktif')
                <a href="{{ route('admin.tindakan.create') }}" class="btn btn-primary"><span class="bx bx-plus me-1"></span> Tambah</a>
            @endif
        </div>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Tindakan</th>
                    {{-- Tambahkan kolom harga/keterangan jika ada --}}
                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Biaya</th> --}}
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($tindakan as $item)
                <tr>
                    <td>
                        <div class="px-3">
                            <span class="fw-bold text-sm">{{ $item->kode ?? '-' }} - {{ $item->deskripsi_tindakan_terapi }}</span>
                        </div>
                    </td>
                    {{-- Contoh kolom biaya jika ada --}}
                    {{-- <td>Rp {{ number_format($item->biaya, 0, ',', '.') }}</td> --}}
                    
                    <td class="align-middle text-end pe-4">
                        @if(request('status') == 'non-aktif')
                            <a href="{{ route('admin.tindakan.restore', $item->getKey()) }}" class="text-success fw-bold text-xs me-3" onclick="return confirm('Restore?')">Restore</a>
                        @else
                            <a href="{{ route('admin.tindakan.edit', $item->getKey()) }}" class="text-secondary fw-bold text-xs me-3">Edit</a>
                            <form action="{{ route('admin.tindakan.destroy', $item->getKey()) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="text-danger fw-bold text-xs border-0 bg-transparent p-0">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="2" class="text-center py-4">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection