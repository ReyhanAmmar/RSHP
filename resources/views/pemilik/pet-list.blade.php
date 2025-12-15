@extends('layouts.contentNavbarLayout')

@section('title', 'Hewan Peliharaan Saya')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Hewan Saya
    </h4>

    <div class="row">
        @forelse($pets as $pet)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar avatar-xl bg-label-primary rounded-circle mx-auto mb-3">
                        <i class="bx bx-paw fs-1"></i>
                    </div>
                    <h5 class="card-title mb-1">{{ $pet->nama }}</h5>
                    <p class="text-muted mb-3">{{ $pet->jenisHewan->nama_jenis_hewan ?? 'Hewan' }} - {{ $pet->rasHewan->nama_ras ?? '-' }}</p>
                    
                    <div class="d-flex justify-content-around bg-lighter p-2 rounded mb-3">
                        <div>
                            <span class="d-block text-muted text-xs">Kelamin</span>
                            <span class="fw-bold text-dark">
                                @if($pet->jenis_kelamin == 'Jantan') <i class="bx bx-male-sign text-info"></i> Jantan
                                @else <i class="bx bx-female-sign text-danger"></i> Betina
                                @endif
                            </span>
                        </div>
                        <div>
                            <span class="d-block text-muted text-xs">Umur</span>
                            <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} Thn</span>
                        </div>
                        <div>
                            <span class="d-block text-muted text-xs">Warna</span>
                            <span class="fw-bold text-dark">{{ $pet->warna }}</span>
                        </div>
                    </div>

                    <a href="{{ route('pemilik.rekam-medis') }}" class="btn btn-outline-primary btn-sm w-100">Lihat Riwayat Medis</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="bx bx-info-circle me-2"></i>
                <div>
                    Anda belum memiliki data hewan peliharaan yang terdaftar. Silakan hubungi Resepsionis untuk pendaftaran.
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection