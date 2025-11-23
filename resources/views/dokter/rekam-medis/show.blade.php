<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Rekam Medis Pasien</title>
    <style>
        /* Reset & Global */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px 0;
        }

        /* Container */
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Header Section */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-header h2 {
            color: #1f2937;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        /* Info Card - Patient Summary */
        .info-card {
            background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
            border: 2px solid #c7d2fe;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .info-item label {
            font-size: 11px;
            color: #6366f1;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .info-item span {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            line-height: 1.4;
        }

        /* Section Card */
        .section {
            background: white;
            padding: 35px;
            border-radius: 16px;
            margin-bottom: 25px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            border: 1px solid #f3f4f6;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .section:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #020381;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 3px solid #eef2ff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Data Rows */
        .data-row {
            margin-bottom: 20px;
        }

        .data-row:last-child {
            margin-bottom: 0;
        }

        .data-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
            display: block;
        }

        .data-value {
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            padding: 15px 18px;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            color: #1f2937;
            font-size: 15px;
            line-height: 1.6;
            min-height: 50px;
            transition: all 0.3s;
        }

        .data-value:hover {
            border-color: #c7d2fe;
            background: white;
        }

        /* Tindakan List */
        .tindakan-list {
            padding-left: 0;
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .tindakan-list li {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            padding: 16px 20px;
            border-radius: 10px;
            border-left: 4px solid #10b981;
            color: #1f2937;
            font-size: 15px;
            line-height: 1.6;
            transition: all 0.3s;
            box-shadow: 0 2px 6px rgba(16, 185, 129, 0.1);
        }

        .tindakan-list li:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        .tindakan-list li strong {
            color: #065f46;
            font-weight: 700;
        }

        .tindakan-list li .detail-text {
            color: #4b5563;
            font-style: italic;
            margin-left: 8px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
            font-style: italic;
            background: #fafafa;
            border-radius: 10px;
            border: 2px dashed #e5e7eb;
        }

        /* Button Back */
        .btn-back {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            padding: 12px 28px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(108, 117, 125, 0.3);
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.4);
        }

        .btn-back::before {
            content: "←";
            font-size: 18px;
        }

        /* Badge for Record ID */
        .record-badge {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: #1e40af;
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            border: 1px solid #bfdbfe;
            display: inline-block;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                margin: 20px auto;
                padding: 0 15px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-header h2 {
                font-size: 22px;
            }

            .info-card {
                grid-template-columns: 1fr;
                padding: 20px;
                gap: 20px;
            }

            .info-item span {
                font-size: 16px;
            }

            .section {
                padding: 20px;
            }

            .section-title {
                font-size: 18px;
            }

            .data-value {
                padding: 12px 15px;
                font-size: 14px;
            }

            .tindakan-list li {
                padding: 14px 16px;
                font-size: 14px;
            }

            .btn-back {
                width: 100%;
                justify-content: center;
            }
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
            }

            .btn-back {
                display: none;
            }

            .section {
                box-shadow: none;
                border: 1px solid #ddd;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="color:#333;">Detail Rekam Medis #{{ $rm->idrekam_medis }}</h2>
        <a href="{{ route('dokter.rekam-medis.index') }}" class="btn-back">Kembali</a>
    </div>

    <div class="info-card">
        <div class="info-item"><label>Nama Hewan</label><span>{{ $rm->pet->nama }}</span></div>
        <div class="info-item"><label>Pemilik</label><span>{{ $rm->pet->pemilik->user->nama ?? '-' }}</span></div>
        <div class="info-item"><label>Tanggal</label><span>{{ $rm->created_at->format('d M Y') }}</span></div>
    </div>

    <div class="section">
        <div class="section-title">📝 Hasil Pemeriksaan</div>
        <div class="data-row">
            <div class="data-label">Anamnesa (Keluhan)</div>
            <div class="data-value">{{ $rm->anamnesa }}</div>
        </div>
        <div class="data-row">
            <div class="data-label">Temuan Klinis</div>
            <div class="data-value">{{ $rm->temuan_klinis }}</div>
        </div>
        <div class="data-row">
            <div class="data-label">Diagnosa</div>
            <div class="data-value">{{ $rm->diagnosa }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">💊 Tindakan & Terapi</div>
        @if($rm->detailRekamMedis->count() > 0)
            <ul class="tindakan-list">
                @foreach($rm->detailRekamMedis as $detail)
                    <li>
                        <strong>{{ $detail->kodeTindakan->deskripsi_tindakan_terapi }}</strong>
                        @if($detail->detail) <span style="color:#666;">— {{ $detail->detail }}</span> @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p style="color:#888; font-style:italic;">Tidak ada tindakan yang tercatat.</p>
        @endif
    </div>
</div>

</body>
</html>