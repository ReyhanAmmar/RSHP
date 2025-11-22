<!DOCTYPE html>
<html lang="id">
<head><title>Tambah Tindakan</title><link rel="stylesheet" href="{{ asset('css/form.css') }}"></head>
<body>
    <div class="container">
        <h1>Tambah Tindakan</h1>
        <form action="{{ route('admin.tindakan.store') }}" method="POST">
            @csrf
            
            <div style="display:flex; gap:15px;">
                <div style="flex:1;">
                    <label>Kode Tindakan</label>
                    <input type="text" name="kode" required placeholder="Contoh: T01">
                </div>
                <div style="flex:3;">
                    <label>Deskripsi</label>
                    <input type="text" name="deskripsi_tindakan_terapi" required placeholder="Contoh: Suntik Vitamin">
                </div>
            </div>

            <div>
                <label>Kategori</label>
                <select name="idkategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k) <option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option> @endforeach
                </select>
            </div>

            <div>
                <label>Kategori Klinis</label>
                <select name="idkategori_klinis" required>
                    <option value="">-- Pilih Klinis --</option>
                    @foreach($klinis as $k) <option value="{{ $k->idkategori_klinis }}">{{ $k->nama_kategori_klinis }}</option> @endforeach
                </select>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.tindakan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>