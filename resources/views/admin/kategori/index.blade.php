<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori - Admin</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f5f6fa; margin: 0; }
        .navbar { background: rgb(2, 3, 129); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .btn-logout { padding: 8px 20px; background: #dc3545; color: white; border: none; border-radius: 6px; cursor: pointer; }
        .content-card { background: white; border-radius: 12px; padding: 30px; margin: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #f8f9fa; padding: 15px; text-align: left; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; }
        .btn { padding: 8px 15px; border-radius: 6px; text-decoration: none; color: white; font-size: 13px; border: none; cursor: pointer; display: inline-block; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .btn-warning { background: #ffc107; color: black; }
        .btn-danger { background: #dc3545; }
        .action-buttons { display: flex; gap: 8px; }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h3>Dashboard Admin</h3>
        <div style="display:flex; gap:15px; align-items:center;">
            <span>{{ Auth::user()->nama ?? 'Admin' }}</span>
            <form action="{{ route('logout') }}" method="POST">@csrf <button class="btn-logout">Logout</button></form>
        </div>
    </nav>

    <div class="content-card">
        <div class="card-header">
            <h2>Data Kategori</h2>
            <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">➕ Tambah Kategori</a>
        </div>

        @if(session('success')) <div class="alert">{{ session('success') }}</div> @endif

        <table>
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th>Nama Kategori</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $d)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $d->nama_kategori }}</strong></td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.kategori.edit', $d->idkategori) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.kategori.destroy', $d->idkategori) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center; padding:20px;">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>