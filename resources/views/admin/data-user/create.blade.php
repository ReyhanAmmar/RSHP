<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Tambah User Baru</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.data-user.store') }}" method="POST">
            @csrf
            <div>
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div>
                <label>Role</label>
                <select name="role_id" required style="width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                    @endforeach
                </select>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.data-user.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>