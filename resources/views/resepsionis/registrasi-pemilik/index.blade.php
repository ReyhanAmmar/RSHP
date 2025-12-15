@extends('layouts.contentNavbarLayout')

@section('title', 'Data Pemilik - Resepsionis')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Layanan /</span> Data Pemilik
    </h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pemilik Hewan</h5>
            <a href="{{ route('resepsionis.registrasi-pemilik.create') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-user-plus"></span> Tambah Pemilik
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success mx-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemilik</th>
                        <th>Kontak (WA)</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($pemilik as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $p->user->nama ?? 'User Terhapus' }}</strong><br>
                                <small class="text-muted">{{ $p->user->email ?? '-' }}</small>
                            </td>
                            <td>{{ $p->no_wa }}</td>
                            <td title="{{ $p->alamat }}">{{ Str::limit($p->alamat, 40) }}</td>
                            <td>
                                <a href="{{ route('resepsionis.registrasi-pemilik.edit', $p->idpemilik) }}" class="btn btn-sm btn-outline-warning">
                                    Edit
                                </a>
                                <form action="{{ route('resepsionis.registrasi-pemilik.destroy', $p->idpemilik) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data pemilik.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection