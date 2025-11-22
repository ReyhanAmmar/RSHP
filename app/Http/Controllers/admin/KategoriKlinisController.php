<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;
use Exception;

class KategoriKlinisController extends Controller
{
    public function index() {
        $klinis = KategoriKlinis::all();
        return view('admin.kategori-klinis.index', compact('klinis'));
    }

    public function create() {
        return view('admin.kategori-klinis.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_kategori_klinis' => 'required|string|max:255|min:3|unique:kategori_klinis,nama_kategori_klinis',
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi.',
            'nama_kategori_klinis.min' => 'Minimal 3 karakter.',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada.',
        ]);

        try {
            $this->createData($request->all());
            return redirect()->route('admin.kategori-klinis.index')->with('success', 'Data berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id) {
        $kategori = KategoriKlinis::findOrFail($id);
        return view('admin.kategori-klinis.edit', compact('kategori'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_kategori_klinis' => 'required|string|max:255|min:3|unique:kategori_klinis,nama_kategori_klinis,'.$id.',idkategori_klinis',
        ]);

        $item = KategoriKlinis::findOrFail($id);
        $item->update(['nama_kategori_klinis' => $this->formatNama($request->nama_kategori_klinis)]);
        
        return redirect()->route('admin.kategori-klinis.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id) {
        KategoriKlinis::destroy($id);
        return redirect()->route('admin.kategori-klinis.index')->with('success', 'Data berhasil dihapus');
    }

    protected function createData(array $data) {
        return KategoriKlinis::create([
            'nama_kategori_klinis' => $this->formatNama($data['nama_kategori_klinis']),
        ]);
    }

    protected function formatNama($nama) {
        return trim(ucwords(strtolower($nama)));
    }
}