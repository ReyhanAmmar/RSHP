<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Exception;

class RasHewanController extends Controller
{
    public function index() {
        $rasHewan = RasHewan::with('jenisHewan')->orderBy('idras_hewan', 'asc')->get();
        return view('admin.ras-hewan.index', compact('rasHewan'));
    }

    public function create() {
        $jenisHewan = JenisHewan::all();
        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_ras' => 'required|string|max:100|min:3|unique:ras_hewan,nama_ras',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ], [
            'nama_ras.required' => 'Nama ras wajib diisi.',
            'nama_ras.unique' => 'Nama ras ini sudah ada.',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih.',
        ]);

        try {
            $this->createRas($request->all());
            return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras hewan berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id) {
        $rasHewan = RasHewan::findOrFail($id);
        $jenisHewan = JenisHewan::all();
        return view('admin.ras-hewan.edit', compact('rasHewan', 'jenisHewan'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_ras' => 'required|string|max:100|min:3|unique:ras_hewan,nama_ras,'.$id.',idras_hewan',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);

        $rasHewan = RasHewan::findOrFail($id);
        $rasHewan->update([
            'nama_ras' => $this->formatNama($request->nama_ras),
            'idjenis_hewan' => $request->idjenis_hewan
        ]);

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras hewan berhasil diperbarui!');
    }

    public function destroy($id) {
        RasHewan::findOrFail($id)->delete();
        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras hewan berhasil dihapus!');
    }

    protected function createRas(array $data) {
        return RasHewan::create([
            'nama_ras' => $this->formatNama($data['nama_ras']),
            'idjenis_hewan' => $data['idjenis_hewan']
        ]);
    }

    protected function formatNama($nama) {
        return trim(ucwords(strtolower($nama)));
    }
}