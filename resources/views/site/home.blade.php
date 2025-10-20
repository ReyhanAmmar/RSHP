<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Rumah Sakit Hewan Pendidikan Unair">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - RSHP Unair</title>
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

    .dua-kolom {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      gap: 20px;
      padding: 20px;
      flex-wrap: wrap;
    }
    .dua-kolom iframe {
      max-width: 100%;
      border-radius: 8px;
    }
    .dua-kolom .teks {
      max-width: 400px;
    }

    .berita {
      padding: 20px;
    }
    .berita h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .berita-wrapper {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }
    .berita-item {
      width: 350px;
      min-height: 420px;
      background: #f9f9f9;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
    }
    .berita-item img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }
    .berita-item-content {
      padding: 15px;
      flex-grow: 1;
      text-align: justify;
    }
    .berita-item-content p {
      margin: 0 0 10px;
      font-size: 14px;
      line-height: 1.5;
      color: #333;
    }
    .berita-item-content p.judul {
      font-weight: bold;
      font-size: 16px;
      line-height: 1.4;
      color: black;
    }
    .berita-item-content span {
      font-size: 14px;
      color: gray;
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
  <a href="#">Layanan Umum</a>
  <a href="#">Visi Misi dan Tujuan</a>
</nav>

<!-- Dua kolom -->
<section class="dua-kolom">
  <div>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/rCfvZPECZvE?si=6UU1MSyB2qtCoiME" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
  </div>
  <div class="teks" style="font-size: 21px;">
    <p>Rumah Sakit Hewan Pendidikan Universitas Airlangga berinovasi untuk selalu meningkatkan kualitas pelayanan, maka dari itu Rumah Sakit Hewan Pendidikan Universitas Airlangga mempunyai fitur pendaftaran online yang mempermudah untuk mendaftarkan hewan kesayangan anda.</p>
  </div>
</section>

<!-- Berita Terkini -->
<section class="berita">
  <h2>Berita Terkini</h2>
  <div class="berita-wrapper">
    <div class="berita-item">
      <img src="./aset/berita1.jpg" alt="Program Kerja Sama">
      <div class="berita-item-content">
        <p class="judul">Program Kerja Sama Rumah Sakit Hewan Pendidikan dengan SMK Negeri Tutur</p>
        <p>Rumah Sakit Hewan Pendidikan menjalin kerja sama dengan SMK Negeri Tutur dalam rangka meningkatkan kompetensi siswa di bidang kesehatan hewan. Acara ini meliputi pelatihan langsung dan observasi lapangan.</p>
        <span>29 September 2023</span>
      </div>
    </div>
    <div class="berita-item">
      <img src="./aset/berita2.jpg" alt="Road To Pet Festival">
      <div class="berita-item-content">
        <p class="judul">Road To Pet Festival 2023 Vaksin Purevax Gratis</p>
        <p>Dalam rangka memeriahkan Road To Pet Festival, Rumah Sakit Hewan Pendidikan memberikan layanan vaksin Purevax gratis bagi kucing peliharaan warga sekitar. Acara ini berlangsung selama dua hari penuh.</p>
        <span>25-26 September 2023</span>
      </div>
    </div>
    <div class="berita-item">
      <img src="./aset/berita3.jpg" alt="World Rabies Day">
      <div class="berita-item-content">
        <p class="judul">World Rabies Day</p>
        <p>Peringatan Hari Rabies Sedunia diadakan untuk meningkatkan kesadaran masyarakat tentang bahaya rabies dan pentingnya vaksinasi hewan peliharaan.</p>
        <span>28 September 2023</span>
      </div>
    </div>
  </div>
</section>

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