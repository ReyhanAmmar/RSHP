<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Role - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
</head>
<body>

<nav class="navbar">
  <div class="navbar-left">
    <img src="/aset/logo-rshp.jpg" alt="Logo RSHP Unair">
    <h1>Dashboard Admin</h1>
  </div>
  <div class="navbar-right">
    <a href="{{ route('admin.dashboard') }}">Home</a>
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

<div class="content-card">
    <div class="card-header">
        <h2>Daftar User & Role</h2>
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
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->roleuser->isNotEmpty())
                                @foreach ($user->roleuser as $roleUser)
                                    @php
                                        $roleName = $roleUser->role->nama_role ?? 'Tidak ada role';
                                        $badgeClass = match($roleName) {
                                            'Administrator' => 'badge-danger',
                                            'Dokter' => 'badge-success',
                                            'Perawat' => 'badge-info',
                                            'Resepsionis' => 'badge-warning',
                                            default => 'badge-primary',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $roleName }}</span>
                                @endforeach
                            @else
                                <span class="badge badge-danger">Belum ada role</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->roleuser->isNotEmpty() && $user->roleuser->first()->status == 1)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.manajemen-role.edit', $user->iduser) }}" class="btn btn-warning btn-sm">Kelola Role</a>
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

</body>
</html>
