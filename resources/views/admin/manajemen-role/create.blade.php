<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Role ke User - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Tambah Role ke User</h1>

        @if(session('error'))
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.manajemen-role.store') }}" method="POST">
            @csrf
            
            <div>
                <label>Pilih User</label>
                <select name="iduser" required style="width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->iduser }}">{{ $user->nama }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Pilih Role (Jabatan)</label>
                <select name="idrole" required style="width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                    @endforeach
                </select>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.manajemen-role.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>