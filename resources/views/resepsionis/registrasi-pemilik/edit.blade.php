@extends('layouts.contentNavbarLayout')

@section('title', 'Edit Pemilik')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Layanan /</span> Edit Pemilik</h4>

    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit Pemilik</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('resepsionis.registrasi-pemilik.update', $pemilik->idpemilik) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <h6 class="text-muted text-uppercase font-weight-bolder mb-3">Data Akun</h6>
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $pemilik->user->nama) }}" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $pemilik->user->email) }}" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password (Opsional)</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Isi jika ingin ubah password" />
                        </div>

                        <hr class="my-4">

                        <h6 class="text-muted text-uppercase font-weight-bolder mb-3">Data Kontak</h6>
                        <div class="mb-3">
                            <label class="form-label" for="no_wa">No. WhatsApp</label>
                            <input type="number" class="form-control" id="no_wa" name="no_wa" value="{{ old('no_wa', $pemilik->no_wa) }}" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="alamat">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ old('alamat', $pemilik->alamat) }}</textarea>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('resepsionis.registrasi-pemilik.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection