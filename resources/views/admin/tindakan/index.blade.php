@extends('layouts.contentNavbarLayout')
@section('title', 'Tindakan Terapi')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h6>Kode Tindakan & Terapi</h6>
        <a href="{{ route('admin.tindakan.create') }}" class="btn btn-primary btn-sm mb-0">Tambah Tindakan</a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        @if(session('success'))
            <div class="alert alert-success text-white mx-4 my-2">{{ session('success') }}</div>
        @endif
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deskripsi</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Klinis</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($tindakan as $item)
              <tr>
                <td>
                    <span class="badge bg-gradient-light text-dark ms-3">{{ $item->kode }}</span>
                </td>
                <td><h6 class="mb-0 text-sm">{{ $item->deskripsi_tindakan_terapi }}</h6></td>
                <td><span class="text-secondary text-xs font-weight-bold">{{ $item->kategori->nama_kategori ?? '-' }}</span></td>
                <td><span class="text-secondary text-xs font-weight-bold">{{ $item->kategoriKlinis->nama_kategori_klinis ?? '-' }}</span></td>
                <td class="align-middle text-end px-4">
                  <a href="{{ route('admin.tindakan.edit', $item->idkode_tindakan_terapi) }}" class="text-secondary font-weight-bold text-xs me-3">Edit</a>
                  <form action="{{ route('admin.tindakan.destroy', $item->idkode_tindakan_terapi) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus?')">
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