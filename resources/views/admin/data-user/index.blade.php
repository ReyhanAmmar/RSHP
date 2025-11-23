@extends('layouts.argon')

@section('title', 'Data User')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between align-items-center">
        <h6>Tabel Data User</h6>
        <a href="{{ route('admin.data-user.create') }}" class="btn btn-primary btn-sm mb-0">
            <i class="fa fa-plus me-2"></i>Tambah User
        </a>
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
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role & Status</th>
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
                        $roleUser = $user->roleuser->first();
                        $roleName = ($roleUser && $roleUser->role) ? $roleUser->role->nama_role : 'No Role';
                        
                        // Warna badge berdasarkan role
                        $badgeClass = match($roleName) {
                            'Administrator' => 'bg-gradient-danger',
                            'Dokter' => 'bg-gradient-success',
                            'Perawat' => 'bg-gradient-info',
                            'Resepsionis' => 'bg-gradient-warning',
                            'Pemilik' => 'bg-gradient-primary',
                            default => 'bg-gradient-secondary',
                        };

                        $status = $roleUser->status ?? 0;
                    @endphp

                    <span class="badge badge-sm {{ $badgeClass }}">{{ $roleName }}</span>
                    
                    @if($status == 1)
                        <span class="text-xs text-success font-weight-bold ms-2">Active</span>
                    @else
                        <span class="text-xs text-secondary font-weight-bold ms-2">Inactive</span>
                    @endif
                </td>

                <td class="align-middle text-end px-4">
                  <a href="{{ route('admin.data-user.edit', $user->iduser) }}" class="text-secondary font-weight-bold text-xs me-3" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>

                  <a href="{{ route('admin.data-user.resetpassword', $user->iduser) }}" class="text-info font-weight-bold text-xs me-3" onclick="return confirm('Reset password user ini menjadi 123456?')" data-toggle="tooltip" title="Reset Password">
                    Reset
                  </a>

                  <form action="{{ route('admin.data-user.destroy', $user->iduser) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                      @csrf @method('DELETE')
                      <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0">
                          Hapus
                      </button>
                  </form>
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