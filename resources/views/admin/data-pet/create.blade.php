<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Hewan - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Tambah Data Hewan</h1>
        @if($errors->any()) <div style="color:red; margin-bottom:15px;"><ul>@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul></div> @endif

        <form action="{{ route('admin.data-pet.store') }}" method="POST">
            @csrf
            
            <div>
                <label>Pemilik</label>
                <select name="idpemilik" required>
                    <option value="">-- Pilih Pemilik --</option>
                    @foreach($pemilik as $p)
                        <option value="{{ $p->idpemilik }}">{{ $p->user->nama ?? 'Tanpa Nama' }} ({{ $p->alamat }})</option>
                    @endforeach
                </select>
            </div>

            <div><label>Nama Hewan</label><input type="text" name="nama" required></div>

            <div style="display:flex; gap:15px;">
                <div style="flex:1;">
                    <label>Jenis Hewan</label>
                    <select name="idjenis_hewan" id="jenis_hewan" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($jenisHewan as $j)
                            <option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="flex:1;">
                    <label>Ras Hewan</label>
                    <select name="idras_hewan" id="ras_hewan" required>
                        <option value="">-- Pilih Jenis Dulu --</option>
                    </select>
                </div>
            </div>

            <div style="display:flex; gap:15px;">
                <div style="flex:1;">
                    <label>Kelamin</label>
                    <select name="jenis_kelamin" required>
                        <option value="J">Jantan</option>
                        <option value="B">Betina</option>
                    </select>
                </div>
                <div style="flex:1;">
                    <label>Warna / Tanda</label>
                    <input type="text" name="warna_tanda" required>
                </div>
            </div>

            <div><label>Tanggal Lahir</label><input type="date" name="tanggal_lahir"></div>

            <div class="btn-group">
                <a href="{{ route('admin.data-pet.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const jenisSelect = document.getElementById('jenis_hewan');
            const rasSelect = document.getElementById('ras_hewan');
            const rasData = @json($rasHewan); 

            jenisSelect.addEventListener('change', function() {
                const selectedId = this.value;
                rasSelect.innerHTML = '<option value="">-- Pilih Ras --</option>';
                
                if (selectedId) {
                    rasData.filter(r => r.idjenis_hewan == selectedId).forEach(r => {
                        const opt = document.createElement('option');
                        opt.value = r.idras_hewan;
                        opt.textContent = r.nama_ras;
                        rasSelect.appendChild(opt);
                    });
                }
            });
        });
    </script>
</body>
</html>