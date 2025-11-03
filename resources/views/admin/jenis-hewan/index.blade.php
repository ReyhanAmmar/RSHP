<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jenis Hewan - Admin</title>
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
        <h2>Daftar Jenis Hewan</h2>
        <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-primary">➕ Tambah Jenis Hewan</a>
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
                    <th>ID Jenis Hewan</th>
                    <th>Nama Jenis Hewan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisHewan as $jh)
                    <tr>
                        <td class="text-center">{{ $jh->idjenis_hewan }}</td>
                        <td>{{ $jh->nama_jenis_hewan }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.jenis-hewan.edit', $jh->idjenis_hewan) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <form action="{{ route('admin.jenis-hewan.destroy', $jh->idjenis_hewan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jenis hewan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center; padding:30px;">Belum ada data jenis hewan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
