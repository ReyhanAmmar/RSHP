{{-- resources/views/resepsionis/registrasi-pemilik/index.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemilik - Resepsionis</title>
    <style>
        /* --- CSS GLOBAL (Konsisten dengan modul lain) --- */
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
            margin-bottom: 25px; flex-wrap: wrap; gap: 15px;
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

        .btn-warning { background-color: #ffc107; color: #000; padding: 6px 12px; font-size: 12px; }
        .btn-danger { background-color: #dc3545; color: white; padding: 6px 12px; font-size: 12px; }

        /* Table Styles */
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        thead { background-color: #f8f9fa; }
        th { padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; color: #555; vertical-align: middle; }
        tbody tr:hover { background-color: #fcfcfc; }

        /* Data Styling */
        .owner-name { font-weight: bold; font-size: 15px; color: #2d3748; }
        .owner-email { font-size: 13px; color: #718096; display: block; }
        .contact-info { font-size: 14px; color: #4a5568; }
        .address-text { font-size: 13px; color: #718096; max-width: 250px; line-height: 1.4; }

        .action-buttons { display: flex; gap: 8px; }

        /* Alerts */
        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        @media (max-width: 768px) {
            .content-card { margin: 15px; padding: 15px; }
            th, td { padding: 10px; }
            .navbar { flex-direction: column; gap: 15px; }
            .card-header { flex-direction: column; align-items: flex-start; }
            .card-header .btn-group { margin-top: 10px; }
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
        <h2>👥 Data Pemilik Hewan</h2>
        <div class="btn-group">
            <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary" style="margin-right: 10px;">Kembali</a>
            <a href="{{ route('resepsionis.registrasi-pemilik.create') }}" class="btn btn-primary">➕ Tambah Pemilik</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success"><span>✓</span> {{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama Pemilik</th>
                    <th width="20%">Kontak (WA)</th>
                    <th width="35%">Alamat</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pemilik as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="owner-name">{{ $p->user->nama ?? 'User Terhapus' }}</div>
                            <span class="owner-email">{{ $p->user->email ?? '-' }}</span>
                        </td>
                        <td>
                            <span class="contact-info">📞 {{ $p->no_wa }}</span>
                        </td>
                        <td>
                            <div class="address-text">{{Str::limit($p->alamat, 50) }}</div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('resepsionis.registrasi-pemilik.edit', $p->idpemilik) }}" class="btn btn-warning">✏️ Edit</a>
                                
                                <form action="{{ route('resepsionis.registrasi-pemilik.destroy', $p->idpemilik) }}" method="POST" onsubmit="return confirm('Yakin hapus pemilik ini? Data akun dan hewan terkait juga akan terhapus.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:40px; color: #888;">
                            <div style="font-size: 40px; margin-bottom: 10px;">📭</div>
                            Belum ada data pemilik yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>