@extends('layouts.contentNavbarLayout')
@section('title', 'Data Hewan')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h6>Daftar Hewan (Pet)</h6>
        <a href="{{ route('admin.data-pet.create') }}" class="btn btn-primary btn-sm mb-0">Tambah Hewan</a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Hewan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis/Ras</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pemilik</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($pets as $pet)
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $pet->nama }}</h6>
                      <p class="text-xs text-secondary mb-0">{{ $pet->warna_tanda }}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</p>
                  <p class="text-xs text-secondary mb-0">{{ $pet->rasHewan->nama_ras ?? '-' }}</p>
                </td>
                <td>
                    <span class="text-secondary text-xs font-weight-bold">{{ $pet->pemilik->user->nama ?? 'No Owner' }}</span>
                </td>
                <td>
                  <span class="badge badge-sm bg-gradient-{{ $pet->jenis_kelamin == 'J' ? 'info' : 'danger' }}">
                    {{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}
                  </span>
                </td>
                <td class="align-middle text-end px-4">
                  <a href="{{ route('admin.data-pet.edit', $pet->idpet) }}" class="text-secondary font-weight-bold text-xs me-3">Edit</a>
                  <form action="{{ route('admin.data-pet.destroy', $pet->idpet) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus?')">
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