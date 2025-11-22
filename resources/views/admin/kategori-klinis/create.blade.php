<!DOCTYPE html>
<html lang="id">
<head><title>Tambah Kategori Klinis</title><link rel="stylesheet" href="{{ asset('css/form.css') }}"></head>
<body>
    <div class="container">
        <h1>Tambah Kategori Klinis</h1>
        <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
            @csrf
            <div>
                <label>Nama Kategori Klinis</label>
                <input type="text" name="nama_kategori_klinis" required placeholder="Contoh: Bedah Minor">
            </div>
            <div class="btn-group">
                <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>