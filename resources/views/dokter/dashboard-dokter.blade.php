<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Dokter - RSHP Unair</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
    }

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
      font-size: 24px;
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
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      background: orange;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
    }

    .btn-logout {
      padding: 8px 20px;
      background-color: #dc3545;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
    }

    .btn-logout:hover {
      background-color: #c82333;
    }

    .container {
      max-width: 1200px;
      margin: 40px auto 0;
      padding: 0 20px;
    }

    .welcome-card {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }

    .welcome-card h2 {
      color: rgb(2, 3, 129);
      margin-bottom: 10px;
    }

    .welcome-card p {
      color: #666;
      line-height: 1.6;
    }

    .rekam-medis-card {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    .rekam-header {
      background: rgb(2, 3, 129);
      color: white;
      padding: 15px 20px;
      border-radius: 8px 8px 0 0;
      margin: -25px -25px 20px -25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .rekam-header strong {
      font-size: 18px;
    }

    .rekam-header .date {
      font-size: 14px;
      opacity: 0.9;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 20px;
    }

    .info-item {
      padding: 15px;
      background: #f8f9fa;
      border-radius: 8px;
      border-left: 4px solid rgb(2, 3, 129);
    }

    .info-item label {
      display: block;
      font-weight: bold;
      color: rgb(2, 3, 129);
      margin-bottom: 5px;
      font-size: 14px;
    }

    .info-item p {
      color: #333;
      margin: 0;
    }

    .no-data {
      text-align: center;
      padding: 40px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .no-data-icon {
      font-size: 64px;
      margin-bottom: 15px;
    }

    .no-data h3 {
      color: #666;
      margin-bottom: 10px;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        gap: 15px;
      }

      .info-grid {
        grid-template-columns: 1fr;
      }

      .rekam-header {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>

<nav class="navbar">
  <div class="navbar-left">
    <img src="/aset/logo-rshp.jpg" alt="Logo RSHP Unair">
    <h1>Dashboard Dokter</h1>
  </div>
  <div class="navbar-right">
    <div class="user-info">
      <div class="user-avatar">👨‍⚕️</div>
      <span>{{ Auth::user()->nama }}</span>
    </div>
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

<div class="container">
  <div class="welcome-card">
    <h2>Selamat Datang, Dr. {{ Auth::user()->nama }}!</h2>
    <p>Berikut adalah rekam medis pasien yang Anda tangani.</p>
  </div>

  @forelse($rekamMedis as $rm)
  <div class="rekam-medis-card">
    <div class="rekam-header">
      <strong>🐾 {{ $rm->pet->nama }}</strong>
      <span class="date">{{ \Carbon\Carbon::parse($rm->created_at)->format('d M Y, H:i') }}</span>
    </div>

    <div class="info-grid">
      <div class="info-item">
        <label>Pemilik</label>
        <p>{{ $rm->pet->pemilik->user->nama }}</p>
      </div>
      <div class="info-item">
        <label>Ras</label>
        <p>{{ $rm->pet->rasHewan->nama_ras }}</p>
      </div>
      <div class="info-item">
        <label>Jenis Hewan</label>
        <p>{{ $rm->pet->rasHewan->jenisHewan->nama_jenis_hewan }}</p>
      </div>
    </div>

    <div class="info-grid">
      <div class="info-item">
        <label>Anamnesa</label>
        <p>{{ $rm->anamnesa ?? '-' }}</p>
      </div>
      <div class="info-item">
        <label>Temuan Klinis</label>
        <p>{{ $rm->temuan_klinis ?? '-' }}</p>
      </div>
      <div class="info-item">
        <label>Diagnosa</label>
        <p>{{ $rm->diagnosa ?? '-' }}</p>
      </div>
    </div>
  </div>
  @empty
  <div class="no-data">
    <div class="no-data-icon">📋</div>
    <h3>Belum Ada Rekam Medis</h3>
    <p>Anda belum menangani pasien saat ini.</p>
  </div>
  @endforelse
</div>

</body>
</html>