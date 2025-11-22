<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Ras Hewan</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Tambah Ras Hewan</h1>

        <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
            @csrf
            
            <div>
                <label>Nama Ras</label>
                <input type="text" name="nama_ras" placeholder="Contoh: Persia, Golden Retriever" required>
            </div>

            <div>
                <label>Jenis Hewan</label>
                <select name="idjenis_hewan" required style="width: 100%; padding: 10px; margin-top: 5px;">
                    <option value="">-- Pilih Jenis Hewan --</option>
                    @foreach($jenisHewan as $jenis)
                        <option value="{{ $jenis->idjenis_hewan }}">{{ $jenis->nama_jenis_hewan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>