<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Perawat - RSHP Unair</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f6fa;
    }

    /* Navbar */
    .navbar {
      background: rgb(2, 3, 129);
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
      object-fit: cover;
    }

    .navbar h1 {
      font-size: 22px;
      font-weight: bold;
    }

    .navbar-right {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 14px;
    }

    .user-avatar {
      width: 35px;
      height: 35px;
      background: #17a2b8; /* Warna Cyan untuk Perawat */
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
    }

    .btn-logout {
      padding: 8px 20px;
      background-color: #dc3545;
      color: white; border: none; border-radius: 6px;
      cursor: pointer; text-decoration: none; display: inline-block;
      font-size: 14px; transition: 0.3s;
    }
    
    .btn-logout:hover {
        background-color: #c82333;
    }

    /* Container Utama */
    .container {
      max-width: 1200px;
      margin: 40px auto 0;
      padding: 0 20px;
    }

    /* Kartu Selamat Datang */
    .welcome-card {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      margin-bottom: 30px;
      border-left: 5px solid #17a2b8; /* Aksen warna Perawat */
    }

    .welcome-card h2 {
      color: rgb(2, 3, 129);
      margin-bottom: 10px;
    }

    .welcome-card p {
      color: #666;
      line-height: 1.6;
    }

    /* Grid Menu */
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
    }

    .menu-card {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      text-align: center;
      text-decoration: none;
      color: #333;
      transition: transform 0.3s, box-shadow 0.3s;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 200px; /* Tinggi seragam */
      position: relative;
    }

    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .menu-icon {
      font-size: 40px;
      margin-bottom: 15px;
    }

    .menu-card h3 {
      color: rgb(2, 3, 129);
      margin-bottom: 5px;
      font-size: 18px;
      font-weight: 600;
    }

    .menu-card p {
      font-size: 13px;
      color: #666;
    }

    /* Badge Notifikasi Antrian */
    .badge-count {
      background-color: #dc3545;
      color: white;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: bold;
      margin-top: 10px;
      display: inline-block;
    }

    .status-safe {
        color: #28a745;
        font-size: 13px;
        margin-top: 5px;
        font-weight: 500;
    }

    /* Responsif */
    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        gap: 15px;
        padding: 20px;
      }
      
      .navbar-right {
          width: 100%;
          justify-content: space-between;
      }
      
      .menu-grid {
          grid-template-columns: repeat(2, 1fr);
      }
    }
    
    @media (max-width: 480px) {
        .menu-grid {
            grid-template-columns: 1fr;
        }
    }
  </style>
</head>
<body>

<nav class="navbar">
  <div class="navbar-left">
    <img src="/aset/logo-rshp.jpg" alt="Logo RSHP Unair">
    <h1>Dashboard Perawat</h1>
  </div>
  <div class="navbar-right">
    <div class="user-info">
      <div class="user-avatar">🩺</div>
      <span>{{ Auth::user()->nama ?? 'Perawat' }}</span>
    </div>
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

<div class="container">
    <div class="welcome-card">
      <h2>Selamat Datang, {{ Auth::user()->nama ?? 'Rekan Medis' }}!</h2>
      <p>Silakan pilih menu di bawah ini untuk memproses pemeriksaan awal pasien (Anamnesa & Tanda Vital).</p>
    </div>

    <div class="menu-grid">
        
        <a href="{{ route('perawat.rekam-medis.index') }}" class="menu-card">
            <div class="menu-icon">🩺</div>
            <h3>Rekam Medis</h3>
            <p>Input Anamnesa & Tindakan</p>
        </a>

    </div>
</div>

</body>
</html>