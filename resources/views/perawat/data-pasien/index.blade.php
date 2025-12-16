@extends('layouts.contentNavbarLayout')

@section('title', 'Data Pasien')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Perawat /</span> Data Pasien</h4>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Pasien (Hewan)</h5>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nama Hewan</th>
                    <th>Jenis / Ras</th>
                    <th>Pemilik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($pets as $pet)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-sm me-2">
                                <span class="avatar-initial rounded-circle bg-label-warning"><i class='bx bxs-dog'></i></span>
                            </span>
                            <span class="fw-bold">{{ $pet->nama }}</span>
                        </div>
                    </td>
                    <td>
                        {{ $pet->jenisHewan->nama_jenis_hewan ?? '-' }} <br>
                        <small class="text-muted">{{ $pet->rasHewan->nama_ras ?? '-' }}</small>
                    </td>
                    <td>{{ $pet->pemilik->user->nama ?? '-' }}</td>
                    <td>
                        <a href="{{ route('perawat.data-pasien.show', $pet->idpet) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bx bx-show me-1"></i> Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection