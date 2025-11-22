{{-- resources/views/perawat/rekam-medis/index.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Pemeriksaan - Perawat</title>
    <style>
        /* --- CSS STANDAR (Sama dengan Admin & Resepsionis) --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f6fa; }

        /* Navbar */
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

        /* Content Card */
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

        /* Table */
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        thead { background-color: #f8f9fa; }
        th { padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; color: #666; vertical-align: middle; }
        tbody tr:hover { background-color: #f8f9fa; }

        /* Styles Khusus */
        .no-urut { 
            font-size: 20px; font-weight: bold; color: rgb(2, 3, 129); 
            background: #eef2ff; padding: 5px 10px; border-radius: 50%;
            display: inline-block; width: 40px; height: 40px; text-align: center; line-height: 30px;
        }
        .pet-info strong { color: #2d3748; font-size: 15px; }
        .pet-info small { color: #718096; display: block; }

        /* Badge Status (Opsional) */
        .badge { padding: 5px 10px; border-radius: 12px; font-size: 12px; color: white; background: #ffc107; color: black;}

        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }

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
    <h1>Dashboard Perawat</h1>
  </div>
  <div class="navbar-right">
    <a href="{{ route('perawat.dashboard') }}">Home</a>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

<div class="content-card">
    <div class="card-header">
        <h2>📋 Antrian Pemeriksaan Pasien</h2>
        <a href="{{ route('perawat.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert">✓ {{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="text-align: center; width: 10%;">No Urut</th>
                    <th style="width: 25%;">Identitas Hewan</th>
                    <th style="width: 20%;">Pemilik</th>
                    <th style="width: 20%;">Dokter Tujuan</th>
                    <th style="width: 15%;">Status</th>
                    <th style="width: 10%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($antrian as $item)
                    <tr>
                        <td style="text-align: center;">
                            <span class="no-urut">{{ $item->no_urut }}</span>
                        </td>
                        
                        <td class="pet-info">
                            <strong>{{ $item->pet->nama ?? 'Hewan dihapus' }}</strong>
                            <small>
                                {{ $item->pet->jenisHewan->nama_jenis_hewan ?? '' }} - 
                                {{ $item->pet->rasHewan->nama_ras ?? '' }}
                            </small>
                        </td>

                        <td>
                            <strong style="color: #333;">{{ $item->pet->pemilik->user->nama ?? '-' }}</strong><br>
                            <small style="color: #888;">WA: {{ $item->pet->pemilik->no_wa ?? '-' }}</small>
                        </td>

                        <td>
                            drh. {{ $item->roleUser->user->nama ?? '-' }}
                        </td>

                        <td>
                            <span class="badge">Menunggu</span>
                        </td>

                        <td>
                            <a href="{{ route('perawat.rekam-medis.create', $item->idreservasi_dokter) }}" class="btn btn-primary">
                                ⚡ Proses
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:40px; color: #888;">
                            <div style="font-size: 40px; margin-bottom: 10px;">✅</div>
                            Tidak ada antrian pasien saat ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>