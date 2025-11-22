<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Exception;

class KategoriController extends Controller
{
    public function index() {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create() {
        return view('admin.kategori.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|min:3|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);

        try {
            $this->createKategori($request->all());
            return redirect()->route('admin.kategori.index')->with('success', 'Data berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id) {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|min:3|unique:kategori,nama_kategori,'.$id.',idkategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update(['nama_kategori' => $this->formatNama($request->nama_kategori)]);
        
        return redirect()->route('admin.kategori.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id) {
        Kategori::destroy($id);
        return redirect()->route('admin.kategori.index')->with('success', 'Data berhasil dihapus');
    }

    protected function createKategori(array $data) {
        return Kategori::create([
            'nama_kategori' => $this->formatNama($data['nama_kategori']),
        ]);
    }

    protected function formatNama($nama) {
        return trim(ucwords(strtolower($nama)));
    }
}