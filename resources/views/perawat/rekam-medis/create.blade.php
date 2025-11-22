<!DOCTYPE html>
<html lang="id">
<head>
    <title>Input Rekam Medis</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Input Rekam Medis</h1>
        
        <div style="background:#eef2ff; padding:15px; border-radius:8px; margin-bottom:20px; border:1px solid #c7d2fe;">
            <h3 style="margin-top:0; color:rgb(2, 3, 129);">Data Pasien</h3>
            <p><strong>Nama Hewan:</strong> {{ $reservasi->pet->nama }}</p>
            <p><strong>Pemilik:</strong> {{ $reservasi->pet->pemilik->user->nama ?? '-' }}</p>
        </div>

        <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
            @csrf
            <input type="hidden" name="idreservasi_dokter" value="{{ $reservasi->idreservasi_dokter }}">
            <input type="hidden" name="idpet" value="{{ $reservasi->idpet }}">
            <input type="hidden" name="dokter_pemeriksa" value="{{ $reservasi->idrole_user }}">

            <div><label>Anamnesa (Keluhan)</label><textarea name="anamnesa" rows="3" required placeholder="Contoh: Muntah, Diare sejak 2 hari lalu"></textarea></div>
            <div><label>Temuan Klinis</label><textarea name="temuan_klinis" rows="3" placeholder="Contoh: Suhu 39.5 C, Dehidrasi ringan"></textarea></div>
            <div><label>Diagnosa Sementara</label><textarea name="diagnosa" rows="3" required placeholder="Contoh: Suspect Panleukopenia"></textarea></div>

            <button type="submit" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 10px; border:none; border-radius:6px; width:100%; margin-top:10px; cursor:pointer;">Simpan & Lanjut ke Tindakan</button>
        </form>
    </div>
</body>
</html>