@extends('layouts.contentNavbarLayout')

@section('title', 'Data Ras Hewan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Ras Hewan</h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Ras Hewan</h5>
            <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-plus"></span> Tambah Ras
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ras</th>
                        <th>Jenis Hewan</th>
                        <th width="200">Aksi</th> </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($ras_hewan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $item->nama_ras }}</strong></td>
                        <td>
                            <span class="badge bg-label-info">
                                {{ $item->jenisHewan->nama_jenis_hewan ?? 'Tidak Diketahui' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.ras-hewan.edit', ['id' => $item->idras_hewan]) }}" class="text-secondary font-weight-bold text-xs me-3">
                                Edit
                            </a>

                            <form action="{{ route('admin.ras-hewan.destroy', ['id' => $item->idras_hewan]) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection