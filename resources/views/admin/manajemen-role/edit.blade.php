<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status Role - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Status Role User</h1>

        <form action="{{ route('admin.manajemen-role.update', $roleUser->idrole_user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div>
                <label>Nama User</label>
                <input type="text" value="{{ $roleUser->user->nama ?? '-' }}" disabled style="background-color: #e9ecef; color: #555; cursor: not-allowed;">
            </div>

            <div>
                <label>Role</label>
                <input type="text" value="{{ $roleUser->role->nama_role ?? '-' }}" disabled style="background-color: #e9ecef; color: #555; cursor: not-allowed;">
            </div>

            <div>
                <label>Status Akun</label>
                <select name="status" required style="width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="1" {{ $roleUser->status == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $roleUser->status == 0 ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.manajemen-role.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update Status</button>
            </div>
        </form>
    </div>
</body>
</html>