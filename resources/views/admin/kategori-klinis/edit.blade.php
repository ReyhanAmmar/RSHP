<!DOCTYPE html>
<html lang="id">
<head><title>Edit Kategori Klinis</title><link rel="stylesheet" href="{{ asset('css/form.css') }}"></head>
<body>
    <div class="container">
        <h1>Edit Kategori Klinis</h1>
        <form action="{{ route('admin.kategori-klinis.update', $kategori->idkategori_klinis) }}" method="POST">
            @csrf @method('PUT')
            <div>
                <label>Nama Kategori Klinis</label>
                <input type="text" name="nama_kategori_klinis" value="{{ $kategori->nama_kategori_klinis }}" required>
            </div>
            <div class="btn-group">
                <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>
</html>