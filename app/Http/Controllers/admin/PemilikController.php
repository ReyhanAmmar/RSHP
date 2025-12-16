<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PemilikController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemilik::with(['user' => function ($q) {
            $q->withTrashed();
        }]);

        if ($request->get('status') == 'Non-Aktif') {
            $query->onlyTrashed();
        }

        $pemilik = $query->orderBy('idpemilik', 'asc')->get();

        return view('admin.data-pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        return view('admin.data-pemilik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'no_wa' => 'required|numeric',
            'alamat' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => 5, 
                'status' => 1
            ]);

            Pemilik::create([
                'iduser' => $user->iduser,
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
            ]);
        });

        return redirect()->route('admin.data-pemilik.index')->with('success', 'Pemilik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('admin.data-pemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $user = User::findOrFail($pemilik->iduser);

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email,'.$user->iduser.',iduser',
            'no_wa' => 'required|numeric',
            'alamat' => 'required|string',
        ]);

        $userData = [
            'nama' => $request->nama,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        $user->update($userData);

        $pemilik->update([
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.data-pemilik.index')->with('success', 'Data pemilik diperbarui.');
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $user = User::find($pemilik->iduser);

        if ($user) {
            RoleUser::where('iduser', $user->iduser)->delete();
            $pemilik->delete();
            $user->delete();
        }

        return redirect()->route('admin.data-pemilik.index')->with('success', 'Pemilik berhasil dihapus.');
    }

    public function restore($id)
    {
        $pemilik = Pemilik::withTrashed()->findOrFail($id);
        
        $pemilik->restore();

        if ($pemilik->iduser) {
            $user = User::withTrashed()->find($pemilik->iduser);
            
            if ($user) {
                $user->restore();
            }
        }
        
        return back()->with('success', 'Data pemilik & akun user berhasil dipulihkan.');
    }
}