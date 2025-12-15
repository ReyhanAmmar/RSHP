@extends('layouts.contentNavbarLayout')
@section('title', 'Tambah Kategori')
@section('content')
<div class="row"><div class="col-md-6"><div class="card"><div class="card-body">
    <h6 class="mb-3">Tambah Kategori</h6>
    <form action="{{ route('admin.kategori.store') }}" method="POST">@csrf
        <div class="form-group"><label class="form-control-label">Nama Kategori</label><input class="form-control" type="text" name="nama_kategori" required></div>
        <div class="text-end"><a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary btn-sm">Kembali</a><button class="btn btn-primary btn-sm">Simpan</button></div>
    </form>
</div></div></div></div>
@endsection