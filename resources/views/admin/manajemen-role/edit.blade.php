@extends('layouts.argon')
@section('title', 'Edit Role')
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h6 class="mb-3">Edit Role</h6>
        <form action="{{ route('admin.manajemen-role.update', $role->idrole) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-control-label">Nama Role</label>
                <input class="form-control" type="text" name="nama_role" value="{{ $role->nama_role }}" required>
            </div>
            <div class="text-end">
                <a href="{{ route('admin.manajemen-role.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection