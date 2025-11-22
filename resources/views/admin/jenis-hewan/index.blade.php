<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Jenis Hewan - Admin</title>
    <style>
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
        
        .btn-warning { background-color: #ffc107; color: #000; padding: 5px 10px; font-size: 12px; }
        .btn-danger { background-color: #dc3545; color: white; padding: 5px 10px; font-size: 12px; }
        
        /* Table */
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        thead { background-color: #f8f9fa; }
        th { padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; color: #666; vertical-align: middle; }
        tbody tr:hover { background-color: #f8f9fa; }

        /* Alerts */
        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        .action-buttons { display: flex; gap: 8px; }

        /* Badge ID */
        .badge-id {
            background-color: #e9ecef; color: #495057; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 12px;
        }

        @media (max-width: 768px) {
            .content-card { margin: 15px; padding: 15px; }
            th, td { padding: 10px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
  <div class="navbar-left">
    <img src="/aset/logo-rshp.jpg" alt="Logo RSHP Unair">
    <h1>Dashboard Admin</h1>
  </div>
  <div class="navbar-right">
    <a href="{{ route('admin.dashboard') }}">Home</a>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

<div class="content-card">
    <div class="card-header">
        <h2>Jenis Hewan</h2>
        <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-primary">➕ Tambah Jenis</a>
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
                    <th width="10%">ID Jenis</th>
                    <th>Nama Jenis Hewan</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisHewan as $item)
                    <tr>
                        <td>
                            <span class="badge-id">{{ $item->idjenis_hewan }}</span>
                        </td>
                        <td>
                            <strong style="color: #333; font-size: 15px;">{{ $item->nama_jenis_hewan }}</strong>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.jenis-hewan.edit', $item->idjenis_hewan) }}" class="btn btn-warning">✏️ Edit</a>
                                
                                <form action="{{ route('admin.jenis-hewan.destroy', $item->idjenis_hewan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis {{ $item->nama_jenis_hewan }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center; padding:30px; color: #888;">Belum ada data jenis hewan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>