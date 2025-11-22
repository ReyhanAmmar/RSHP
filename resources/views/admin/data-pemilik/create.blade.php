<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pemilik - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Tambah Pemilik Baru</h1>
        @if($errors->any()) <div style="color:red; margin-bottom:15px;"><ul>@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul></div> @endif

        <form action="{{ route('admin.data-pemilik.store') }}" method="POST">
            @csrf
            
            <h3>Data Akun</h3>
            <div><label>Nama Lengkap</label><input type="text" name="nama" required></div>
            <div><label>Email</label><input type="email" name="email" required></div>
            <div><label>Password</label><input type="password" name="password" required></div>

            <h3 style="margin-top:20px;">Data Kontak</h3>
            <div><label>No WhatsApp</label><input type="number" name="no_wa" required></div>
            <div><label>Alamat</label><textarea name="alamat" rows="3" style="width:100%; padding:10px; border:2px solid #e2e8f0; border-radius:10px;" required></textarea></div>

            <div class="btn-group">
                <a href="{{ route('admin.data-pemilik.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>