{{-- resources/views/admin/data-user/index.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data User - Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
        }

        .navbar {
            background: rgb(2, 3, 129);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-left img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: white;
            object-fit: cover;
        }

        .navbar h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .menu {
            list-style: none;
        }

        .menu-item {
            margin: 5px 10px;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .menu-item a:hover,
        .menu-item a.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .menu-item a span {
            margin-right: 12px;
            font-size: 18px;
        }

        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        .top-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .top-bar h1 {
            color: #333;
            font-size: 28px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .btn-logout {
            padding: 8px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .card-header h2 {
            color: #333;
            font-size: 22px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-warning {
            background-color: #ffc107;
            color: #000;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #f8f9fa;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #dee2e6;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            color: #666;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .badge-primary {
            background-color: #cce5ff;
            color: #004085;
        }

        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .table-responsive {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }
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
    </div>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

        <div class="content-card">
            <div class="card-header">
                <h2>Daftar User</h2>
                <a href="{{ route('admin.data-user.create') }}" class="btn btn-primary">➕ Tambah User</a>
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @php
                                        $dataRoleUser = $user->roleuser->first(); 
                                        
                                        $roleName = ($dataRoleUser && $dataRoleUser->role) ? $dataRoleUser->role->nama_role : 'Tidak ada role';

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
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.data-user.edit', $user->iduser) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                        <a href="{{ route('admin.data-user.resetpassword', $user->iduser) }}" class="btn btn-primary btn-sm">🔑 Reset</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center; padding:30px;">Tidak ada data user</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>