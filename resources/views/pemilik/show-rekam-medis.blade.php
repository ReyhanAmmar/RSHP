<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Rekam Medis</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <style>
        body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; }
        .container { max-width: 800px; margin: 40px auto; }
        .info-box { background: white; padding: 25px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .label { font-weight: bold; color: #555; display: block; margin-bottom: 5px; }
        .value { margin-bottom: 15px; color: #333; }
        ul { padding-left: 20px; }
        .btn-back { background: #6c757d; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="info-box">
            <h2 style="border-bottom:1px solid #eee; padding-bottom:10px; margin-bottom:20px;">Detail Pemeriksaan</h2>
            
            <span class="label">Nama Hewan:</span>
            <div class="value">{{ $rm->pet->nama }}</div>

            <span class="label">Tanggal Periksa:</span>
            <div class="value">{{ $rm->created_at->format('d F Y H:i') }} WIB</div>

            <span class="label">Dokter:</span>
            <div class="value">drh. {{ $rm->temuDokter->roleUser->user->nama ?? '-' }}</div>

            <hr style="border:0; border-top:1px dashed #ddd; margin:20px 0;">

            <span class="label">Keluhan (Anamnesa):</span>
            <div class="value">{{ $rm->anamnesa }}</div>

            <span class="label">Hasil Diagnosa:</span>
            <div class="value" style="font-weight:bold; color:#2c3e50;">{{ $rm->diagnosa }}</div>

            <span class="label">Tindakan / Terapi:</span>
            <ul>
                @foreach($rm->detailRekamMedis as $detail)
                    <li>{{ $detail->kodeTindakan->deskripsi_tindakan_terapi }} 
                        @if($detail->detail) <span style="color:#777;">({{ $detail->detail }})</span> @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <a href="{{ route('pemilik.rekam-medis') }}" class="btn-back">Kembali</a>
    </div>
</body>
</html>