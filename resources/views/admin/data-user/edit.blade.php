<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Data User</h1>

        @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.data-user.update', $user->iduser) }}" method="POST">
            @csrf
            @method('PUT')

            @php
                $currentRoleUser = $user->roleuser->first(); 
            @endphp

            <div>
                <label>Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->nama) }}" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div>
                <label>Role</label>
                <select name="role_id" required style="width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->idrole }}" 
                            {{ ($currentRoleUser && $currentRoleUser->idrole == $role->idrole) ? 'selected' : '' }}>
                            {{ $role->nama_role }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Status Akun</label>
                <select name="status" style="width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">
                    @php
                        $status = $currentRoleUser ? $currentRoleUser->status : 1;
                    @endphp
                    <option value="1" {{ $status == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $status == 0 ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.data-user.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>
</html>