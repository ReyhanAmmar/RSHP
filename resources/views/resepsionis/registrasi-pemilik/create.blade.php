<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pemilik Baru</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <style>
        .section-title {
            font-size: 18px; font-weight: bold; color: #333;
            border-bottom: 2px solid #eee; padding-bottom: 5px; margin-bottom: 15px; margin-top: 20px;
        }
        .btn-primary { background-color: #007bff; border-color: #007bff; color: white; }
        .btn-secondary { background-color: #6c757d; border-color: #6c757d; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrasi Pemilik</h1>

        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('resepsionis.registrasi-pemilik.store') }}" method="POST">
            @csrf
            
            <div class="section-title">1. Data Akun (Login)</div>
            
            <div>
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Sesuai KTP" required>
            </div>

            <div style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                </div>
                <div style="flex: 1;">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" required>
                </div>
            </div>

            <div class="section-title">2. Data Kontak</div>
            
            <div>
                <label>Nomor WhatsApp</label>
                <input type="number" name="no_wa" value="{{ old('no_wa') }}" placeholder="08xxxxxxxxxx" required>
            </div>

            <div>
                <label>Alamat Domisili</label>
                <textarea name="alamat" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" placeholder="Alamat lengkap..." required>{{ old('alamat') }}</textarea>
            </div>

            <div class="btn-group" style="margin-top: 30px;">
                <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
                <button type="submit" class="btn btn-primary">Simpan Data Pemilik</button>
            </div>
        </form>
    </div>
</body>
</html>