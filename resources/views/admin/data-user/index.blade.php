@extends('layouts.contentNavbarLayout')

@section('title', 'Data User')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Tabel Data User</h5>
          
          <div class="d-flex align-items-center gap-2">
              <form action="{{ url()->current() }}" method="GET">
                  <select name="status" class="form-select" onchange="this.form.submit()" style="width: 200px; cursor: pointer;">
                      <option value="aktif" {{ request('status') != 'Non-Aktif' ? 'selected' : '' }}>Aktif</option>
                      <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                  </select>
              </form>

              <a href="{{ route('admin.data-user.create') }}" class="btn btn-primary">
                  <span class="bx bx-plus me-1"></span> Tambah User
              </a>
          </div>
      </div>

      <div class="card-body px-0 pt-0 pb-2">
        
        @if(session('success'))
            <div class="alert alert-success text-white mx-4 my-2" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Berhasil!</strong> {{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center" width="5%">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Pengguna</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @forelse($users as $user)
              <tr>
                <td class="text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                </td>
                
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $user->nama }}</h6>
                    </div>
                  </div>
                </td>

                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                </td>

                <td>
                    @php
                        $status = $roleUser->status ?? 0;
                    @endphp

                    @if($user->trashed())
                        <span class="badge bg-label-secondary">Non-Aktif</span>
                    @else
                        <span class="badge bg-label-success">Aktif</span>
                    @endif
                </td>

                <td class="align-middle text-end pe-4">
                        @if(request('status') == 'Non-Aktif')
                            <a href="{{ route('admin.data-user.restore', $user->iduser) }}" 
                               class="text-success font-weight-bold text-xs me-3" 
                               onclick="return confirm('Pulihkan user ini?')">Restore</a>
                        @else
                            <a href="{{ route('admin.data-user.edit', $user->iduser) }}" class="text-secondary font-weight-bold text-xs me-3">Edit</a>
                            
                            <form action="{{ route('admin.data-user.destroy', $user->iduser) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger text-xs font-weight-bold p-0 border-0 bg-transparent">Hapus</button>
                            </form>
                        @endif
                    </td>
              </tr>
              @empty
              <tr>
                  <td colspan="5" class="text-center py-4">
                      <p class="text-xs font-weight-bold mb-0">Belum ada data user.</p>
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