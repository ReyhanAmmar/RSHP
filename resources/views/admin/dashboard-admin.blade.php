<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Dashboard Admin RSHP Unair">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - RSHP Unair</title>
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
      color: white; border: none; border-radius: 6px;
      cursor: pointer; text-decoration: none; display: inline-block;
      font-size: 14px;
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

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .stat-icon {
      width: 60px;
      height: 60px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
    }

    .stat-icon.blue {
      background: #e3f2fd;
    }

    .stat-icon.orange {
      background: #fff3e0;
    }

    .stat-icon.green {
      background: #e8f5e9;
    }

    .stat-icon.purple {
      background: #f3e5f5;
    }

    .stat-content h3 {
      font-size: 32px;
      color: rgb(2, 3, 129);
      margin-bottom: 5px;
    }

    .stat-content p {
      color: #666;
      font-size: 14px;
    }

    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    .menu-card {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
      text-decoration: none;
      color: #333;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }

    .menu-icon {
      font-size: 48px;
      margin-bottom: 15px;
    }

    .menu-card h3 {
      color: rgb(2, 3, 129);
      margin-bottom: 10px;
      font-size: 18px;
    }

    .menu-card p {
      color: #666;
      font-size: 13px;
    }

    .alert {
      padding: 15px 20px;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        gap: 15px;
      }

      .stats-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="navbar-left">
    <img src="/aset/logo-rshp.jpg" alt="Logo RSHP Unair">
    <h1>Dashboard Admin</h1>
    </div>
  <div class="navbar-right">
    <div class="user-info">
      <div class="user-avatar">👤</div>
      <span>{{ Auth::user()->name ?? 'Admin' }}</span>
    </div>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

  <div class="container">
    <div class="welcome-card">
      <h2>Selamat Datang di Dashboard Admin!</h2>
      <p>Kelola sistem Rumah Sakit Hewan Pendidikan Universitas Airlangga dengan mudah dan efisien.</p>
  </div>

  <!-- Menu Grid -->
  <div class="menu-grid">
    <a href="{{ route('admin.data-user.index') }}" class="menu-card">
      <div class="menu-icon">👤</div>
      <h3>Data User</h3>
    </a>
    <a href="{{ route('admin.manajemen-role.index') }}" class="menu-card">
      <div class="menu-icon">👥</div>
      <h3>Manajemen Role</h3>
    </a>
    <a href="{{ route('admin.jenis-hewan.index') }}" class="menu-card">
      <div class="menu-icon">🐾</div>
      <h3>Jenis Hewan</h3>
    </a>
    <a href="admin.ras-hewan.index" class="menu-card">
      <div class="menu-icon">🧬</div>
      <h3>Ras Hewan</h3>
    </a>
    <a></a>
</body>
</html>