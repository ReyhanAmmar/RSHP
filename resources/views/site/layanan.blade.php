<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Layanan Rumah Sakit Hewan Pendidikan Unair">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layanan - RSHP Unair</title>
  <style>
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
      margin-bottom: 40px;
      font-weight: bold;
    }

    .layanan-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }

    .layanan-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 30px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .layanan-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    }

    .layanan-icon {
      font-size: 48px;
      margin-bottom: 20px;
      color: orange;
    }

    .layanan-card h3 {
      color: rgb(2, 3, 129);
      font-size: 22px;
      margin-bottom: 15px;
    }

    .layanan-card p {
      color: #555;
      line-height: 1.6;
      font-size: 15px;
    }

    .layanan-card ul {
      text-align: left;
      margin: 15px 0;
      padding-left: 20px;
    }

    .layanan-card li {
      color: #555;
      margin: 8px 0;
      font-size: 14px;
    }

    .info-section {
      background: #f5f5f5;
      padding: 30px;
      border-radius: 12px;
      margin-top: 40px;
    }

    .info-section h2 {
      color: rgb(2, 3, 129);
      font-size: 26px;
      margin-bottom: 20px;
      text-align: center;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }

    .info-item {
      background: white;
      padding: 20px;
      border-radius: 8px;
      border-left: 4px solid orange;
    }

    .info-item h4 {
      color: rgb(2, 3, 129);
      margin-bottom: 10px;
      font-size: 18px;
    }

    .info-item p {
      color: #555;
      line-height: 1.6;
      margin: 5px 0;
      font-size: 14px;
    }

    /* Footer */
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
      .layanan-grid {
        grid-template-columns: 1fr;
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
  <a href="/login">Login</a>
</nav>

<!-- Banner -->
<div class="banner">
    <img src="./aset/banner.webp" alt="Rumah Sakit Hewan Pendidikan Unair">
</div>

<!-- Nav bawah -->
<nav class="nav-bawah">
  <a href="struktur_org.html">Struktur Organisasi</a>
  <a href="layanan.php">Layanan Umum</a>
  <a href="#">Visi Misi dan Tujuan</a>
</nav>

<!-- Konten Layanan -->
<div class="container">
  <h1 class="page-title">Layanan Kami</h1>

  <div class="layanan-grid">
    <!-- Layanan 1 -->
    <div class="layanan-card">
      <div class="layanan-icon">🏥</div>
      <h3>Pemeriksaan Kesehatan</h3>
      <p>Pemeriksaan kesehatan menyeluruh untuk hewan peliharaan Anda dengan peralatan modern dan dokter hewan berpengalaman.</p>
      <ul>
        <li>Pemeriksaan fisik lengkap</li>
        <li>Pemeriksaan laboratorium</li>
        <li>Konsultasi kesehatan</li>
      </ul>
    </div>

    <!-- Layanan 2 -->
    <div class="layanan-card">
      <div class="layanan-icon">💉</div>
      <h3>Vaksinasi</h3>
      <p>Program vaksinasi lengkap untuk melindungi hewan kesayangan Anda dari berbagai penyakit berbahaya.</p>
      <ul>
        <li>Vaksin rabies</li>
        <li>Vaksin Purevax untuk kucing</li>
        <li>Vaksin kombinasi anjing</li>
      </ul>
    </div>

    <!-- Layanan 3 -->
    <div class="layanan-card">
      <div class="layanan-icon">🔬</div>
      <h3>Laboratorium</h3>
      <p>Fasilitas laboratorium lengkap untuk pemeriksaan diagnostik yang akurat dan cepat.</p>
      <ul>
        <li>Pemeriksaan darah lengkap</li>
        <li>Tes urin dan feses</li>
        <li>Pemeriksaan mikrobiologi</li>
      </ul>
    </div>

    <!-- Layanan 4 -->
    <div class="layanan-card">
      <div class="layanan-icon">🏨</div>
      <h3>Rawat Inap</h3>
      <p>Fasilitas rawat inap yang nyaman dengan perawatan intensif 24 jam untuk kesembuhan optimal hewan Anda.</p>
      <ul>
        <li>Kandang individual</li>
        <li>Monitoring 24 jam</li>
        <li>Perawatan intensif</li>
      </ul>
    </div>

    <!-- Layanan 5 -->
    <div class="layanan-card">
      <div class="layanan-icon">📱</div>
      <h3>Pendaftaran Online</h3>
      <p>Kemudahan pendaftaran secara online untuk menghemat waktu Anda dalam mendaftarkan hewan kesayangan.</p>
      <ul>
        <li>Daftar kapan saja</li>
        <li>Pilih jadwal kunjungan</li>
        <li>Riwayat medis digital</li>
      </ul>
    </div>

    <!-- Layanan 6 -->
    <div class="layanan-card">
      <div class="layanan-icon">🚑</div>
      <h3>Layanan Gawat Darurat</h3>
      <p>Siap melayani kondisi darurat hewan peliharaan Anda dengan respons cepat dan penanganan profesional.</p>
      <ul>
        <li>Layanan 24 jam</li>
        <li>Penanganan trauma</li>
        <li>Kasus keracunan</li>
      </ul>
    </div>
  </div>

  <!-- Info Section -->
  <div class="info-section">
    <h2>Informasi Layanan</h2>
    <div class="info-grid">
      <div class="info-item">
        <h4>📅 Jam Operasional</h4>
        <p>Senin - Jumat: 08.00 - 16.00 WIB</p>
        <p>Sabtu: 08.00 - 12.00 WIB</p>
        <p>Minggu & Libur: Tutup</p>
        <p><strong>Darurat 24 Jam</strong></p>
      </div>

      <div class="info-item">
        <h4>📞 Kontak</h4>
        <p>Telepon: 031 5927832</p>
        <p>Email: rshp@fkh.unair.ac.id</p>
        <p>Whatsapp: 0812-xxxx-xxxx</p>
      </div>

      <div class="info-item">
        <h4>📍 Lokasi</h4>
        <p>Gedung RS Hewan Pendidikan</p>
        <p>Kampus C Universitas Airlangga</p>
        <p>Surabaya 60115, Jawa Timur</p>
      </div>
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