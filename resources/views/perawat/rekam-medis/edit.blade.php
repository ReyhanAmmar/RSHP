{{-- resources/views/perawat/rekam-medis/edit.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Rekam Medis - Perawat</title>
    <style>
        /* --- CSS GLOBAL --- */
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }
        
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f5f6fa;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #020381 0%, #1e3a8a 100%);
            color: white; 
            padding: 15px 30px;
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-left { 
            display: flex; 
            align-items: center; 
            gap: 15px; 
        }
        
        .navbar-left img { 
            width: 45px; 
            height: 45px; 
            border-radius: 50%; 
            background: white; 
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.3);
        }
        
        .navbar h1 { 
            font-size: 24px; 
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        
        .navbar-right { 
            display: flex; 
            align-items: center; 
            gap: 20px; 
        }
        
        .navbar-right a { 
            color: white; 
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.2s;
        }
        
        .navbar-right a:hover {
            opacity: 0.8;
        }
        
        .btn-logout {
            padding: 10px 24px; 
            background-color: #dc3545; 
            color: white;
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        }
        
        .btn-logout:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
        }

        /* Container Utama */
        .container { 
            max-width: 1200px; 
            margin: 30px auto; 
            padding: 0 20px; 
        }

        /* Header Halaman */
        .page-header {
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .page-header h2 { 
            color: #1f2937; 
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        /* Info Pasien (Box Biru Muda) */
        .patient-info-card {
            background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
            border: 2px solid #c7d2fe; 
            border-radius: 12px;
            padding: 25px; 
            margin-bottom: 30px;
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
            gap: 25px;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.1);
        }
        
        .info-group label {
            font-size: 11px; 
            text-transform: uppercase; 
            color: #6366f1; 
            font-weight: 700; 
            letter-spacing: 1px; 
            margin-bottom: 8px; 
            display: block;
        }
        
        .info-group div { 
            font-size: 17px; 
            font-weight: 600; 
            color: #1f2937;
            line-height: 1.4;
        }

        /* Content Card (Putih) */
        .content-card {
            background: white; 
            border-radius: 16px; 
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            padding: 35px; 
            margin-bottom: 30px;
            border: 1px solid #f3f4f6;
        }
        
        .card-title {
            font-size: 20px; 
            font-weight: 700; 
            color: #020381;
            margin-bottom: 25px; 
            padding-bottom: 12px; 
            border-bottom: 3px solid #eef2ff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Form Elements */
        label { 
            display: block; 
            margin-bottom: 10px; 
            font-weight: 600; 
            color: #374151;
            font-size: 14px;
        }
        
        textarea, select, input[type="text"] {
            width: 100%; 
            padding: 12px 16px; 
            border: 2px solid #e5e7eb; 
            border-radius: 10px;
            font-family: inherit; 
            font-size: 14px; 
            color: #1f2937; 
            background-color: #f9fafb;
            transition: all 0.3s;
        }
        
        textarea:focus, select:focus, input:focus {
            outline: none; 
            border-color: #6366f1; 
            background-color: white;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Grid untuk Form Header */
        .form-grid { 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 25px;
            margin-bottom: 20px;
        }
        
        /* Grid untuk Form Tambah Tindakan */
        .action-form {
            display: flex; 
            gap: 15px; 
            align-items: flex-end;
            background: #f8fafc; 
            padding: 25px; 
            border-radius: 12px; 
            border: 2px dashed #cbd5e0; 
            margin-bottom: 25px;
        }
        
        .action-form .form-group { 
            flex: 1; 
        }
        
        .form-group {
            margin-bottom: 20px;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px; 
            border: none; 
            border-radius: 10px; 
            cursor: pointer;
            font-size: 14px; 
            font-weight: 600; 
            text-decoration: none; 
            display: inline-block; 
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .btn-primary { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            color: white; 
        }
        
        .btn-primary:hover { 
            opacity: 0.9;
        }
        
        .btn-secondary { 
            background-color: #6c757d; 
            color: white; 
        }
        
        .btn-secondary:hover { 
            background-color: #5a6268; 
        }

        .btn-success { 
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white; 
        }
        
        .btn-success:hover { 
            opacity: 0.9;
        }

        .btn-danger { 
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white; 
            padding: 8px 16px; 
            font-size: 13px; 
        }
        
        .btn-danger:hover { 
            opacity: 0.9;
        }

        /* Table */
        .table-responsive { 
            overflow-x: auto;
            margin-top: 15px;
        }
        
        table { 
            width: 100%; 
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }
        
        thead { 
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        }
        
        th { 
            padding: 16px 18px; 
            text-align: left; 
            font-weight: 700; 
            color: #1f2937; 
            border-bottom: 2px solid #e5e7eb;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        td { 
            padding: 16px 18px; 
            border-bottom: 1px solid #f3f4f6; 
            color: #4b5563; 
            vertical-align: middle;
            font-size: 14px;
        }
        
        tbody tr {
            transition: background-color 0.2s;
        }
        
        tbody tr:hover {
            background-color: #f9fafb;
        }
        
        tbody tr:last-child td {
            border-bottom: none;
        }
        
        /* Alert */
        .alert { 
            padding: 16px 20px; 
            border-radius: 10px; 
            margin-bottom: 25px; 
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46; 
            border: 2px solid #6ee7b7;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
        }
        
        /* Empty State */
        .empty-state {
            text-align: center; 
            padding: 40px; 
            color: #9ca3af; 
            border: 2px dashed #e5e7eb; 
            border-radius: 12px; 
            margin-top: 15px;
            background: #fafafa;
        }
        
        .empty-state p:first-child {
            font-size: 32px; 
            margin-bottom: 8px;
        }
        
        /* Badge Kode */
        .badge-kode {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: #4338ca;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 12px;
            display: inline-block;
            border: 1px solid #c7d2fe;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-grid { 
                grid-template-columns: 1fr;
            }
            
            .action-form { 
                flex-direction: column; 
                align-items: stretch; 
            }
            
            .action-form .form-group {
                width: 100%;
            }
            
            .navbar { 
                flex-direction: column; 
                gap: 15px;
                padding: 15px 20px;
            }
            
            .navbar-left,
            .navbar-right {
                width: 100%;
                justify-content: center;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .patient-info-card {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .content-card {
                padding: 20px;
            }
            
            table {
                font-size: 13px;
            }
            
            th, td {
                padding: 12px 10px;
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
    <a href="{{ route('perawat.dashboard') }}">Home</a>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

<div class="container">

    <div class="page-header">
        <h2>Proses Rekam Medis</h2>
        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">⬅ Selesai & Kembali</a>
    </div>

    @if(session('success'))
        <div class="alert">✓ {{ session('success') }}</div>
    @endif

    <div class="patient-info-card">
        <div class="info-group">
            <label>Nama Hewan</label>
            <div>{{ $rekamMedis->pet->nama }}</div>
        </div>
        <div class="info-group">
            <label>Pemilik</label>
            <div>{{ $rekamMedis->pet->pemilik->user->nama ?? '-' }}</div>
        </div>
        <div class="info-group">
            <label>Dokter Pemeriksa</label>
            <div>drh. {{ $rekamMedis->temuDokter->roleUser->user->nama ?? '-' }}</div>
        </div>
        <div class="info-group">
            <label>Tanggal Periksa</label>
            <div>{{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d M Y') }}</div>
        </div>
    </div>

    <div class="content-card">
        <div class="card-title">📝 Data Pemeriksaan Awal</div>
        
        <form action="{{ route('perawat.rekam-medis.update', $rekamMedis->idrekam_medis) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-grid">
                <div>
                    <label>Anamnesa (Keluhan)</label>
                    <textarea name="anamnesa" rows="4">{{ $rekamMedis->anamnesa }}</textarea>
                </div>
                <div>
                    <label>Temuan Klinis</label>
                    <textarea name="temuan_klinis" rows="4">{{ $rekamMedis->temuan_klinis }}</textarea>
                </div>
            </div>

            <div style="margin-top: 15px;">
                <label>Diagnosa Sementara</label>
                <textarea name="diagnosa" rows="2">{{ $rekamMedis->diagnosa }}</textarea>
            </div>

            <div style="text-align: right; margin-top: 20px;">
                <button type="submit" class="btn btn-primary">💾 Simpan Perubahan Data</button>
            </div>
        </form>
    </div>

    <div class="content-card">
        <div class="card-title">💊 Tindakan & Terapi</div>

        <form action="{{ route('perawat.rekam-medis.store-detail', $rekamMedis->idrekam_medis) }}" method="POST">
            @csrf
            <div class="action-form">
                <div class="form-group" style="flex: 2;">
                    <label>Jenis Tindakan</label>
                    <select name="idkode_tindakan_terapi" required>
                        <option value="">-- Pilih Tindakan --</option>
                        @foreach($listTindakan as $t)
                            <option value="{{ $t->idkode_tindakan_terapi }}">
                                {{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="flex: 3;">
                    <label>Keterangan Detail</label>
                    <input type="text" name="detail" placeholder="Contoh: Dosis 2x1, Pasca Operasi">
                </div>
                <div class="form-group" style="flex: 0 0 auto;">
                    <button type="submit" class="btn btn-success">➕ Tambah</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            @if($rekamMedis->detailRekamMedis->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th width="15%">Kode</th>
                            <th width="30%">Nama Tindakan</th>
                            <th width="40%">Keterangan / Catatan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekamMedis->detailRekamMedis as $detail)
                        <tr>
                            <td><span style="background:#eff6ff; color:#4338ca; padding:4px 8px; border-radius:4px; font-weight:bold; font-size:12px;">{{ $detail->kodeTindakan->kode }}</span></td>
                            <td>{{ $detail->kodeTindakan->deskripsi_tindakan_terapi }}</td>
                            <td>{{ $detail->detail ?? '-' }}</td>
                            <td>
                                <form action="{{ route('perawat.rekam-medis.destroy-detail', $detail->iddetail_rekam_medis) }}" method="POST" onsubmit="return confirm('Hapus tindakan ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align: center; padding: 30px; color: #9ca3af; border: 1px solid #f3f4f6; border-radius: 8px; margin-top: 10px;">
                    <p style="font-size: 24px; margin-bottom: 5px;">🩺</p>
                    Belum ada tindakan yang ditambahkan.
                </div>
            @endif
        </div>
    </div>

</div>

</body>
</html>