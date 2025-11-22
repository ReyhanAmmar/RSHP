{{-- resources/views/resepsionis/temu-dokter/index.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Temu Dokter - Resepsionis</title>
    <style>
        /* --- CSS UTAMA (Disamakan dengan Data User Admin) --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f6fa; }

        /* Navbar Style */
        .navbar {
            background: rgb(2, 3, 129); color: white; padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .navbar-left { display: flex; align-items: center; gap: 10px; }
        .navbar-left img { width: 45px; height: 45px; border-radius: 50%; background: white; object-fit: cover; }
        .navbar h1 { font-size: 24px; font-weight: bold; }
        .navbar-right { display: flex; align-items: center; gap: 20px; }
        .navbar-right a { color: white; text-decoration: none; }
        
        .btn-logout {
            padding: 8px 20px; background-color: #dc3545; color: white;
            border: none; border-radius: 6px; cursor: pointer; font-size: 14px;
        }

        /* Content Card Style */
        .content-card {
            background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px; margin: 30px;
        }

        .card-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 25px; flex-wrap: wrap; gap: 15px;
        }
        .card-header h2 { color: #333; font-size: 22px; }

        /* Buttons */
        .btn {
            padding: 8px 15px; border: none; border-radius: 6px;
            cursor: pointer; text-decoration: none; display: inline-block;
            font-size: 13px; transition: all 0.3s;
        }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3); }
        
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn-secondary:hover { background-color: #5a6268; }

        .btn-action { padding: 6px 12px; border-radius: 4px; color: white; font-size: 12px; margin-right: 5px; }
        .btn-check { background-color: #28a745; } /* Hijau untuk Selesai */
        .btn-cancel { background-color: #dc3545; } /* Merah untuk Batal */

        /* Alerts */
        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* Table Style */
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        thead { background-color: #f8f9fa; }
        th { padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; color: #666; vertical-align: middle; }
        tbody tr:hover { background-color: #f8f9fa; }

        /* No Urut Besar */
        .no-urut { font-size: 20px; font-weight: bold; color: rgb(2, 3, 129); text-align: center; }

        /* Badges Status */
        .badge { padding: 5px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; color: white; display: inline-block; }
        .bg-warning { background-color: #ffc107; color: black; } /* Menunggu */
        .bg-success { background-color: #28a745; } /* Selesai */
        .bg-danger { background-color: #dc3545; } /* Batal */

        @media (max-width: 768px) {
            .content-card { margin: 15px; padding: 15px; }
            th, td { padding: 10px; }
            .navbar { flex-direction: column; gap: 15px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
  <div class="navbar-left">
    <img src="/aset/logo-rshp.jpg" alt="Logo RSHP Unair">
    <h1>Dashboard Resepsionis</h1>
  </div>
  <div class="navbar-right">
    <a href="{{ route('resepsionis.dashboard') }}">Home</a>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

<div class="content-card">
    <div class="card-header">
        <h2>Antrian Temu Dokter</h2>
        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-primary">➕ Daftar Pasien Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success"><span>✓</span> {{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error"><span>✗</span> {{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="text-align: center; width: 10%;">No Urut</th>
                    <th>Tanggal & Waktu</th>
                    <th>Nama Hewan</th>
                    <th>Dokter Tujuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($temuDokter as $item)
                    <tr>
                        <td class="no-urut">{{ $item->no_urut }}</td>
                        
                        <td>
                            {{ \Carbon\Carbon::parse($item->waktu_daftar)->format('d M Y') }}
                        </td>

                        <td>
                            <strong style="color: #333;">{{ $item->pet->nama ?? 'Hewan Terhapus' }}</strong><br>
                            <span style="font-size: 13px; color: #888;">
                                Pemilik: {{ $item->pet->pemilik->user->nama ?? 'Tanpa Pemilik' }}
                            </span>
                        </td>

                        <td>
                            drh. {{ $item->roleUser->user->nama ?? '-' }}
                        </td>

                        <td>
                            @if($item->status == '0')
                                <span class="badge bg-warning">Menunggu</span>
                            @elseif($item->status == '1')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-danger">Batal</span>
                            @endif
                        </td>

                        <td>
                            @if($item->status == '0')
                                <form action="{{ route('resepsionis.temu-dokter.update-status', $item->idreservasi_dokter) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah pasien ini sudah selesai diperiksa?');">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-action btn-check">✅ Selesai</button>
                                </form>

                                <form action="{{ route('resepsionis.temu-dokter.update-status', $item->idreservasi_dokter) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin membatalkan antrian ini?');">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class="btn btn-action btn-cancel">❌ Batal</button>
                                </form>
                            @else
                                <span style="color: #aaa; font-style: italic; font-size: 13px;">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:30px; color: #888;">Belum ada antrian pasien saat ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>