@extends('layouts.contentNavbarLayout')

@section('title', 'Profil Saya')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Akun /</span> Profil Dokter
    </h4>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6 class="alert-heading mb-2"><i class="bx bx-error-circle me-2"></i>Error</h6>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-xl mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-primary" style="width: 80px; height: 80px; font-size: 32px;">
                            <i class="bx bx-user-md"></i>
                        </span>
                    </div>
                    <h5 class="mb-1">{{ $user->nama }}</h5>
                    <p class="text-muted mb-3">
                        @if($user->roleUser && count($user->roleUser) > 0)
                            {{ $user->roleUser[0]->role->nama_role ?? 'Dokter' }}
                        @else
                            Dokter
                        @endif
                    </p>

                    @if($user->dokter)
                    <div class="alert alert-light small">
                        <strong>Email:</strong> {{ $user->email }}<br>
                        <strong>No HP:</strong> {{ $user->dokter->no_hp ?? '-' }}<br>
                        <strong>Bidang:</strong> {{ $user->dokter->bidang_dokter ?? '-' }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Profil</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $user->nama) }}" required>
                                @error('nama')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        @if($user->dokter)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">No. HP</label>
                                <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $user->dokter->no_hp ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bidang/Spesialisasi</label>
                                <input type="text" class="form-control" name="bidang_dokter" value="{{ old('bidang_dokter', $user->dokter->bidang_dokter ?? '') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="2">{{ old('alamat', $user->dokter->alamat ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" @selected(($user->dokter->jenis_kelamin ?? '') == 'Laki-laki')>Laki-laki</option>
                                <option value="Perempuan" @selected(($user->dokter->jenis_kelamin ?? '') == 'Perempuan')>Perempuan</option>
                            </select>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                            @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
