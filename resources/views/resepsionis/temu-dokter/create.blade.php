@extends('layouts.resepsionis')
@section('title', 'Daftar Temu Dokter')
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0"><h6 class="mb-0">Pendaftaran Pasien Baru</h6></div>
      <div class="card-body">
        <form action="{{ route('temu-dokter.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-control-label">Tanggal Periksa</label>
                <input class="form-control" type="date" name="tanggal_temu" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label class="form-control-label">Pilih Pemilik</label>
                <select class="form-control" id="selectOwner">
                    <option value="">-- Cari Pemilik --</option>
                    @foreach($pemilik as $p)
                        <option value="{{ $p->idpemilik }}">{{ $p->user->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-control-label">Pilih Hewan</label>
                <select class="form-control" name="idpet" id="selectPet" required>
                    <option value="">-- Pilih Pemilik Dulu --</option>
                    @foreach($pets as $pet)
                        <option value="{{ $pet->idpet }}" data-owner="{{ $pet->idpemilik }}" style="display:none;">{{ $pet->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-control-label">Pilih Dokter</label>
                <select class="form-control" name="idrole_user" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokter as $d)
                        <option value="{{ $d->idrole_user }}">{{ $d->user->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="text-end">
                <a href="{{ route('temu-dokter.index') }}" class="btn btn-secondary btn-sm">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan Antrian</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    document.getElementById('selectOwner').addEventListener('change', function() {
        let ownerId = this.value;
        let petOptions = document.querySelectorAll('#selectPet option');
        document.getElementById('selectPet').value = "";
        
        petOptions.forEach(opt => {
            if(opt.dataset.owner == ownerId) opt.style.display = 'block';
            else if(opt.value != "") opt.style.display = 'none';
        });
    });
</script>
@endsection