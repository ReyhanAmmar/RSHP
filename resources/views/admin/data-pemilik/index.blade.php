<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemilik - Admin</title>
    <style>
        /* Menggunakan CSS yang sama dengan Data User */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background-color: #f5f6fa; }

        .navbar { background: rgb(2, 3, 129); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 24px; font-weight: bold; }
        .navbar a { color: white; text-decoration: none; }
        .btn-logout { padding: 8px 20px; background: #dc3545; color: white; border: none; border-radius: 6px; cursor: pointer; }

        .content-card { background: white; border-radius: 12px; padding: 30px; margin: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .card-header h2 { color: #333; font-size: 22px; }

        .btn { padding: 8px 15px; border-radius: 6px; text-decoration: none; color: white; font-size: 13px; border: none; cursor: pointer; display: inline-block; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .btn-warning { background: #ffc107; color: black; }
        .btn-danger { background: #dc3545; }

        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #f8f9fa; padding: 15px; text-align: left; border-bottom: 2px solid #dee2e6; color: #333; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; color: #666; vertical-align: middle; }
        
        .badge-wa { background: #25D366; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; text-decoration: none; }
        .action-buttons { display: flex; gap: 8px; }
    </style>
</head>
<body>

<nav class="navbar">
    <div style="display:flex; align-items:center; gap:10px;">
        <img src="/aset/logo-rshp.jpg" width="45" height="45" style="border-radius:50%; background:white;">
        <h1>Dashboard Admin</h1>
    </div>
    <div>
        <a href="{{ route('admin.dashboard') }}" style="margin-right:20px;">Home</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</nav>

<div class="content-card">
    <div class="card-header">
        <h2>Data Pemilik Hewan</h2>
        <a href="{{ route('admin.data-pemilik.create') }}" class="btn btn-primary">➕ Tambah Pemilik</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>Email</th>
                    <th>Kontak (WA)</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pemilik as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $p->user->nama ?? 'User Terhapus' }}</strong>
                        </td>
                        <td>{{ $p->user->email ?? '-' }}</td>
                        <td>
                            <span style="font-size:14px;">{{ $p->no_wa }}</span>
                        </td>
                        <td>{{ $p->alamat }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.data-pemilik.edit', $p->idpemilik) }}" class="btn btn-warning">✏️ Edit</a>
                                <form action="{{ route('admin.data-pemilik.destroy', $p->idpemilik) }}" method="POST" onsubmit="return confirm('Yakin hapus data pemilik ini? Data User dan Hewan terkait juga akan terhapus.');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center; padding:30px;">Belum ada data pemilik.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>