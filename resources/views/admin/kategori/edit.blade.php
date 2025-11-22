<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Kategori</h1>
        <form action="{{ route('admin.kategori.update', $kategori->idkategori) }}" method="POST">
            @csrf @method('PUT')
            <div>
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
            </div>
            <div class="btn-group">
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>
</html>