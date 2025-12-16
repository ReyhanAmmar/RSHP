<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perawat;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DataPerawatController extends Controller
{
    public function index(Request $request)
    {
        $query = Perawat::with(['user' => function ($q) {
            $q->withTrashed(); 
        }]);

        if ($request->get('status') == 'Non-Aktif') {
            $query->onlyTrashed();
        }

        $perawat = $query->orderBy('id_perawat', 'asc')->get();

        return view('admin.data-perawat.index', compact('perawat'));
    }

    public function create()
    {
        return view('admin.data-perawat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            RoleUser::create(['iduser' => $user->iduser, 'idrole' => 3, 'status' => 1]); // ID 3 = Perawat

            Perawat::create([
                'iduser' => $user->iduser,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'pendidikan' => $request->pendidikan,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);
        });

        return redirect()->route('admin.data-perawat.index')->with('success', 'Perawat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $perawat = Perawat::with(['user' => function ($query) {
            $query->withTrashed();
        }])->findOrFail($id);

        return view('admin.data-perawat.edit', compact('perawat'));
    }

    public function update(Request $request, $id)
    {
        $perawat = Perawat::findOrFail($id);
        
        $user = User::withTrashed()->findOrFail($perawat->iduser);

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email,'.$user->iduser.',iduser',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
            'pendidikan' => 'required',
        ]);

        $userData = ['nama' => $request->nama, 'email' => $request->email];
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        $user->update($userData);

        $perawat->update([
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'pendidikan' => $request->pendidikan,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return redirect()->route('admin.data-perawat.index')->with('success', 'Data perawat diperbarui.');
    }

    public function destroy($id)
    {
        $perawat = Perawat::findOrFail($id);
        $iduser = $perawat->iduser;

        RoleUser::where('iduser', $iduser)->delete();
        $perawat->delete();
        
        if($user = User::find($iduser)) {
            $user->delete();
        }

        return redirect()->route('admin.data-perawat.index')->with('success', 'Data perawat dihapus.');
    }

    public function restore($id)
    {
        $perawat = Perawat::withTrashed()->findOrFail($id);
        $perawat->restore();
        
        if ($perawat->iduser) {
            $user = User::withTrashed()->where('iduser', $perawat->iduser)->first();
            if($user) {
                $user->restore();           
            }
        }

    return back()->with('success', 'Data perawat & akun berhasil dipulihkan.');
    }
}