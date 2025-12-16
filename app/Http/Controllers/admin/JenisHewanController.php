<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Exception;

class JenisHewanController extends Controller
{
    public function index(Request $request)
    {
        $query = JenisHewan::query();

        if ($request->get('status') == 'Non-Aktif') {
            $query->onlyTrashed();
        }

        $jenis = $query->orderBy('idjenis_hewan', 'asc')->get();

        return view('admin.jenis-hewan.index', compact('jenis'));
    }

    public function create()
    {
        return view('admin.jenis-hewan.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:255|min:3|unique:jenis_hewan,nama_jenis_hewan',
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis_hewan.string'   => 'Nama jenis hewan harus berupa teks.',
            'nama_jenis_hewan.max'      => 'Nama jenis hewan maksimal 255 karakter.',
            'nama_jenis_hewan.min'      => 'Nama jenis hewan minimal 3 karakter.',
            'nama_jenis_hewan.unique'   => 'Nama jenis hewan sudah ada.',
        ]);

        try {
            $this->createJenisHewan($request->all());
            
            return redirect()->route('admin.jenis-hewan.index')
                             ->with('success', 'Jenis hewan berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    protected function createJenisHewan(array $data)
    {
        try {
            return JenisHewan::create([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data jenis hewan: ' . $e->getMessage());
        }
    }

    protected function formatNamaJenisHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    public function edit($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        return view('admin.jenis-hewan.edit', compact('jenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:255|min:3|unique:jenis_hewan,nama_jenis_hewan,'.$id.',idjenis_hewan',
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
        ]);

        $jenisHewan = JenisHewan::findOrFail($id);
        
        $jenisHewan->update([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($request->nama_jenis_hewan)
        ]);

        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis hewan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->delete();

        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis hewan berhasil dihapus!');
    }

    public function restore($id)
    {
        JenisHewan::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Data jenis hewan berhasil dipulihkan.');
    }
}