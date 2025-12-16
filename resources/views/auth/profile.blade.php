@extends('layouts.contentNavbarLayout')

@section('title', 'Pengaturan Akun - Profil')

@section('page-script')
<script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function (e) {
        const input = document.getElementById('upload');
        const img = document.getElementById('uploadedAvatar');
        const resetBtn = document.querySelector('.account-image-reset');
        const originalSrc = img.src;

        if(input && img) {
            input.onchange = () => {
                const [file] = input.files;
                if (file) {
                    img.src = URL.createObjectURL(file);
                }
            };
        }

        if(resetBtn) {
            resetBtn.onclick = () => {
                input.value = "";
                img.src = originalSrc;
            };
        }
    });
</script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pengaturan Akun /</span> Profil Saya
</h4>

<div class="row">
  <div class="col-md-12">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
      <h5 class="card-header">Detail Profil</h5>
      
      <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img src="{{ Auth::user()->foto ? asset('storage/'.Auth::user()->foto) : asset('assets/img/avatars/1.png') }}" 
                 alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
            
            <div class="button-wrapper">
              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Upload foto baru</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input type="file" id="upload" name="foto" class="account-file-input" hidden accept="image/png, image/jpeg, image/jpg" />
              </label>
              <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                <i class="bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Reset</span>
              </button>
              <p class="text-muted mb-0">Format: JPG, GIF, PNG. Ukuran maks 2MB.</p>
            </div>
          </div>
        </div>

        <hr class="my-0">

        <div class="card-body">
            <div class="row">
              
              <div class="mb-3 col-md-6">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input class="form-control" type="text" id="nama" name="nama" value="{{ old('nama', Auth::user()->nama) }}" />
              </div>

              <div class="mb-3 col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input class="form-control" type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" />
              </div>

              @php
                  $user = Auth::user();
                  $roleName = $user->roleUser[0]->role->nama_role ?? 'User';
                  
                  $no_hp = '';
                  $alamat = '';
                  $jenis_kelamin = ''; 
                  $bidang_dokter = '';
                  $pendidikan = '';

                  if($user->dokter) {
                      $no_hp = $user->dokter->no_hp;
                      $alamat = $user->dokter->alamat;
                      $jenis_kelamin = $user->dokter->jenis_kelamin;
                      $bidang_dokter = $user->dokter->bidang_dokter;
                  } 
                  elseif($user->perawat) {
                      $no_hp = $user->perawat->no_hp;
                      $alamat = $user->perawat->alamat;
                      $jenis_kelamin = $user->perawat->jenis_kelamin;
                      $pendidikan = $user->perawat->pendidikan;
                  } 
                  elseif($user->pemilik) {
                      $no_hp = $user->pemilik->no_wa; 
                      $alamat = $user->pemilik->alamat;
                  }
              @endphp

              <div class="mb-3 col-md-6">
                <label for="no_hp" class="form-label">No Handphone / WhatsApp</label>
                <input class="form-control" type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $no_hp) }}" placeholder="08xxxxxxxx" />
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label">Role</label>
                <input type="text" class="form-control" value="{{ $roleName }}" readonly disabled />
              </div>

              @if($user->dokter || $user->perawat)
              <div class="mb-3 col-md-6">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
                  <option value="">Pilih Jenis Kelamin</option>
                  <option value="L" {{ old('jenis_kelamin', $jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="P" {{ old('jenis_kelamin', $jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
              </div>
              @endif

              @if($user->dokter)
              <div class="mb-3 col-md-6">
                <label for="bidang_dokter" class="form-label">Bidang Keahlian Dokter</label>
                <input class="form-control" type="text" id="bidang_dokter" name="bidang_dokter" 
                       value="{{ old('bidang_dokter', $bidang_dokter) }}" placeholder="Contoh: Dokter Umum, Spesialis Bedah" />
              </div>
              @endif

              @if($user->perawat)
              <div class="mb-3 col-md-6">
                <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                <input class="form-control" type="text" id="pendidikan" name="pendidikan" 
                       value="{{ old('pendidikan', $pendidikan) }}" placeholder="Contoh: D3 Keperawatan, S1 Ners" />
              </div>
              @endif

              <div class="mb-3 col-12">
                <label for="alamat" class="form-label">Alamat Lengkap</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $alamat) }}</textarea>
              </div>
            </div>
            
            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2">Simpan Profil</button>
            </div>
        </div>
      </form>
    </div>

    <div class="card mb-4">
      <h5 class="card-header">Ganti Password</h5>
      <div class="card-body">
        <form method="POST" action="{{ route('profile.update') }}"> 
            @csrf @method('PUT')
            <div class="row">
                <div class="mb-3 col-md-6 form-password-toggle">
                  <label class="form-label" for="currentPassword">Password Saat Ini</label>
                  <div class="input-group input-group-merge">
                    <input class="form-control" type="password" name="current_password" id="currentPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6 form-password-toggle">
                  <label class="form-label" for="newPassword">Password Baru</label>
                  <div class="input-group input-group-merge">
                    <input class="form-control" type="password" name="password" id="newPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>

                <div class="mb-3 col-md-6 form-password-toggle">
                  <label class="form-label" for="confirmPassword">Konfirmasi Password Baru</label>
                  <div class="input-group input-group-merge">
                    <input class="form-control" type="password" name="password_confirmation" id="confirmPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
            </div>
            <button type="submit" class="btn btn-warning me-2">Update Password</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection