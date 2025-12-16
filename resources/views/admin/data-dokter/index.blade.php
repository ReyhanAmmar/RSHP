@extends('layouts.contentNavbarLayout')

@section('title', 'Data Dokter')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h6>Daftar Dokter</h6>
          <div class="d-flex align-items-center gap-2">
              <form action="{{ url()->current() }}" method="GET">
                  <select name="status" class="form-select" onchange="this.form.submit()" style="width: 200px; cursor: pointer;">
                      <option value="aktif" {{ request('status') != 'Non-Aktif' ? 'selected' : '' }}>Aktif</option>
                      <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                  </select>
              </form>
              
              @if(request('status') != 'Non-Aktif')
                <a href="{{ route('admin.data-dokter.create') }}" class="btn btn-primary">
                    <span class="bx bx-plus me-1"></span> Tambah
                </a>
              @endif
          </div>
      </div>

      <div class="card-body px-0 pt-0 pb-2">
        @if(session('success'))
            <div class="alert alert-success text-white mx-4 my-2">{{ session('success') }}</div>
        @endif

        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Dokter</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bidang</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kontak</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @forelse($dokters as $d)
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $d->user->nama ?? 'User Terhapus' }}</h6>
                      <p class="text-xs text-secondary mb-0">{{ $d->user->email ?? '-' }}</p>
                    </div>
                  </div>
                </td>

                <td><span class="text-xs font-weight-bold">{{ $d->bidang_dokter }}</span></td>

                <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $d->no_hp }}</p>
                    <p class="text-xs text-secondary mb-0">{{ Str::limit($d->alamat, 20) }}</p>
                </td>

                <td>
                    @if($d->jenis_kelamin == 'L') 
                        <span class="badge badge-sm bg-gradient-info">Laki-laki</span>
                    @else 
                        <span class="badge badge-sm bg-gradient-pink">Perempuan</span> 
                    @endif
                </td>

                <td class="align-middle text-end px-4">
                  @if(request('status') == 'Non-Aktif')
                      <a href="{{ route('admin.data-dokter.restore', $d->getKey()) }}" 
                         class="text-success font-weight-bold text-xs me-3"
                         onclick="return confirm('Pulihkan data dokter ini? Akun user juga akan dipulihkan.')">
                         Restore
                      </a>
                  @else
                      <a href="{{ route('admin.data-dokter.edit', $d->getKey()) }}" class="text-secondary font-weight-bold text-xs me-3">Edit</a>
                      
                      <form action="{{ route('admin.data-dokter.destroy', $d->getKey()) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus?')">
                          @csrf @method('DELETE')
                          <button class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0">Hapus</button>
                      </form>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                  <td colspan="5" class="text-center py-4">
                      <span class="text-xs text-secondary">Tidak ada data dokter ditemukan.</span>
                  </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection