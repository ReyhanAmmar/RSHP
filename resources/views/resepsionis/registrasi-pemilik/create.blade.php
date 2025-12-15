@extends('layouts.contentNavbarLayout')

@section('title', 'Registrasi Pemilik Baru')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Layanan /</span> Registrasi Pemilik</h4>

    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Pemilik Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('resepsionis.registrasi-pemilik.store') }}" method="POST">
                        @csrf
                        
                        <h6 class="text-muted text-uppercase font-weight-bolder mb-3">Data Akun</h6>
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap Pemilik" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="email@contoh.com" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-lock-alt"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required />
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="text-muted text-uppercase font-weight-bolder mb-3">Data Kontak</h6>
                        <div class="mb-3">
                            <label class="form-label" for="no_wa">No. WhatsApp</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                <input type="number" class="form-control" id="no_wa" name="no_wa" placeholder="08123456789" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="alamat">Alamat Lengkap</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-map"></i></span>
                                <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('resepsionis.registrasi-pemilik.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection