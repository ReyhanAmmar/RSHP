@extends('layouts.contentNavbarLayout')

@section('title', 'Registrasi Hewan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Layanan /</span> Registrasi Hewan</h4>

    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Pendaftaran Hewan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('resepsionis.registrasi-pet.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label" for="idpemilik">Pemilik Hewan</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <select class="form-select" id="idpemilik" name="idpemilik" required>
                                    <option value="">-- Pilih Pemilik --</option>
                                    @foreach($pemilik as $p)
                                        <option value="{{ $p->idpemilik }}" {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                                            {{ $p->user->nama }} ({{ $p->alamat }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="text-muted text-uppercase font-weight-bolder mb-3">Identitas Hewan</h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="nama">Nama Hewan</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-purchase-tag"></i></span>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Mochi" required />
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" required>
                                    <option value="Jantan">Jantan</option>
                                    <option value="Betina">Betina</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="idjenis_hewan">Jenis Hewan</label>
                                <select class="form-select" id="idjenis_hewan" name="idjenis_hewan" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    @foreach($jenisHewan as $jenis)
                                        <option value="{{ $jenis->idjenis_hewan }}">{{ $jenis->nama_jenis_hewan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="idras_hewan">Ras Hewan</label>
                                <select class="form-select" id="idras_hewan" name="idras_hewan" required>
                                    <option value="">-- Pilih Ras --</option>
                                    @foreach($rasHewan as $ras)
                                        <option value="{{ $ras->idras_hewan }}" data-jenis="{{ $ras->idjenis_hewan }}">
                                            {{ $ras->nama_ras }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="warna">Warna / Ciri Khas</label>
                                <input type="text" class="form-control" id="warna" name="warna" placeholder="Cth: Belang Tiga" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir (Estimasi)</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required />
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-outline-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Hewan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jenisSelect = document.getElementById('idjenis_hewan');
        const rasSelect = document.getElementById('idras_hewan');
        const rasOptions = Array.from(rasSelect.options);

        jenisSelect.addEventListener('change', function() {
            const selectedJenis = this.value;
            rasSelect.value = ""; 
            
            rasOptions.forEach(option => {
                if (option.value === "") return;

                if (option.dataset.jenis === selectedJenis) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection