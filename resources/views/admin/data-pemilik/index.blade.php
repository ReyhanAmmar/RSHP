@extends('layouts.contentNavbarLayout')

@section('title', 'Data Pemilik')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Daftar Pemilik Hewan</h5>
    
          <div class="d-flex align-items-center gap-2">
              <form action="{{ url()->current() }}" method="GET">
                  <select name="status" class="form-select" onchange="this.form.submit()" style="width: 200px; cursor: pointer;">
                      <option value="aktif" {{ request('status') != 'Non-Aktif' ? 'selected' : '' }}>Aktif</option>
                      <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                  </select>
              </form>
              
              @if(request('status') != 'Non-Aktif')
                <a href="{{ route('admin.data-pemilik.create') }}" class="btn btn-primary">
                    <span class="bx bx-plus me-1"></span> Tambah
                </a>
              @endif
          </div>
      </div>

      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Nama Pemilik</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kontak</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @forelse($pemilik as $item)
              <tr>
                <td>
                  <div class="d-flex px-3 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $item->user->nama ?? 'User Terhapus' }}</h6>
                      <p class="text-xs text-secondary mb-0">{{ $item->user->email ?? '-' }}</p>
                    </div>
                  </div>
                </td>

                <td>
                    <span class="text-xs font-weight-bold text-secondary">
                        <i class='bx bxl-whatsapp text-success me-1'></i>{{ $item->no_wa }}
                    </span>
                </td>

                <td>
                    <p class="text-xs text-secondary mb-0 text-truncate" style="max-width: 200px;">
                        {{ Str::limit($item->alamat, 40) }}
                    </p>
                </td>

                <td class="align-middle text-end px-4">
                    @if(request('status') == 'Non-Aktif')
                        <a href="{{ route('admin.data-pemilik.restore', $item->getKey()) }}" 
                           class="text-success font-weight-bold text-xs me-3"
                           onclick="return confirm('Pulihkan data pemilik ini? Akun user juga akan dipulihkan.')">
                           Restore
                        </a>
                    @else
                        <a href="{{ route('admin.data-pemilik.edit', $item->getKey()) }}" class="text-secondary font-weight-bold text-xs me-3">Edit</a>
                        
                        <form action="{{ route('admin.data-pemilik.destroy', $item->getKey()) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus pemilik ini?')">
                            @csrf @method('DELETE') 
                            <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0">Hapus</button>
                        </form>
                    @endif
                </td>
              </tr>
              @empty
              <tr>
                  <td colspan="4" class="text-center py-4">
                      <span class="text-xs text-secondary">Tidak ada data pemilik ditemukan.</span>
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