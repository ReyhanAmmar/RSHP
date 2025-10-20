<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Kontak Rumah Sakit Hewan Pendidikan Unair">
  <meta name="keywords" content="HTML, CSS, Kontak RSHP">
  <meta name="author" content="Arhaburrizqi">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontak - RSHP Unair</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    nav {
      display: flex;
      justify-content: center;
      gap: 30px;
      padding: 15px 0;
    }
    nav a {
      text-decoration: none;
      padding: 5px 10px;
    }
    .nav-atas {
      background-color: rgb(2, 3, 129);
      color: white;
      justify-content: flex-end;
      padding-right: 30px;
    }
    .nav-atas a {
      color: white;
    }
    .nav-bawah {
      background-color: orange;
      color: black;
    }
    .nav-bawah a {
      color: black;
    }

    .banner {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 20px 0;
    }
    .banner img {
      width: 50%;
      height: auto;
      cursor: pointer;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 40px 20px;
    }

    .page-title {
      text-align: center;
      font-size: 32px;
      color: rgb(2, 3, 129);
      margin-bottom: 20px;
      font-weight: bold;
    }

    .page-subtitle {
      text-align: center;
      color: #666;
      margin-bottom: 40px;
      font-size: 16px;
    }

    .kontak-wrapper {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      margin-bottom: 40px;
    }

    .kontak-info {
      background: #f9f9f9;
      padding: 30px;
      border-radius: 12px;
    }

    .kontak-info h2 {
      color: rgb(2, 3, 129);
      font-size: 24px;
      margin-bottom: 25px;
    }

    .info-item {
      margin-bottom: 25px;
      padding: 20px;
      background: white;
      border-radius: 8px;
      border-left: 4px solid orange;
    }

    .info-item h3 {
      color: rgb(2, 3, 129);
      font-size: 18px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .info-item .icon {
      font-size: 24px;
    }

    .info-item p {
      color: #555;
      line-height: 1.8;
      margin: 5px 0;
      font-size: 15px;
    }

    .kontak-form {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .kontak-form h2 {
      color: rgb(2, 3, 129);
      font-size: 24px;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: #333;
      font-weight: 500;
      font-size: 15px;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      font-family: Arial, sans-serif;
      transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: orange;
    }

    .form-group textarea {
      resize: vertical;
      min-height: 120px;
    }

    .btn-submit {
      background-color: orange;
      color: black;
      padding: 12px 40px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-submit:hover {
      background-color: #ff8c00;
    }

    .social-media {
      margin-top: 40px;
      text-align: center;
    }

    .social-media h2 {
      color: rgb(2, 3, 129);
      font-size: 24px;
      margin-bottom: 20px;
    }

    .social-links {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    .social-item {
      background: white;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-decoration: none;
      color: #333;
      transition: transform 0.3s, box-shadow 0.3s;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
    }

    .social-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .social-item .icon {
      font-size: 36px;
    }

    .social-item .name {
      font-weight: bold;
      color: rgb(2, 3, 129);
    }

    .social-item .username {
      font-size: 13px;
      color: #666;
    }

    .map-section {
      margin-top: 40px;
      padding: 30px;
      background: #f9f9f9;
      border-radius: 12px;
    }

    .map-section h2 {
      color: rgb(2, 3, 129);
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
    }

    .map-container {
      width: 100%;
      height: 400px;
      border-radius: 8px;
      overflow: hidden;
    }

    .map-container iframe {
      width: 100%;
      height: 100%;
      border: 0;
    }

    footer {
      background-color: rgb(2, 3, 129);
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
      font-size: 14px;
      line-height: 1.6;
    }
    footer h3 {
      margin: 0 0 10px;
    }

    @media (max-width: 768px) {
      .kontak-wrapper {
        grid-template-columns: 1fr;
      }

      .banner img {
        width: 80%;
      }
    }
  </style>
</head>
<body>

<!-- Nav atas -->
<nav class="nav-atas">
  <a href="/home">Home</a>
  <a href="/layanan">Layanan</a>
  <a href="/kontak">Kontak</a>
  <a href="/struktur">struktur</a>
  <a href="./admin/login.php">Login</a>
</nav>

<!-- Banner -->
<div class="banner">
    <img src="./aset/banner.webp" alt="Rumah Sakit Hewan Pendidikan Unair">
</div>

<!-- Konten Kontak -->
<div class="container">
  <h1 class="page-title">Hubungi Kami</h1>
  <p class="page-subtitle">Kami siap membantu Anda dan hewan kesayangan Anda</p>

  <div class="kontak-wrapper">
    <!-- Informasi Kontak -->
    <div class="kontak-info">
      <h2>Informasi Kontak</h2>
      
      <div class="info-item">
        <h3>
          <span class="icon">📍</span>
          Alamat
        </h3>
        <p>Gedung RS Hewan Pendidikan</p>
        <p>Kampus C Universitas Airlangga</p>
        <p>Jl. Mulyorejo, Surabaya 60115</p>
        <p>Jawa Timur, Indonesia</p>
      </div>

      <div class="info-item">
        <h3>
          <span class="icon">📞</span>
          Telepon
        </h3>
        <p>Telepon: 031 5927832</p>
        <p>Whatsapp: 0812-xxxx-xxxx</p>
        <p>Emergency: 24 Jam</p>
      </div>

      <div class="info-item">
        <h3>
          <span class="icon">✉️</span>
          Email
        </h3>
        <p>rshp@fkh.unair.ac.id</p>
        <p>info.rshp@unair.ac.id</p>
      </div>

      <div class="info-item">
        <h3>
          <span class="icon">🕐</span>
          Jam Operasional
        </h3>
        <p>Senin - Jumat: 08.00 - 16.00 WIB</p>
        <p>Sabtu: 08.00 - 12.00 WIB</p>
        <p>Minggu & Hari Libur: Tutup</p>
        <p><strong>Layanan Darurat: 24 Jam</strong></p>
      </div>
    </div>

    <!-- Form Kontak -->
    <div class="kontak-form">
      <h2>Kirim Pesan</h2>

      <form action="#" method="POST">
        
        <div class="form-group">
          <label for="nama">Nama Lengkap <span style="color: red;">*</span></label>
          <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" required>
        </div>

        <div class="form-group">
          <label for="email">Email <span style="color: red;">*</span></label>
          <input type="email" id="email" name="email" placeholder="contoh@email.com" required>
        </div>

        <div class="form-group">
          <label for="telepon">Nomor Telepon <span style="color: red;">*</span></label>
          <input type="tel" id="telepon" name="telepon" placeholder="08xx-xxxx-xxxx" required>
        </div>

        <div class="form-group">
          <label for="subjek">Subjek <span style="color: red;">*</span></label>
          <input type="text" id="subjek" name="subjek" placeholder="Topik pesan Anda" required>
        </div>

        <div class="form-group">
          <label for="pesan">Pesan <span style="color: red;">*</span></label>
          <textarea id="pesan" name="pesan" placeholder="Tulis pesan Anda di sini..." required></textarea>
        </div>

        <button type="submit" class="btn-submit">Kirim Pesan</button>
      </form>
    </div>
  </div>

  <!-- Social Media -->
  <div class="social-media">
    <h2>Ikuti Kami</h2>
    <div class="social-links">
      <a href="#" class="social-item" target="_blank">
        <span class="icon">📘</span>
        <span class="name">Facebook</span>
        <span class="username">@RSHPUnair</span>
      </a>

      <a href="#" class="social-item" target="_blank">
        <span class="icon">📷</span>
        <span class="name">Instagram</span>
        <span class="username">@rshp_unair</span>
      </a>

      <a href="#" class="social-item" target="_blank">
        <span class="icon">🐦</span>
        <span class="name">Twitter</span>
        <span class="username">@RSHPUnair</span>
      </a>

      <a href="#" class="social-item" target="_blank">
        <span class="icon">📺</span>
        <span class="name">YouTube</span>
        <span class="username">RSHP Unair</span>
      </a>
    </div>
  </div>

  <!-- Peta Lokasi -->
  <div class="map-section">
    <h2>Lokasi Kami</h2>
    <div class="map-container">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.3644788634985!2d112.78185931477536!3d-7.310285894717644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb5e3fa9b5b5%3A0x3a5e5e8f5e3e5e5e!2sUniversitas%20Airlangga%20Campus%20C!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</div>

<!-- Footer -->
<footer>
  <h3>RUMAH SAKIT HEWAN PENDIDIKAN</h3>
  GEDUNG RS HEWAN PENDIDIKAN<br>
  rshp@fkh.unair.ac.id<br>
  Telp : 031 5927832<br>
  Kampus C Universitas Airlangga<br>
  Surabaya 60115, Jawa Timur
</footer>

</body>
</html>