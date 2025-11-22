<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dokter</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <style>
        body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: rgb(2, 3, 129); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .btn-logout { background: #dc3545; border: none; padding: 8px 20px; color: white; border-radius: 5px; cursor: pointer; }
        
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        
        .welcome-card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 30px; border-left: 5px solid #28a745; }
        .welcome-card h2 { margin-top: 0; color: #333; }
        
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .menu-card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); text-align: center; text-decoration: none; color: #333; transition: 0.3s; }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        .menu-icon { font-size: 40px; margin-bottom: 15px; }
    </style>
</head>
<body>

<nav class="navbar">
    <div style="display:flex; align-items:center; gap:10px;">
        <img src="/aset/logo-rshp.jpg" width="40" height="40" style="border-radius:50%; background:white;">
        <h3>Dashboard Dokter</h3>
    </div>
    <div style="display:flex; align-items:center; gap:15px;">
        <span>drh. {{ Auth::user()->nama }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</nav>

<div class="container">
    <div class="welcome-card">
        <h2>Selamat Bertugas, Dokter!</h2>
        <p>Pantau riwayat medis pasien dan detail tindakan.</p>
    </div>

    <div class="menu-grid">
        <a href="{{ route('dokter.rekam-medis.index') }}" class="menu-card">
            <div class="menu-icon">📋</div>
            <h3>Data Rekam Medis</h3>
            <p>Lihat Riwayat & Detail Pasien</p>
            <span style="font-size:13px; color:#666;">Total Pasien Anda: <strong>{{ $totalPasienSaya }}</strong></span>
        </a>

        <a href="#" class="menu-card" style="opacity: 0.7; cursor: default;">
            <div class="menu-icon">📅</div>
            <h3>Jadwal Praktek</h3>
            <p>(Segera Hadir)</p>
        </a>
    </div>
</div>

</body>
</html>