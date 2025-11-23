@extends('layouts.argon')
@section('title', 'Edit Hewan')
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0"><h6 class="mb-0">Edit Hewan</h6></div>
      <div class="card-body">
        <form action="{{ route('admin.data-pet.update', $pet->idpet) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-control-label">Pemilik</label>
                <select class="form-control" name="idpemilik" required>
                    @foreach($pemilik as $p)
                        <option value="{{ $p->idpemilik }}" {{ $pet->idpemilik == $p->idpemilik ? 'selected' : '' }}>
                            {{ $p->user->nama ?? '-' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group"><label class="form-control-label">Nama Hewan</label><input class="form-control" type="text" name="nama" value="{{ $pet->nama }}" required></div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-control-label">Jenis</label>
                        <select class="form-control" id="idjenis_hewan" name="idjenis_hewan" required>
                            @foreach($jenisHewan as $j)
                                <option value="{{ $j->idjenis_hewan }}" {{ $currentJenisId == $j->idjenis_hewan ? 'selected' : '' }}>{{ $j->nama_jenis_hewan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-control-label">Ras</label>
                        <select class="form-control" id="idras_hewan" name="idras_hewan" required>
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
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-control-label">Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" required>
                            <option value="J" {{ $pet->jenis_kelamin == 'J' ? 'selected' : '' }}>Jantan</option>
                            <option value="B" {{ $pet->jenis_kelamin == 'B' ? 'selected' : '' }}>Betina</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group"><label class="form-control-label">Warna</label><input class="form-control" type="text" name="warna_tanda" value="{{ $pet->warna_tanda }}" required></div>
                </div>
            </div>
            <div class="form-group"><label class="form-control-label">Tgl Lahir</label><input class="form-control" type="date" name="tanggal_lahir" value="{{ $pet->tanggal_lahir }}"></div>
            <div class="text-end">
                <a href="{{ route('admin.data-pet.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </div>
        </form>
    </div>
  </div>
</div>
</div>
<script>
    document.getElementById('idjenis_hewan').addEventListener('change', function() {
        const val = this.value;
        document.querySelectorAll('#idras_hewan option').forEach(opt => {
            if(opt.value === "") return;
            opt.style.display = opt.getAttribute('data-jenis') == val ? 'block' : 'none';
        });
        document.getElementById('idras_hewan').value = "";
    });
</script>
@endsection