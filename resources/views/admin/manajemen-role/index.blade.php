@extends('layouts.argon')

@section('title', 'Manajemen Role User')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between align-items-center">
        <h6>Tabel Manajemen Role User</h6>
        <a href="{{ route('admin.manajemen-role.create') }}" class="btn btn-primary btn-sm mb-0">Tambah Role ke User</a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        
        @if(session('success'))
            <div class="alert alert-success text-white mx-4 my-2">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-white mx-4 my-2">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center" width="5%">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama User</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role & Status</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              {{-- Loop menggunakan variabel $users yang dikirim controller --}}
              @forelse($users as $user)
              <tr>
                <td class="text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                </td>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $user->nama }}</h6>
                      <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                    </div>
                  </div>
                </td>
                <td>
                  {{-- Looping Role yang dimiliki User ini --}}
                  @foreach($user->roleuser as $ru)
                    <div class="d-flex align-items-center mb-2">
                        @php
                            $rName = $ru->role->nama_role ?? '-';
                            $cls = match($rName) {
                                'Administrator' => 'bg-gradient-danger',
                                'Dokter' => 'bg-gradient-success',
                                'Perawat' => 'bg-gradient-info',
                                'Resepsionis' => 'bg-gradient-warning',
                                'Pemilik' => 'bg-gradient-primary',
                                default => 'bg-gradient-secondary',
                            };
                        @endphp
                        <span class="badge badge-sm {{ $cls }} me-2">{{ $rName }}</span>
                        
                        @if($ru->status == 1)
                            <span class="text-xs text-success font-weight-bold">Aktif</span>
                        @else
                            <span class="text-xs text-danger font-weight-bold">Non-Aktif</span>
                        @endif

                        <div class="ms-auto">
                             <a href="{{ route('admin.manajemen-role.edit', $ru->idrole_user) }}" class="text-secondary font-weight-bold text-xs me-2" data-toggle="tooltip" title="Edit Status">
                                Edit
                            </a>
                            
                            <form action="{{ route('admin.manajemen-role.destroy', $ru->idrole_user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus role {{ $rName }} dari user {{ $user->nama }}?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                  @endforeach
                </td>
                <td></td>
              </tr>
              @empty
              <tr>
                  <td colspan="4" class="text-center py-4">
                      <span class="text-sm text-secondary">Belum ada data user dengan role.</span>
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