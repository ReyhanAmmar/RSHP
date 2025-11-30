@extends('layouts.perawat')

@section('title', 'Detail & Tindakan')

@section('content')
<div class="row">
  
  <div class="col-12 mb-4">
    <div class="card">
        <div class="card-body p-3">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                        <i class="ni ni-tv-2 text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col">
                    <h5 class="mb-1">
                        {{ $rekamMedis->pet->nama }} 
                        <span class="badge bg-gradient-success ms-2 text-xxs">{{ $rekamMedis->pet->jenisHewan->nama_jenis_hewan ?? '' }}</span>
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm text-secondary">
                        Pemilik: {{ $rekamMedis->pet->pemilik->user->nama ?? '-' }} | 
                        Dokter: drh. {{ $rekamMedis->temuDokter->roleUser->user->nama ?? '-' }}
                    </p>
                </div>
                <div class="col-auto text-end">
                    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-sm btn-secondary mb-0">Kembali</a>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="col-lg-4 mb-4">
    <div class="card h-100">
        <div class="card-header pb-0">
            <h6 class="mb-0 text-uppercase">Data Pemeriksaan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('perawat.rekam-medis.update', $rekamMedis->idrekam_medis) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="form-group">
                    <label class="form-control-label">Anamnesa</label>
                    <textarea class="form-control" name="anamnesa" rows="4">{{ $rekamMedis->anamnesa }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-control-label">Temuan Klinis</label>
                    <textarea class="form-control" name="temuan_klinis" rows="4">{{ $rekamMedis->temuan_klinis }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-control-label">Diagnosa</label>
                    <textarea class="form-control" name="diagnosa" rows="3">{{ $rekamMedis->diagnosa }}</textarea>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary btn-sm w-100">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <div class="col-lg-8 mb-4">
    <div class="card h-100">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">Tindakan & Terapi</h6>
            <span class="badge bg-light text-dark border">Total: {{ $rekamMedis->detailRekamMedis->count() }}</span>
        </div>
        
        <div class="card-body">
            <div class="bg-gray-100 border-radius-lg p-3 mb-4">
                <form action="{{ route('perawat.rekam-medis.store-detail', $rekamMedis->idrekam_medis) }}" method="POST">
                    @csrf
                    <label class="text-xs text-uppercase font-weight-bold mb-2 text-primary">Filter & Pilih Tindakan:</label>
                    
                    <div class="row g-2">
                        <div class="col-md-3">
                            <label class="form-control-label text-xs">Kategori</label>
                            <select id="filterKategori" class="form-control form-control-sm">
                                <option value="">Semua</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-control-label text-xs">Kategori Klinis</label>
                            <select id="filterKlinis" class="form-control form-control-sm">
                                <option value="">Semua</option>
                                @foreach($kategoriKlinis as $kk)
                                    <option value="{{ $kk->idkategori_klinis }}">{{ $kk->nama_kategori_klinis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-control-label text-xs">Nama Tindakan *</label>
                            <select name="idkode_tindakan_terapi" id="selectTindakan" class="form-control form-control-sm" required>
                                <option value="">-- Pilih Tindakan --</option>
                                </select>
                        </div>
                    </div>

                    <div class="row g-2 mt-2">
                        <div class="col-md-9">
                            <input class="form-control form-control-sm" type="text" name="detail" placeholder="Keterangan Tambahan (Cth: Dosis 3x1, Pasca Operasi)">
                        </div>
                        <div class="col-md-3 d-grid">
                            <button type="submit" class="btn btn-success btn-sm mb-0">➕ Tambahkan</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tindakan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ket.</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekamMedis->detailRekamMedis as $detail)
                        <tr>
                            <td><span class="badge bg-gradient-light text-dark border text-xxs">{{ $detail->kodeTindakan->kode }}</span></td>
                            <td>
                                <h6 class="mb-0 text-xs">{{ $detail->kodeTindakan->deskripsi_tindakan_terapi }}</h6>
                            </td>
                            <td><span class="text-xs font-weight-bold">{{ $detail->detail ?? '-' }}</span></td>
                            <td class="align-middle text-end">
                                <form action="{{ route('perawat.rekam-medis.destroy-detail', $detail->iddetail_rekam_medis) }}" method="POST" onsubmit="return confirm('Hapus tindakan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-link text-danger text-gradient px-1 mb-0"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-xs text-secondary py-3">Belum ada tindakan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const filterKategori = document.getElementById('filterKategori');
        const filterKlinis = document.getElementById('filterKlinis');
        const selectTindakan = document.getElementById('selectTindakan');
        
        const dataTindakan = @json($listTindakan);

        function filterOptions() {
            const katVal = filterKategori.value;
            const klinisVal = filterKlinis.value;
            
            selectTindakan.innerHTML = '<option value="">-- Pilih Tindakan --</option>';
            
            const filtered = dataTindakan.filter(item => {
                const matchKategori = katVal === "" || item.idkategori == katVal;
                const matchKlinis = klinisVal === "" || item.idkategori_klinis == klinisVal;
                return matchKategori && matchKlinis;
            });

            if(filtered.length > 0) {
                filtered.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.idkode_tindakan_terapi;
                    option.textContent = `${item.kode} - ${item.deskripsi_tindakan_terapi}`;
                    selectTindakan.appendChild(option);
                });
            } else {
                const option = document.createElement('option');
                option.textContent = "Tidak ada tindakan yang sesuai filter";
                selectTindakan.appendChild(option);
            }
        }

        filterKategori.addEventListener('change', filterOptions);
        filterKlinis.addEventListener('change', filterOptions);
        
        filterOptions();
    });
</script>
@endsection