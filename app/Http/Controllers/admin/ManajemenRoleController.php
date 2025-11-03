<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class ManajemenRoleController extends Controller
{
    public function index()
    {
        $users = User::with(['roleuser.role'])->get();

        return view('admin.manajemen-role.index', compact('users'));
    }

    public function edit($iduser)
    {
        $user = User::with(['roleuser.role'])->findOrFail($iduser);
        $roles = Role::all();

        return view('admin.manajemen-role.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $iduser)
    {
        $request->validate([
            'roles' => 'required|array',
        ]);

        $user = User::findOrFail($iduser);

        RoleUser::where('iduser', $user->iduser)->delete();

        foreach ($request->roles as $roleId) {
            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => $roleId,
                'status' => 1, 
            ]);
        }

        return redirect()->route('admin.manajemen-role.index')->with('success', 'Role user berhasil diperbarui.');
    }

    public function nonaktifkan($id)
    {
        $roleUser = RoleUser::findOrFail($id);
        $roleUser->update(['status' => 0]);

        return back()->with('success', 'Role berhasil dinonaktifkan.');
    }


    public function aktifkan($id)
    {
        $roleUser = RoleUser::findOrFail($id);
        $roleUser->update(['status' => 1]);

        return back()->with('success', 'Role berhasil diaktifkan kembali.');
    }
}
