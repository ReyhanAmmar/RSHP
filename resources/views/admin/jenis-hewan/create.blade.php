<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jenis Hewan - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Tambah Jenis Hewan</h1>

        @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
            @csrf
            
            <div>
                <label>Nama Jenis Hewan</label>
                <input type="text" name="nama_jenis_hewan" value="{{ old('nama_jenis_hewan') }}" placeholder="Contoh: Kucing, Anjing, Reptil" required>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>