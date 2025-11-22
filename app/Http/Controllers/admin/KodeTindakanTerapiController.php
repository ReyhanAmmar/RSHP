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
    public function index() {
        $tindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.tindakan.index', compact('tindakan'));
    }

    public function create() {
        $kategori = Kategori::all();
        $klinis = KategoriKlinis::all();
        return view('admin.tindakan.create', compact('kategori', 'klinis'));
    }

    public function store(Request $request) {
        $request->validate([
            'kode' => 'required|unique:kode_tindakan_terapi,kode|max:10',
            'deskripsi_tindakan_terapi' => 'required|min:3',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis'
        ], [
            'kode.unique' => 'Kode tindakan sudah ada.',
            'deskripsi_tindakan_terapi.required' => 'Deskripsi wajib diisi.',
        ]);

        try {
            $this->createTindakan($request->all());
            return redirect()->route('admin.tindakan.index')->with('success', 'Data berhasil ditambahkan');
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
            'kode' => strtoupper(trim($request->kode)), // Kode biasanya huruf besar semua
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
            'kode' => strtoupper(trim($data['kode'])),
            'deskripsi_tindakan_terapi' => $this->formatDeskripsi($data['deskripsi_tindakan_terapi']),
            'idkategori' => $data['idkategori'],
            'idkategori_klinis' => $data['idkategori_klinis']
        ]);
    }

    protected function formatDeskripsi($nama) {
        return ucfirst(trim($nama));
    }
}