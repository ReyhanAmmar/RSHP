<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Hewan Saya</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <style>
        body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; }
        .content-card { background: white; border-radius: 12px; padding: 30px; margin: 30px auto; max-width: 1000px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #f8f9fa; padding: 15px; text-align: left; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; }
        .btn-back { background: #6c757d; color: white; padding: 8px 15px; border-radius: 6px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="content-card">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h2>🐈 Hewan Peliharaan Saya</h2>
            <a href="{{ route('dashboard.pemilik') }}" class="btn-back">Kembali</a>
        </div>
        <table>
            <thead><tr><th>Nama</th><th>Jenis & Ras</th><th>Gender</th><th>Warna</th><th>Tgl Lahir</th></tr></thead>
            <tbody>
                @forelse($pets as $pet)
                <tr>
                    <td><strong>{{ $pet->nama }}</strong></td>
                    <td>{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }} - {{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                    <td>{{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</td>
                    <td>{{ $pet->warna_tanda }}</td>
                    <td>{{ $pet->tanggal_lahir ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center; padding:30px;">Belum ada hewan terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>