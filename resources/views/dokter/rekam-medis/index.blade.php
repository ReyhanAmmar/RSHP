<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pasien - Dokter</title>
    <style>
        /* --- CSS GLOBAL (Konsisten dengan Perawat & Admin) --- */
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
        .navbar-right a { color: white; text-decoration: none; transition: 0.3s; }
        .navbar-right a:hover { color: #ddd; }
        
        .btn-logout {
            padding: 8px 20px; background-color: #dc3545; color: white;
            border: none; border-radius: 6px; cursor: pointer; font-size: 14px; transition: 0.3s;
        }
        .btn-logout:hover { background-color: #c82333; }

        /* Content Card */
        .content-card {
            background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px; margin: 30px; /* Jarak dari tepi */
        }

        .card-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #f0f0f0;
        }
        .card-header h2 { color: #333; font-size: 22px; margin: 0; }

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

        /* Table Styles */
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        thead { background-color: #f8f9fa; }
        th { padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; color: #555; vertical-align: middle; }
        tbody tr:hover { background-color: #fcfcfc; }

        /* Data Styling */
        .pet-name { font-weight: bold; font-size: 15px; color: #2d3748; }
        .pet-detail { font-size: 12px; color: #718096; display: block; margin-top: 2px; }
        .date-text { font-weight: 600; color: #4a5568; }
        .date-sub { font-size: 12px; color: #a0aec0; }

        .diagnosa-box {
            background: #f0fff4; border: 1px solid #bbf7d0; color: #166534;
            padding: 5px 10px; border-radius: 6px; font-size: 13px; display: inline-block;
            max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }

        @media (max-width: 768px) {
            .content-card { margin: 15px; padding: 15px; }
            th, td { padding: 10px; }
            .navbar { flex-direction: column; gap: 15px; }
            .card-header { flex-direction: column; align-items: flex-start; gap: 10px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
  <div class="navbar-left">
    <img src="/aset/logo-rshp.jpg" alt="Logo RSHP Unair">
    <h1>Dashboard Dokter</h1>
  </div>
  <div class="navbar-right">
    <a href="{{ route('dokter.dashboard') }}">Home</a>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

<div class="content-card">
    <div class="card-header">
        <h2>📋 Riwayat Rekam Medis Pasien</h2>
        <a href="{{ route('dokter.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th width="5%" style="text-align:center;">No</th>
                    <th width="15%">Tanggal Periksa</th>
                    <th width="20%">Identitas Hewan</th>
                    <th width="20%">Pemilik</th>
                    <th width="25%">Diagnosa</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekamMedis as $index => $rm)
                    <tr>
                        <td style="text-align:center;">{{ $index + 1 }}</td>
                        
                        <td>
                            <div class="date-text">{{ $rm->created_at->format('d M Y') }}</div>
                            <div class="date-sub">{{ $rm->created_at->format('H:i') }} WIB</div>
                        </td>
                        
                        <td>
                            <div class="pet-name">{{ $rm->pet->nama ?? 'Hewan Dihapus' }}</div>
                            <span class="pet-detail">
                                {{ $rm->pet->jenisHewan->nama_jenis_hewan ?? '' }} - 
                                {{ $rm->pet->rasHewan->nama_ras ?? '' }}
                            </span>
                        </td>

                        <td>
                            <strong>{{ $rm->pet->pemilik->user->nama ?? 'Tanpa Pemilik' }}</strong>
                        </td>

                        <td>
                            <span class="diagnosa-box">
                                {{ Str::limit($rm->diagnosa, 40, '...') }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-primary">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:50px; color: #9ca3af;">
                            <div style="font-size: 40px; margin-bottom: 10px;">📭</div>
                            Belum ada riwayat rekam medis.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>