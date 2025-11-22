<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Hewan - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Data Hewan</h1>
        @if($errors->any()) <div style="color:red; margin-bottom:15px;"><ul>@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul></div> @endif

        <form action="{{ route('admin.data-pet.update', $pet->idpet) }}" method="POST">
            @csrf @method('PUT')
            
            <div>
                <label>Pemilik</label>
                <select name="idpemilik" required>
                    @foreach($pemilik as $p)
                        <option value="{{ $p->idpemilik }}" {{ $pet->idpemilik == $p->idpemilik ? 'selected' : '' }}>
                            {{ $p->user->nama ?? 'Tanpa Nama' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div><label>Nama Hewan</label><input type="text" name="nama" value="{{ $pet->nama }}" required></div>

            <div style="display:flex; gap:15px;">
                <div style="flex:1;">
                    <label>Jenis Hewan</label>
                    <select name="idjenis_hewan" id="jenis_hewan" required>
                        @foreach($jenisHewan as $j)
                            <option value="{{ $j->idjenis_hewan }}" {{ $currentJenisId == $j->idjenis_hewan ? 'selected' : '' }}>
                                {{ $j->nama_jenis_hewan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="flex:1;">
                    <label>Ras Hewan</label>
                    <select name="idras_hewan" id="ras_hewan" required>
                        @foreach($rasHewan as $r)
                            <option value="{{ $r->idras_hewan }}" data-jenis="{{ $r->idjenis_hewan }}" 
                                {{ $pet->idras_hewan == $r->idras_hewan ? 'selected' : '' }}
                                style="{{ $r->idjenis_hewan == $currentJenisId ? '' : 'display:none' }}">
                                {{ $r->nama_ras }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display:flex; gap:15px;">
                <div style="flex:1;">
                    <label>Kelamin</label>
                    <select name="jenis_kelamin" required>
                        <option value="J" {{ $pet->jenis_kelamin == 'J' ? 'selected' : '' }}>Jantan</option>
                        <option value="B" {{ $pet->jenis_kelamin == 'B' ? 'selected' : '' }}>Betina</option>
                    </select>
                </div>
                <div style="flex:1;">
                    <label>Warna / Tanda</label>
                    <input type="text" name="warna_tanda" value="{{ $pet->warna_tanda }}" required>
                </div>
            </div>

            <div><label>Tanggal Lahir</label><input type="date" name="tanggal_lahir" value="{{ $pet->tanggal_lahir }}"></div>

            <div class="btn-group">
                <a href="{{ route('admin.data-pet.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
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