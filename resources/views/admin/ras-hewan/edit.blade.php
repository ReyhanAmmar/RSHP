<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Ras Hewan</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Ras Hewan</h1>

        <form action="{{ route('admin.ras-hewan.update', $rasHewan->idras_hewan) }}" method="POST">
            @csrf @method('PUT')
            
            <div>
                <label>Nama Ras</label>
                <input type="text" name="nama_ras" value="{{ old('nama_ras', $rasHewan->nama_ras) }}" required>
            </div>

            <div>
                <label>Jenis Hewan</label>
                <select name="idjenis_hewan" required style="width: 100%; padding: 10px; margin-top: 5px;">
                    <option value="">-- Pilih Jenis Hewan --</option>
                    @foreach($jenisHewan as $jenis)
                        <option value="{{ $jenis->idjenis_hewan }}" 
                            {{ $rasHewan->idjenis_hewan == $jenis->idjenis_hewan ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis_hewan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>
</html>