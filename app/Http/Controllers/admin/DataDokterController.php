<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DataDokterController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'aktif');

        $query = Dokter::with('user');

        if ($status === 'non-aktif') {
            $query->onlyTrashed();
        } else {
        }

        $dokters = $query->get();

        return view('admin.data-dokter.index', compact('dokters', 'status'));
    }

    public function create()
    {
        return view('admin.data-dokter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
            'bidang_dokter' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            RoleUser::create(['iduser' => $user->iduser, 'idrole' => 2, 'status' => 1]);

            Dokter::create([
                'iduser' => $user->iduser,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'bidang_dokter' => $request->bidang_dokter,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);
        });

        return redirect()->route('admin.data-dokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dokter = Dokter::with('user')->findOrFail($id);
        return view('admin.data-dokter.edit', compact('dokter'));
    }

    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        $user = User::findOrFail($dokter->iduser);

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email,'.$user->iduser.',iduser',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
            'bidang_dokter' => 'required',
        ]);

        $userData = ['nama' => $request->nama, 'email' => $request->email];
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        $user->update($userData);

        $dokter->update([
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'bidang_dokter' => $request->bidang_dokter,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return redirect()->route('admin.data-dokter.index')->with('success', 'Data dokter diperbarui.');
    }

    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->deleted_by = auth()->user()->iduser; 
        $dokter->save();
        
        $dokter->delete();

        return redirect()->route('admin.data-dokter.index')->with('success', 'Data Dokter dinonaktifkan.');
    }

    public function restore($id)
    {
        $dokter = Dokter::onlyTrashed()->findOrFail($id);
        
        $dokter->restore();

        return redirect()->route('admin.data-dokter.index', ['status' => 'non-aktif'])
            ->with('success', 'Data Dokter berhasil diaktifkan kembali.');
    }
}