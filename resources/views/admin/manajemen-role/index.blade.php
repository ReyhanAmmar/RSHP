{{-- resources/views/admin/manajemen-role/index.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Role User - Admin</title>
    <style>
        /* --- CSS DARI DATA USER --- */
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

        /* Button Styles */
        .btn {
            padding: 10px 20px; border: none; border-radius: 6px;
            cursor: pointer; text-decoration: none; display: inline-block;
            font-size: 14px; transition: all 0.3s;
        }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3); }
        
        .btn-warning { background-color: #ffc107; color: #000; padding: 6px 12px; font-size: 12px; border-radius: 4px;}
        .btn-warning:hover { background-color: #e0a800; }
        
        .btn-danger { background-color: #dc3545; color: white; padding: 6px 12px; font-size: 12px; border-radius: 4px;}
        .btn-danger:hover { background-color: #c82333; }
        
        /* Alerts */
        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* Table Styles */
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        thead { background-color: #f8f9fa; }
        th { padding: 15px; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #dee2e6; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; color: #666; vertical-align: top; } /* Vertical align top */
        tbody tr:hover { background-color: #f8f9fa; }

        /* Badges Role */
        .badge { display: inline-block; padding: 5px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; color: white; }
        .badge-danger { background-color: #dc3545; } /* Admin */
        .badge-success { background-color: #28a745; } /* Dokter */
        .badge-info { background-color: #17a2b8; }    /* Perawat */
        .badge-warning { background-color: #ffc107; color: black; } /* Resepsionis */
        .badge-primary { background-color: #007bff; } /* Pemilik */
        .badge-secondary { background-color: #6c757d; } /* Default */

        /* Status Styles */
        .status-active { color: #28a745; font-weight: bold; font-size: 12px; margin-left: 5px;}
        .status-inactive { color: #dc3545; font-weight: bold; font-size: 12px; margin-left: 5px;}

        /* Role List Item Style */
        .role-list-item {
            padding: 8px 0;
            border-bottom: 1px dashed #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .role-list-item:last-child { border-bottom: none; }
        
        .role-info { display: flex; align-items: center; gap: 10px; }
        .role-actions { display: flex; gap: 5px; }

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
    <a href="{{ route('dashboard.admin') }}">Home</a>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

<div class="content-card">
    <div class="card-header">
        <h2>Manajemen Role User</h2>
        <a href="{{ route('admin.manajemen-role.create') }}" class="btn btn-primary">➕ Tambah Role ke User</a>
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
                    <th width="5%">No</th>
                    <th width="25%">Nama User</th>
                    <th>Role</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong style="font-size: 15px; color: #333;">{{ $user->nama }}</strong><br>
                            <span style="color: #888; font-size: 13px;">{{ $user->email }}</span>
                        </td>
                        <td>
                            @foreach($user->roleuser as $ru)
                                <div class="role-list-item">
                                    <div class="role-info">
                                        @php
                                            $roleName = $ru->role->nama_role ?? '-';
                                            $badgeClass = match($roleName) {
                                                'Administrator' => 'badge-danger',
                                                'Dokter' => 'badge-success',
                                                'Perawat' => 'badge-info',
                                                'Resepsionis' => 'badge-warning',
                                                'Pemilik' => 'badge-primary',
                                                default => 'badge-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $roleName }}</span>
                                        
                                        @if($ru->status == 1)
                                            <span class="status-active">● Aktif</span>
                                        @else
                                            <span class="status-inactive">● Non-Aktif</span>
                                        @endif
                                    </div>

                                    <div class="role-actions">
                                        <a href="{{ route('admin.manajemen-role.edit', $ru->idrole_user) }}" class="btn btn-warning">Edit</a>
                                        
                                        <form action="{{ route('admin.manajemen-role.destroy', $ru->idrole_user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus role {{ $roleName }} dari user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center; padding:30px; color: #888;">Belum ada data role yang ditetapkan ke user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>