<!DOCTYPE html>
<html lang="id">
<head><title>Detail Pasien</title><link rel="stylesheet" href="{{ asset('css/form.css') }}"></head>
<body>
    <div class="container">
        <h1>Detail Rekam Medis</h1>
        <div style="background:#f9f9f9; padding:20px; border-radius:8px;">
            <p><strong>Hewan:</strong> {{ $rm->pet->nama }}</p>
            <p><strong>Anamnesa:</strong> {{ $rm->anamnesa }}</p>
            <p><strong>Diagnosa:</strong> {{ $rm->diagnosa }}</p>
            <h3>Tindakan:</h3>
            <ul>
                @foreach($rm->detailRekamMedis as $detail)
                    <li>{{ $detail->kodeTindakan->deskripsi_tindakan_terapi }} ({{ $detail->detail }})</li>
                @endforeach
            </ul>
        </div>
        <br><a href="{{ route('dokter.rekam-medis.index') }}" style="text-decoration:none; color:gray;">Kembali</a>
    </div>
</body>
</html>