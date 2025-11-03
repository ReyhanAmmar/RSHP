<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pemilik</title>
</head>
<body>

    <nav class="navbar">
    <div class="navbar-left">
        <img src="/aset/logo-rshp.jpg" alt="Logo RSHP Unair">
        <h1>Dashboard Resepsionis</h1>
        </div>
    <div class="navbar-right">
        <div class="user-info">
        <div class="user-avatar">👤</div>
        <span>{{ Auth::user()->name ?? 'Resepsionis' }}</span>
        </div>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
    </nav>

    <h2>Form Registrasi Pemilik</h2>

    @if ($errors->any())
        <div>
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('resepsionis.registrasi-pemilik.store') }}" method="POST">
        @csrf

        <div>
            <label for="nama_pemilik">Nama Pemilik:</label><br>
            <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{ old('nama_pemilik') }}" required>
        </div>
        <br>

        <div>
            <label for="alamat">Alamat:</label><br>
            <textarea name="alamat" id="alamat" rows="3" required>{{ old('alamat') }}</textarea>
        </div>
        <br>

        <div>
            <label for="no_telp">Nomor Telepon:</label><br>
            <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}" required>
        </div>
        <br>

        <div>
            <label for="iduser">User:</label><br>
            <select name="iduser" id="iduser" required>
                <option value="">-- Pilih User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->iduser }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>
        <br>

        <button type="submit">Daftarkan Pemilik</button>
        <a href="{{ route('admin.resepsionis-dashboard') }}">Kembali</a>
    </form>

</body>
</html>
