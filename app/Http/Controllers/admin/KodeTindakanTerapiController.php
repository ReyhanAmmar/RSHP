<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;
use Exception;

class KodeTindakanTerapiController extends Controller
{
    public function index(Request $request)
    {
        $query = KodeTindakanTerapi::query();

        if ($request->get('status') == 'non-aktif') {
            $query->onlyTrashed();
        }

        $tindakan = $query->orderBy('idkode_tindakan_terapi', 'asc')->get();

        return view('admin.tindakan.index', compact('tindakan'));
    }

    public function create() {
        $kategori = Kategori::all();
        $klinis = KategoriKlinis::all();
        return view('admin.tindakan.create', compact('kategori', 'klinis'));
    }

    public function store(Request $request) {
        $request->validate([
            'deskripsi_tindakan_terapi' => 'required|min:3',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis'
        ], [
            'deskripsi_tindakan_terapi.required' => 'Deskripsi wajib diisi.',
        ]);

        try {
            $lastData = KodeTindakanTerapi::orderBy('idkode_tindakan_terapi', 'desc')->first();
            $nextId = $lastData ? ($lastData->idkode_tindakan_terapi + 1) : 1;
            
            $kodeOtomatis = 'T' . str_pad($nextId, 2, '0', STR_PAD_LEFT);

            $data = $request->all();
            $data['kode'] = $kodeOtomatis;

            $this->createTindakan($data);
            return redirect()->route('admin.tindakan.index')->with('success', 'Data berhasil ditambahkan (Kode: '.$kodeOtomatis.')');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id) {
        $tindakan = KodeTindakanTerapi::findOrFail($id);
        $kategori = Kategori::all();
        $klinis = KategoriKlinis::all();
        return view('admin.tindakan.edit', compact('tindakan', 'kategori', 'klinis'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'kode' => 'required|max:10|unique:kode_tindakan_terapi,kode,'.$id.',idkode_tindakan_terapi',
            'deskripsi_tindakan_terapi' => 'required|min:3',
            'idkategori' => 'required',
            'idkategori_klinis' => 'required'
        ]);

        $tindakan = KodeTindakanTerapi::findOrFail($id);
        $tindakan->update([
            'kode' => strtoupper(trim($request->kode)),
            'deskripsi_tindakan_terapi' => $this->formatDeskripsi($request->deskripsi_tindakan_terapi),
            'idkategori' => $request->idkategori,
            'idkategori_klinis' => $request->idkategori_klinis,
        ]);

        return redirect()->route('admin.tindakan.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id) {
        KodeTindakanTerapi::destroy($id);
        return redirect()->route('admin.tindakan.index')->with('success', 'Data berhasil dihapus');
    }

    protected function createTindakan(array $data) {
        return KodeTindakanTerapi::create([
            'kode' => $data['kode'],
            'deskripsi_tindakan_terapi' => $this->formatDeskripsi($data['deskripsi_tindakan_terapi']),
            'idkategori' => $data['idkategori'],
            'idkategori_klinis' => $data['idkategori_klinis']
        ]);
    }

    protected function formatDeskripsi($nama) {
        return ucfirst(trim($nama));
    }

    public function restore($id)
    {
        KodeTindakanTerapi::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Data tindakan berhasil dipulihkan.');
    }
}