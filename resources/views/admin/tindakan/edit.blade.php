<!DOCTYPE html>
<html lang="id">
<head><title>Edit Tindakan</title><link rel="stylesheet" href="{{ asset('css/form.css') }}"></head>
<body>
    <div class="container">
        <h1>Edit Tindakan</h1>
        <form action="{{ route('admin.tindakan.update', $tindakan->idkode_tindakan_terapi) }}" method="POST">
            @csrf @method('PUT')
            
            <div style="display:flex; gap:15px;">
                <div style="flex:1;">
                    <label>Kode Tindakan</label>
                    <input type="text" name="kode" value="{{ $tindakan->kode }}" required>
                </div>
                <div style="flex:3;">
                    <label>Deskripsi</label>
                    <input type="text" name="deskripsi_tindakan_terapi" value="{{ $tindakan->deskripsi_tindakan_terapi }}" required>
                </div>
            </div>

            <div>
                <label>Kategori</label>
                <select name="idkategori" required>
                    @foreach($kategori as $k)
                        <option value="{{ $k->idkategori }}" {{ $tindakan->idkategori == $k->idkategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Kategori Klinis</label>
                <select name="idkategori_klinis" required>
                    @foreach($klinis as $k)
                        <option value="{{ $k->idkategori_klinis }}" {{ $tindakan->idkategori_klinis == $k->idkategori_klinis ? 'selected' : '' }}>
                            {{ $k->nama_kategori_klinis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.tindakan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>
</html>