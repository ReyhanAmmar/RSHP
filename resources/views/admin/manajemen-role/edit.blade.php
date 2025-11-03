{{-- resources/views/admin/manajemen-role/edit.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role User</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
            margin: 0; padding: 0;
        }

        .navbar {
            background: rgb(2, 3, 129);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        .navbar-right a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }

        .navbar-right a:hover {
            text-decoration: underline;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
            max-width: 700px;
            margin: 40px auto;
        }

        h1 {
            font-size: 26px;
            color: #333;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .role-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 25px;
        }

        .role-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        input[type="checkbox"] {
            width: 18px; height: 18px;
            accent-color: rgb(2, 3, 129);
        }

        .btn {
            padding: 10px 20px;
            border: none; border-radius: 6px;
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

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<nav class="navbar">
  <div class="navbar-left">
    <img src="/aset/logo-rshp.jpg" alt="Logo RSHP Unair">
    <h2>Manajemen Role</h2>
  </div>
  <div class="navbar-right">
    <a href="{{ route('admin.manajemen-role.index') }}">⬅ Kembali</a>
  </div>
</nav>

<div class="content-card">
    <h1>Atur Role untuk: <strong>{{ $user->name }}</strong></h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.manajemen-role.update', $user->iduser) }}" method="POST">
        @csrf

        <label>Pilih Role:</label>
        <div class="role-list">
            @foreach($roles as $role)
                <div class="role-item">
                    <input 
                        type="checkbox" 
                        id="role_{{ $role->idrole }}" 
                        name="roles[]" 
                        value="{{ $role->idrole }}"
                        {{ $user->roleuser->pluck('idrole')->contains($role->idrole) ? 'checked' : '' }}>
                    <label for="role_{{ $role->idrole }}">{{ $role->nama_role }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
        <a href="{{ route('admin.manajemen-role.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>
