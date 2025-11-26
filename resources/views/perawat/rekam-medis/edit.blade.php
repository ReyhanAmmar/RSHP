@extends('layouts.perawat')
@section('title', 'Detail & Tindakan')
@section('content')
<div class="row">
  <div class="col-md-5">
    <div class="card mb-4">
        <div class="card-header pb-0"><h6>Data Pemeriksaan</h6></div>
        <div class="card-body">
            <form action="{{ route('perawat.rekam-medis.update', $rekamMedis->idrekam_medis) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label class="form-control-label">Anamnesa</label>
                    <textarea class="form-control" name="anamnesa" rows="3">{{ $rekamMedis->anamnesa }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Temuan Klinis</label>
                    <textarea class="form-control" name="temuan_klinis" rows="3">{{ $rekamMedis->temuan_klinis }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Diagnosa</label>
                    <textarea class="form-control" name="diagnosa" rows="3">{{ $rekamMedis->diagnosa }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm w-100">Update Data</button>
            </form>
        </div>
    </div>
  </div>

  <div class="col-md-7">
    <div class="card mb-4">
        <div class="card-header pb-0"><h6>Tindakan & Terapi</h6></div>
        <div class="card-body">
            <form action="{{ route('perawat.rekam-medis.store-detail', $rekamMedis->idrekam_medis) }}" method="POST" class="mb-4">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control" name="idkode_tindakan_terapi" required>
                                <option value="">-- Pilih Tindakan --</option>
                                @foreach($listTindakan as $t)
                                    <option value="{{ $t->idkode_tindakan_terapi }}">{{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control" type="text" name="detail" placeholder="Ket (Dosis)">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success btn-sm w-100">Add</button>
                    </div>
                </div>
            </form>

            <ul class="list-group">
                @foreach($rekamMedis->detailRekamMedis as $detail)
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                            <i class="ni ni-active-40 text-white opacity-10"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">{{ $detail->kodeTindakan->deskripsi_tindakan_terapi }}</h6>
                            <span class="text-xs">{{ $detail->detail ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <form action="{{ route('perawat.rekam-medis.destroy-detail', $detail->iddetail_rekam_medis) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-fat-remove text-danger"></i></button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
            
            <hr>
            <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary btn-sm w-100">Selesai & Kembali</a>
        </div>
    </div>
  </div>
</div>
@endsection