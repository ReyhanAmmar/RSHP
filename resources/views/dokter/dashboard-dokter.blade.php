<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Dokter</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', sans-serif; background: #f5f6fa; }

    .navbar {
      background: rgb(2, 3, 129); color: white; padding: 15px 30px;
      display: flex; justify-content: space-between; align-items: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .navbar h1 { font-size: 22px; font-weight: bold; }
    
    .btn-logout {
      padding: 8px 20px; background-color: #dc3545; color: white;
      border: none; border-radius: 6px; cursor: pointer; font-size: 14px;
    }

    .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }

    .welcome-card {
      background: white; padding: 30px; border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 30px;
      border-left: 5px solid #28a745; /* Warna Hijau untuk Dokter */
    }
    .welcome-card h2 { color: rgb(2, 3, 129); margin-bottom: 10px; }
    .welcome-card p { color: #666; }

    .menu-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;
    }

    .menu-card {
      background: white; padding: 30px; border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05); text-align: center;
      text-decoration: none; color: #333; transition: 0.3s;
      display: flex; flex-direction: column; align-items: center; justify-content: center;
      height: 200px;
    }
    .menu-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }

    .menu-icon { font-size: 40px; margin-bottom: 15px; }
    .menu-card h3 { color: rgb(2, 3, 129); font-size: 18px; margin-bottom: 5px; }
    
    .stat-badge {
        background: #28a745; color: white; padding: 4px 10px; 
        border-radius: 15px; font-size: 12px; margin-top: 10px;
    }
  </style>
</head>
<body>

<nav class="navbar">
  <div style="display:flex; align-items:center; gap:10px;">
    <img src="/aset/logo-rshp.jpg" width="40" height="40" style="border-radius:50%; background:white;">
    <h1>Dashboard Dokter</h1>
  </div>
  <div style="display:flex; align-items:center; gap:15px;">
    <span>drh. {{ Auth::user()->nama ?? 'Dokter' }}</span>
    <form action="{{ route('logout') }}" method="POST">@csrf <button class="btn-logout">Logout</button></form>
  </div>
</nav>

<div class="container">
    <div class="welcome-card">
      <h2>Selamat Datang, drh. {{ Auth::user()->nama ?? 'Dokter' }}!</h2>
      <p>Silakan akses data pasien dan rekam medis di bawah ini.</p>
    </div>

    <div class="menu-grid">
        <a href="{{ route('dokter.rekam-medis.index') }}" class="menu-card">
            <div class="menu-icon">📋</div>
            <h3>Data Pasien</h3>
            <p style="font-size:13px; color:#666;">Lihat Riwayat & Detail Medis</p>
            <span class="stat-badge">{{ $totalPasienSaya }} Pasien Ditangani</span>
        </a>

        <a href="#" class="menu-card" style="opacity:0.6; cursor:default;">
            <div class="menu-icon">📅</div>
            <h3>Jadwal Praktek</h3>
            <p style="font-size:13px; color:#666;">(Fitur Segera Hadir)</p>
        </a>
    </div>
</div>

</body>
</html>