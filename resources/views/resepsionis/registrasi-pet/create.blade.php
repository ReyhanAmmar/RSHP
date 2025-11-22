<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Hewan Baru</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Registrasi Hewan Baru</h1>

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('resepsionis.registrasi-pet.store') }}" method="POST">
            @csrf
            
            <div>
                <label>Pilih Pemilik</label>
                <select name="idpemilik" required style="width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px;">
                    <option value="">-- Cari Nama Pemilik --</option>
                    @foreach($pemilik as $p)
                        <option value="{{ $p->idpemilik }}" {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                            {{ $p->user->nama ?? 'Tanpa Nama' }} ({{ $p->alamat }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Nama Hewan</label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Mochi, Bleki" required>
            </div>

            <div style="display:flex; gap:15px;">
                <div style="flex:1;">
                    <label>Jenis Hewan</label>
                    <select name="idjenis_hewan" id="jenis_hewan" required style="width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px;">
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($jenisHewan as $jenis)
                            <option value="{{ $jenis->idjenis_hewan }}" {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis_hewan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div style="flex:1;">
                    <label>Ras Hewan</label>
                    <select name="idras_hewan" id="ras_hewan" required style="width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px;">
                        <option value="">-- Pilih Jenis --</option>
                        </select>
                </div>
            </div>

            <div style="display:flex; gap:15px;">
                <div style="flex:1;">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" required style="width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px;">
                        <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>Jantan</option>
                        <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>Betina</option>
                    </select>
                </div>
                <div style="flex:1;">
                    <label>Warna / Tanda Khusus</label>
                    <input type="text" name="warna_tanda" value="{{ old('warna_tanda') }}" placeholder="Contoh: Putih Belang Hitam" required>
                </div>
            </div>

            <div>
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
            </div>

            <div class="btn-group" style="margin-top: 20px;">
                <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
                <button type="submit" class="btn btn-primary">Simpan Hewan</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const jenisSelect = document.getElementById('jenis_hewan');
            const rasSelect = document.getElementById('ras_hewan');
            const rasData = @json($rasHewan); 

            function filterRas() {
                const selectedJenisId = jenisSelect.value;
                
                rasSelect.innerHTML = '<option value="">-- Pilih Ras --</option>';
                
                if (selectedJenisId) {
                    const filteredRas = rasData.filter(ras => ras.idjenis_hewan == selectedJenisId);

                    if (filteredRas.length > 0) {
                        filteredRas.forEach(ras => {
                            const option = document.createElement('option');
                            option.value = ras.idras_hewan;
                            option.textContent = ras.nama_ras;
                            rasSelect.appendChild(option);
                        });
                    } else {
                        rasSelect.innerHTML = '<option value="">Tidak ada ras untuk jenis ini</option>';
                    }
                } else {
                    rasSelect.innerHTML = '<option value="">-- Pilih Jenis Terlebih Dahulu --</option>';
                }
            }

            jenisSelect.addEventListener('change', filterRas);
            
            if(jenisSelect.value) { filterRas(); }
        });
    </script>
</body>
</html>