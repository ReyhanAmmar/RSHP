<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Hewan Peliharaan</title>
</head>
<body>

    <h1>Form Registrasi Hewan Peliharaan</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('resepsionis.registrasi-pet.store') }}" method="POST">
        @csrf

        <div>
            <label for="nama_hewan">Nama Hewan:</label><br>
            <input type="text" name="nama_hewan" id="nama_hewan" value="{{ old('nama_hewan') }}" required>
        </div>

        <div>
            <label for="idjenis_hewan">Jenis Hewan:</label><br>
            <select name="idjenis_hewan" id="idjenis_hewan" required>
                <option value="">-- Pilih Jenis Hewan --</option>
                @foreach($jenisHewan as $jenis)
                    <option value="{{ $jenis->idjenis_hewan }}">{{ $jenis->nama_jenis_hewan }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="ras">Ras Hewan:</label><br>
            <input type="text" name="ras" id="ras" value="{{ old('ras') }}">
        </div>

        <div>
            <label for="umur">Umur (dalam tahun):</label><br>
            <input type="number" name="umur" id="umur" value="{{ old('umur') }}" min="0">
        </div>

        <div>
            <label for="idpemilik">Pemilik Hewan:</label><br>
            <select name="idpemilik" id="idpemilik" required>
                <option value="">-- Pilih Pemilik --</option>
                @foreach($pemilik as $p)
                    <option value="{{ $p->idpemilik }}">{{ $p->nama_pemilik }}</option>
                @endforeach
            </select>
        </div>

        <br>
        <button type="submit">Simpan</button>
        <a href="{{ route('admin.resepsionis-dashboard') }}">Kembali</a>
    </form>

</body>
</html>
