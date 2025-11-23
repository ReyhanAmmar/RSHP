<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pemilik</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <style>
        body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: rgb(2, 3, 129); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .btn-logout { padding: 8px 20px; background-color: #dc3545; color: white; border: none; border-radius: 6px; cursor: pointer; }
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 30px; }
        .menu-card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); text-align: center; text-decoration: none; color: #333; transition: 0.3s; display: block; }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        .menu-icon { font-size: 40px; margin-bottom: 15px; }
    </style>
</head>
<body>
<nav class="navbar">
    <div style="display:flex; align-items:center; gap:10px;">
        <img src="/aset/logo-rshp.jpg" width="40" height="40" style="border-radius:50%; background:white;">
        <h3>Area Pemilik Hewan</h3>
    </div>
    <div style="display:flex; align-items:center; gap:15px;">
        <span>Halo, {{ Auth::user()->nama }}</span>
        <form action="{{ route('logout') }}" method="POST">@csrf <button class="btn-logout">Logout</button></form>
    </div>
</nav>

<div class="container">
    <div style="background:white; padding:30px; border-radius:12px; border-left:5px solid rgb(2,3,129); margin-bottom:30px;">
        <h2>Selamat Datang!</h2>
        <p>Pantau kesehatan hewan kesayangan Anda melalui menu di bawah ini.</p>
    </div>

    <div class="menu-grid">
        <a href="{{ route('pemilik.pets') }}" class="menu-card">
            <div class="menu-icon">🐈</div>
            <h3>Daftar Hewan</h3>
            <p>Lihat data hewan peliharaan Anda</p>
        </a>
        <a href="{{ route('pemilik.reservasi') }}" class="menu-card">
            <div class="menu-icon">📅</div>
            <h3>Riwayat Reservasi</h3>
            <p>Jadwal temu dokter</p>
        </a>
        <a href="{{ route('pemilik.rekam-medis') }}" class="menu-card">
            <div class="menu-icon">📋</div>
            <h3>Rekam Medis</h3>
            <p>Riwayat kesehatan & diagnosa</p>
        </a>
    </div>
</div>
</body>
</html>