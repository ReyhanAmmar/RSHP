@extends('layouts.argon')
@section('title', 'Edit User')
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0 font-weight-bold">Edit Data User</p>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.data-user.update', $user->iduser) }}" method="POST">
            @csrf @method('PUT')
            
            @php $currentRole = $user->roleuser->first(); @endphp

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Nama Lengkap</label>
                        <input class="form-control" type="text" name="name" value="{{ $user->nama }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Email</label>
                        <input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Role</label>
                        <select class="form-control" name="role_id" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->idrole }}" {{ ($currentRole && $currentRole->idrole == $role->idrole) ? 'selected' : '' }}>
                                    {{ $role->nama_role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Status Akun</label>
                        <select class="form-control" name="status">
                            <option value="1" {{ ($currentRole && $currentRole->status == 1) ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ ($currentRole && $currentRole->status == 0) ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('admin.data-user.index') }}" class="btn btn-secondary btn-sm">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection