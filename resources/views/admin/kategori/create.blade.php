<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Tambah Kategori</h1>
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf
            <div>
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" required placeholder="Contoh: Obat Keras">
            </div>
            <div class="btn-group">
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>