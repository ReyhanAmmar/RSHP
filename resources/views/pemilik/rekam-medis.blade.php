<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekam Medis</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <style>
        body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; }
        .content-card { background: white; border-radius: 12px; padding: 30px; margin: 30px auto; max-width: 1000px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #f8f9fa; padding: 15px; text-align: left; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; }
        .btn-detail { background: #007bff; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 13px; }
        .btn-back { background: #6c757d; color: white; padding: 8px 15px; border-radius: 6px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="content-card">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h2>📋 Riwayat Kesehatan (Rekam Medis)</h2>
            <a href="{{ route('dashboard.pemilik') }}" class="btn-back">Kembali</a>
        </div>
        <table>
            <thead><tr><th>Tanggal</th><th>Nama Hewan</th><th>Diagnosa</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($rekamMedis as $rm)
                <tr>
                    <td>{{ $rm->created_at->format('d M Y') }}</td>
                    <td>{{ $rm->pet->nama }}</td>
                    <td>{{ Str::limit($rm->diagnosa, 50) }}</td>
                    <td><a href="{{ route('pemilik.rekam-medis.show', $rm->idrekam_medis) }}" class="btn-detail">Lihat Detail</a></td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; padding:30px;">Belum ada data rekam medis.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>