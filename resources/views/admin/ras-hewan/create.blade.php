@extends('layouts.contentNavbarLayout')

@section('title', 'Tambah Ras Hewan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Tambah Ras Hewan</h4>

    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Tambah Ras</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label" for="idjenis_hewan">Jenis Hewan</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-category"></i></span>
                                
                                {{-- PERBAIKAN DI SINI: name="idjenis_hewan" --}}
                                <select class="form-select" id="idjenis_hewan" name="idjenis_hewan" required>
                                    <option value="">-- Pilih Jenis Hewan --</option>
                                    
                                    {{-- PERBAIKAN DI SINI: Gunakan $jenisHewan (sesuai controller) --}}
                                    @foreach($jenisHewan as $jenis)
                                        <option value="{{ $jenis->idjenis_hewan }}">{{ $jenis->nama_jenis_hewan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="nama_ras">Nama Ras</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-purchase-tag"></i></span>
                                <input type="text" class="form-control" id="nama_ras" name="nama_ras" placeholder="Contoh: Persia, Bulldog" required />
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-outline-secondary me-2">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection