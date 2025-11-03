<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Antrian Temu Dokter</title>
</head>
<body>
        <h2>Tambah Antrian Temu Dokter</h2>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Form Registrasi Temu Dokter</h2>

        {{-- Menampilkan error validasi jika ada --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Temu Dokter --}}
        <form action="{{ route('temu-dokter.store') }}" method="POST">
            @csrf

            {{-- Pilih Pemilik --}}
            <div class="mb-3">
                <label for="idpemilik" class="form-label">Nama Pemilik</label>
                <select name="idpemilik" id="idpemilik" class="form-control" required>
                    <option value="">-- Pilih Pemilik --</option>
                    @foreach ($pemilik as $p)
                        <option value="{{ $p->idpemilik }}">{{ $p->nama_pemilik }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Pilih Hewan --}}
            <div class="mb-3">
                <label for="idpet" class="form-label">Nama Hewan</label>
                <select name="idpet" id="idpet" class="form-control" required>
                    <option value="">-- Pilih Hewan --</option>
                    @foreach ($pets as $pet)
                        <option value="{{ $pet->idpet }}">{{ $pet->nama_hewan }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Pilih Dokter --}}
            <div class="mb-3">
                <label for="iddokter" class="form-label">Dokter</label>
                <select name="iddokter" id="iddokter" class="form-control" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach ($dokter as $d)
                        <option value="{{ $d->iddokter }}">{{ $d->nama_dokter }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal Temu --}}
            <div class="mb-3">
                <label for="tanggal_temu" class="form-label">Tanggal Temu</label>
                <input type="date" name="tanggal_temu" id="tanggal_temu" class="form-control" required>
            </div>

            {{-- Keluhan --}}
            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan</label>
                <textarea name="keluhan" id="keluhan" rows="3" class="form-control" placeholder="Tuliskan keluhan hewan..." required></textarea>
            </div>

            {{-- Catatan Tambahan --}}
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan Tambahan</label>
                <textarea name="catatan" id="catatan" rows="3" class="form-control" placeholder="(Opsional)"></textarea>
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="menunggu">Menunggu</option>
                    <option value="selesai">Selesai</option>
                    <option value="batal">Batal</option>
                </select>
            </div>

            {{-- Tombol --}}
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('temu-dokter.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
