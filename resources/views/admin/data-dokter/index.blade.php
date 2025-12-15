@extends('layouts.contentNavbarLayout')
@section('title', 'Data Dokter')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h6>Daftar Dokter</h6>
        <a href="{{ route('admin.data-dokter.create') }}" class="btn btn-primary btn-sm">Tambah Dokter</a>
        <form action="{{ route('admin.data-dokter.index') }}" method="GET" class="d-flex gap-2">
            <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                <option value="aktif" {{ $status == 'aktif' ? 'selected' : '' }}>Data Aktif</option>
                <option value="non-aktif" {{ $status == 'non-aktif' ? 'selected' : '' }}>Non-Aktif (Sampah)</option>
            </select>
            <a href="{{ route('admin.data-dokter.create') }}" class="btn btn-primary btn-sm mb-0">Tambah</a>
        </form>
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
              @foreach($dokter as $d)
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $d->user->nama ?? '-' }}</h6>
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
                  <a href="{{ route('admin.data-dokter.edit', $d->id_dokter) }}" class="text-secondary font-weight-bold text-xs me-3">Edit</a>
                  <form action="{{ route('admin.data-dokter.destroy', $d->id_dokter) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus?')">
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