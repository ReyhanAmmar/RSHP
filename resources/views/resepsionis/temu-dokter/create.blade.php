<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Antrian Temu Dokter</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <style>
        textarea {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            color: #2d3748;
            transition: all 0.3s ease;
            background-color: #f7fafc;
            font-family: inherit;
            resize: vertical;
        }

        textarea:focus {
            outline: none;
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        textarea:hover {
            border-color: #cbd5e0;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Form Registrasi Temu Dokter</h1>

        @if ($errors->any())
            <div style="background-color: #fff5f5; border: 1px solid #fc8181; color: #c53030; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem;">
                <strong style="display: block; margin-bottom: 0.5rem;">Terjadi kesalahan!</strong>
                <ul style="padding-left: 1.5rem; margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
            @csrf

            <div>
                <label for="idpemilik">Nama Pemilik</label>
                <select name="idpemilik" id="idpemilik" required>
                    <option value="">-- Pilih Pemilik --</option>
                    @foreach ($pemilik as $p)
                        <option value="{{ $p->idpemilik }}">{{ $p->user->nama ?? $p->nama_pemilik }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="idpet">Nama Hewan</label>
                <select name="idpet" id="idpet" required>
                    <option value="">-- Pilih Hewan --</option>
                    @foreach ($pets as $pet)
                        <option value="{{ $pet->idpet }}">{{ $pet->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="idrole_user">Dokter</label>
                <select name="idrole_user" id="idrole_user" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach ($dokter as $d)
                        <option value="{{ $d->idrole_user }}">{{ $d->user->nama ?? $d->nama_dokter }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="tanggal_temu">Tanggal Temu</label>
                <input type="date" name="tanggal_temu" id="tanggal_temu" class="form-control" required 
                       style="width: 100%; padding: 0.875rem 1rem; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; color: #2d3748; background-color: #f7fafc; transition: all 0.3s ease;">
            </div>
            <div>
                <label for="keluhan">Keluhan</label>
                <textarea name="keluhan" id="keluhan" rows="3" placeholder="Tuliskan keluhan hewan..." required></textarea>
            </div>
            <div>
                <label for="catatan">Catatan Tambahan</label>
                <textarea name="catatan" id="catatan" rows="3" placeholder="(Opsional)"></textarea>
            </div>
            <div>
                <label for="status">Status</label>
                <select name="status" id="status" disabled style="background-color: #edf2f7; cursor: not-allowed;">
                    <option value="0" selected>Menunggu</option>
                </select>
            </div>

            <div class="btn-group">
                <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        const dateInput = document.getElementById('tanggal_temu');
        dateInput.addEventListener('focus', function() {
            this.style.borderColor = '#667eea';
            this.style.backgroundColor = 'white';
            this.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.1)';
            this.style.transform = 'translateY(-2px)';
        });
        dateInput.addEventListener('blur', function() {
            this.style.borderColor = '#e2e8f0';
            this.style.backgroundColor = '#f7fafc';
            this.style.boxShadow = 'none';
            this.style.transform = 'translateY(0)';
        });
    </script>

</body>
</html>