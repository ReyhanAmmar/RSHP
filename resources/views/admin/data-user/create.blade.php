@extends('layouts.argon')
@section('title', 'Tambah User')
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0 font-weight-bold">Tambah User Baru</p>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.data-user.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Nama Lengkap</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Email</label>
                        <input class="form-control" type="email" name="email" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Role (Jabatan)</label>
                        <select class="form-control" name="role_id" required>
                            <option value="">-- Pilih Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('admin.data-user.index') }}" class="btn btn-secondary btn-sm">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection