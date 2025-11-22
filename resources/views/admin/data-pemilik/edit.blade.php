<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pemilik - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Data Pemilik</h1>
        @if($errors->any()) <div style="color:red; margin-bottom:15px;"><ul>@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul></div> @endif

        <form action="{{ route('admin.data-pemilik.update', $pemilik->idpemilik) }}" method="POST">
            @csrf @method('PUT')
            
            <h3>Data Akun</h3>
            <div><label>Nama Lengkap</label><input type="text" name="nama" value="{{ $pemilik->user->nama }}" required></div>
            <div><label>Email</label><input type="email" name="email" value="{{ $pemilik->user->email }}" required></div>
            <div><label>Password Baru (Opsional)</label><input type="password" name="password"></div>

            <h3 style="margin-top:20px;">Data Kontak</h3>
            <div><label>No WhatsApp</label><input type="number" name="no_wa" value="{{ $pemilik->no_wa }}" required></div>
            <div><label>Alamat</label><textarea name="alamat" rows="3" style="width:100%; padding:10px; border:2px solid #e2e8f0; border-radius:10px;" required>{{ $pemilik->alamat }}</textarea></div>

            <div class="btn-group">
                <a href="{{ route('admin.data-pemilik.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>
</html>