@extends('layouts.argon')
@section('title', 'Data Pemilik')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h6>Daftar Pemilik Hewan</h6>
        <a href="{{ route('admin.data-pemilik.create') }}" class="btn btn-primary btn-sm mb-0">Tambah Pemilik</a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kontak</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($pemilik as $p)
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $p->user->nama ?? 'User Terhapus' }}</h6>
                      <p class="text-xs text-secondary mb-0">{{ $p->user->email ?? '-' }}</p>
                    </div>
                  </div>
                </td>
                <td><span class="text-secondary text-xs font-weight-bold">{{ $p->no_wa }}</span></td>
                <td><span class="text-secondary text-xs font-weight-bold">{{ Str::limit($p->alamat, 30) }}</span></td>
                <td class="align-middle text-end px-4">
                  <a href="{{ route('admin.data-pemilik.edit', $p->idpemilik) }}" class="text-secondary font-weight-bold text-xs me-3">Edit</a>
                  <form action="{{ route('admin.data-pemilik.destroy', $p->idpemilik) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus?')">
                      @csrf @method('DELETE') <button class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0">Hapus</button>
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