@extends('layouts.argon')
@section('title', 'Data Perawat')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h6>Daftar Perawat</h6>
        <a href="{{ route('admin.data-perawat.create') }}" class="btn btn-primary btn-sm">Tambah Perawat</a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        @if(session('success'))
            <div class="alert alert-success text-white mx-4 my-2">{{ session('success') }}</div>
        @endif
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Perawat</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pendidikan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kontak</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($perawat as $p)
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $p->user->nama ?? '-' }}</h6>
                      <p class="text-xs text-secondary mb-0">{{ $p->user->email ?? '-' }}</p>
                    </div>
                  </div>
                </td>
                <td><span class="text-xs font-weight-bold">{{ $p->pendidikan }}</span></td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $p->no_hp }}</p>
                    <p class="text-xs text-secondary mb-0">{{ Str::limit($p->alamat, 20) }}</p>
                </td>
                <td>
                    @if($p->jenis_kelamin == 'L') <span class="badge badge-sm bg-gradient-info">Laki-laki</span>
                    @else <span class="badge badge-sm bg-gradient-pink">Perempuan</span> @endif
                </td>
                <td class="align-middle text-end px-4">
                  <a href="{{ route('admin.data-perawat.edit', $p->id_perawat) }}" class="text-secondary font-weight-bold text-xs me-3">Edit</a>
                  <form action="{{ route('admin.data-perawat.destroy', $p->id_perawat) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus?')">
                      @csrf @method('DELETE')
                      <button class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0">Hapus</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection