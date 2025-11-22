<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Hewan - Admin</title>
    <style>
        /* --- CSS GLOBAL ADMIN (Konsisten dengan Data User) --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f6fa; }

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

        .content-card {
            background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px; margin: 30px; /* Jarak dari tepi */
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
        
        /* Alerts */
        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* Table Styles */
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        thead { background-color: #f8f9fa; }
        th { padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; color: #666; vertical-align: middle; }
        tbody tr:hover { background-color: #f8f9fa; }

        /* Badges untuk Gender */
        .badge { display: inline-block; padding: 5px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; color: white; }
        .badge-male { background-color: #007bff; }
        .badge-female { background-color: #e83e8c; }

        .action-buttons { display: flex; gap: 8px; }

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
        <h2>Data Hewan (Pet)</h2>
        <a href="{{ route('admin.data-pet.create') }}" class="btn btn-primary">➕ Tambah Hewan</a>
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
                    <th>No</th>
                    <th>Nama Hewan</th>
                    <th>Jenis & Ras</th>
                    <th>Pemilik</th>
                    <th>Gender</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pets as $index => $pet)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong style="color: #333; font-size: 15px;">{{ $pet->nama }}</strong><br>
                            <small style="color: #888;">Warna: {{ $pet->warna_tanda }}</small>
                        </td>
                        <td>
                            <span style="font-weight: bold; color: #555;">{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</span><br>
                            <small style="color: #777;">{{ $pet->rasHewan->nama_ras ?? '-' }}</small>
                        </td>
                        <td>
                            <strong style="color: #333;">{{ $pet->pemilik->user->nama ?? 'Tanpa Pemilik' }}</strong><br>
                            <small style="color: #888;">{{ $pet->pemilik->no_wa ?? '-' }}</small>
                        </td>
                        <td>
                            @if($pet->jenis_kelamin == 'J')
                                <span class="badge badge-male">Jantan</span>
                            @else
                                <span class="badge badge-female">Betina</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.data-pet.edit', $pet->idpet) }}" class="btn btn-warning">✏️ Edit</a>
                                
                                <form action="{{ route('admin.data-pet.destroy', $pet->idpet) }}" method="POST" onsubmit="return confirm('Yakin hapus data hewan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:30px; color: #888;">Belum ada data hewan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>