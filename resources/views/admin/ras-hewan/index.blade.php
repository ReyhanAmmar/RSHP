<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Ras Hewan - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f6fa; }
        
        .navbar { background: rgb(2, 3, 129); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 24px; font-weight: bold; }
        
        .content-card { background: white; border-radius: 12px; padding: 30px; margin: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        
        /* Table Styles */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f8f9fa; padding: 15px; text-align: left; border-bottom: 2px solid #dee2e6; width: 20%; }
        td { padding: 15px; border-bottom: 1px solid #dee2e6; vertical-align: top; }
        
        /* List Ras dalam satu sel */
        .ras-list { display: flex; flex-wrap: wrap; gap: 10px; }
        .ras-item { 
            display: flex; align-items: center; gap: 8px; 
            background: #f1f3f5; padding: 6px 12px; border-radius: 20px; 
            border: 1px solid #e9ecef;
        }
        .ras-name { font-weight: 500; color: #333; font-size: 14px; }
        
        /* Tombol Kecil (Edit/Hapus Ras) */
        .btn-icon { 
            text-decoration: none; font-size: 12px; padding: 2px 6px; border-radius: 4px; transition: 0.2s; 
        }
        .btn-edit { background: #ffc107; color: #000; }
        .btn-delete { background: #dc3545; color: white; border: none; cursor: pointer; }
        .btn-edit:hover { background: #e0a800; }
        .btn-delete:hover { background: #c82333; }

        /* Tombol Besar (Tambah Ras) */
        .btn-add { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            color: white; text-decoration: none; padding: 8px 15px; 
            border-radius: 6px; font-size: 13px; display: inline-block;
        }
        .btn-add:hover { opacity: 0.9; }
        
        .btn-logout { background-color: #dc3545; padding: 8px 20px; border-radius: 6px; color: white; border: none; cursor: pointer; }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; background: #d4edda; color: #155724; }
    </style>
</head>
<body>

<nav class="navbar">
    <h1>Dashboard Admin</h1>
    <div>
        <a href="{{ route('admin.dashboard') }}" style="color: white; text-decoration: none; margin-right: 20px;">Home</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</nav>

<div class="content-card">
    <div class="card-header">
        <h2>Manajemen Ras Hewan</h2>
        <a href="{{ route('admin.ras-hewan.create') }}" class="btn-add" style="background: #6c757d;">+ Tambah Ras (Umum)</a>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th width="20%">Jenis Hewan</th>
                <th width="65%">Daftar Ras (Kelola)</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jenisHewan as $jenis)
                <tr>
                    <td>
                        <strong style="font-size: 16px;">{{ $jenis->nama_jenis_hewan }}</strong>
                    </td>
                    <td>
                        <div class="ras-list">
                            @forelse($jenis->rasHewan as $ras)
                                <div class="ras-item">
                                    <span class="ras-name">{{ $ras->nama_ras }}</span>
                                    
                                    <a href="{{ route('admin.ras-hewan.edit', $ras->idras_hewan) }}" class="btn-icon btn-edit" title="Edit">✏️</a>
                                    
                                    <form action="{{ route('admin.ras-hewan.destroy', $ras->idras_hewan) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus ras {{ $ras->nama_ras }}?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icon btn-delete" title="Hapus">🗑️</button>
                                    </form>
                                </div>
                            @empty
                                <span style="color: #999; font-style: italic; font-size: 13px;">Belum ada data ras.</span>
                            @endforelse
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.ras-hewan.create', ['idjenis' => $jenis->idjenis_hewan]) }}" class="btn-add">
                            ➕ Tambah Ras
                        </a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" style="text-align:center; padding: 30px;">Belum ada data jenis hewan. Silakan tambah jenis hewan terlebih dahulu.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>