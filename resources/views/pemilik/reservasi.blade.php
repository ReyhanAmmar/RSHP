<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Reservasi</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <style>
        body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; }
        .content-card { background: white; border-radius: 12px; padding: 30px; margin: 30px auto; max-width: 1000px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #f8f9fa; padding: 15px; text-align: left; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; }
        .btn-back { background: #6c757d; color: white; padding: 8px 15px; border-radius: 6px; text-decoration: none; }
        .badge { padding:5px 10px; border-radius:10px; color:white; font-size:12px; }
    </style>
</head>
<body>
    <div class="content-card">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h2>📅 Riwayat Reservasi Temu Dokter</h2>
            <a href="{{ route('pemilik.dashboard') }}" class="btn-back">Kembali</a>
        </div>
        <table>
            <thead><tr><th>Tanggal</th><th>No Urut</th><th>Hewan</th><th>Dokter</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($reservasi as $res)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($res->waktu_daftar)->format('d M Y') }}</td>
                    <td style="font-weight:bold; text-align:center;">{{ $res->no_urut }}</td>
                    <td>{{ $res->pet->nama }}</td>
                    <td>drh. {{ $res->roleUser->user->nama ?? '-' }}</td>
                    <td>
                        @if($res->status == '0') <span class="badge" style="background:#ffc107; color:black;">Menunggu</span>
                        @elseif($res->status == '1') <span class="badge" style="background:#28a745;">Selesai</span>
                        @else <span class="badge" style="background:#dc3545;">Batal</span> @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center; padding:30px;">Belum ada riwayat reservasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>