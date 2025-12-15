@extends('layouts.contentNavbarLayout')

@section('title', 'Daftar Temu Dokter')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Layanan /</span> Pendaftaran Pasien
    </h4>

    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Pendaftaran Temu Dokter</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('temu-dokter.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_temu">Tanggal Periksa</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input type="date" class="form-control" id="tanggal_temu" name="tanggal_temu" value="{{ date('Y-m-d') }}" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="selectOwner">Pilih Pemilik</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <select class="form-select" id="selectOwner">
                                    <option value="">-- Cari Pemilik --</option>
                                    @foreach($pemilik as $p)
                                        <option value="{{ $p->idpemilik }}">{{ $p->user->nama }} ({{ $p->no_wa }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="selectPet">Pilih Hewan</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-paw"></i></span>
                                <select class="form-select" name="idpet" id="selectPet" required>
                                    <option value="">-- Pilih Pemilik Terlebih Dahulu --</option>
                                    @foreach($pets as $pet)
                                        <option value="{{ $pet->idpet }}" data-owner="{{ $pet->idpemilik }}" style="display:none;">
                                            {{ $pet->nama }} ({{ $pet->jenisHewan->nama_jenis_hewan ?? '-' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="idrole_user">Pilih Dokter</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-plus-medical"></i></span>
                                <select class="form-select" name="idrole_user" id="idrole_user" required>
                                    <option value="">-- Pilih Dokter --</option>
                                    @foreach($dokter as $d)
                                        <option value="{{ $d->idrole_user }}">drh. {{ $d->user->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('temu-dokter.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Antrian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ownerSelect = document.getElementById('selectOwner');
        const petSelect = document.getElementById('selectPet');
        const petOptions = Array.from(petSelect.options);

        ownerSelect.addEventListener('change', function() {
            const ownerId = this.value;
            
            petSelect.value = "";
            
            petSelect.options[0].text = ownerId ? "-- Pilih Hewan --" : "-- Pilih Pemilik Terlebih Dahulu --";

            petOptions.forEach(opt => {
                if (opt.value === "") return;

                if (opt.getAttribute('data-owner') === ownerId) {
                    opt.style.display = 'block';
                } else {
                    opt.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection