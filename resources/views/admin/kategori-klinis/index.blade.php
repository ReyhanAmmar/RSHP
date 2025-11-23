@extends('layouts.argon')
@section('title', 'Kategori Klinis')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h6>Data Kategori Klinis</h6>
        <a href="{{ route('admin.kategori-klinis.create') }}" class="btn btn-primary btn-sm mb-0">Tambah Data</a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        @if(session('success'))
            <div class="alert alert-success text-white mx-4 my-2">{{ session('success') }}</div>
        @endif
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="10%">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Kategori Klinis</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($klinis as $item)
              <tr>
                <td class="text-center"><span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span></td>
                <td><h6 class="mb-0 text-sm">{{ $item->nama_kategori_klinis }}</h6></td>
                <td class="align-middle text-end px-4">
                  <a href="{{ route('admin.kategori-klinis.edit', $item->idkategori_klinis) }}" class="text-secondary font-weight-bold text-xs me-3">Edit</a>
                  <form action="{{ route('admin.kategori-klinis.destroy', $item->idkategori_klinis) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus?')">
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