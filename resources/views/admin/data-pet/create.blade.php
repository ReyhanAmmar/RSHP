@extends('layouts.argon')
@section('title', 'Tambah Hewan')
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0"><h6 class="mb-0">Tambah Hewan Baru</h6></div>
      <div class="card-body">
        <form action="{{ route('admin.data-pet.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-control-label">Pemilik</label>
                <select class="form-control" name="idpemilik" required>
                    <option value="">-- Pilih Pemilik --</option>
                    @foreach($pemilik as $p)
                        <option value="{{ $p->idpemilik }}">{{ $p->user->nama ?? '-' }} ({{ $p->alamat }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group"><label class="form-control-label">Nama Hewan</label><input class="form-control" type="text" name="nama" required></div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-control-label">Jenis</label>
                        <select class="form-control" id="idjenis_hewan" name="idjenis_hewan" required>
                            <option value="">-- Pilih --</option>
                            @foreach($jenisHewan as $j) <option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option> @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-control-label">Ras</label>
                        <select class="form-control" id="idras_hewan" name="idras_hewan" required><option value="">-- Pilih Jenis Dulu --</option></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-control-label">Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" required><option value="J">Jantan</option><option value="B">Betina</option></select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group"><label class="form-control-label">Warna</label><input class="form-control" type="text" name="warna_tanda" required></div>
                </div>
            </div>
            <div class="form-group"><label class="form-control-label">Tgl Lahir</label><input class="form-control" type="date" name="tanggal_lahir"></div>
            <div class="text-end">
                <a href="{{ route('admin.data-pet.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const jenis = document.getElementById('idjenis_hewan');
        const ras = document.getElementById('idras_hewan');
        const dataRas = @json($rasHewan);
        jenis.addEventListener('change', function() {
            ras.innerHTML = '<option value="">-- Pilih Ras --</option>';
            dataRas.filter(r => r.idjenis_hewan == this.value).forEach(r => {
                ras.innerHTML += `<option value="${r.idras_hewan}">${r.nama_ras}</option>`;
            });
        });
    });
</script>
@endsection