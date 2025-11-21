<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Role;

class ManajemenRoleController extends Controller
{
    public function index()
    {
        $users = User::with(['roleuser.role'])->whereHas('roleuser')->get();
        $roleUsers = RoleUser::with(['user', 'role'])->get();
        return view('admin.manajemen-role.index', compact('users'));
    }

    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.manajemen-role.create', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idrole' => 'required|exists:role,idrole',
        ]);

        $exists = RoleUser::where('iduser', $request->iduser)
                          ->where('idrole', $request->idrole)
                          ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'User tersebut sudah memiliki role ini.');
        }

        RoleUser::create([
            'iduser' => $request->iduser,
            'idrole' => $request->idrole,
            'status' => 1 
        ]);

        return redirect()->route('admin.manajemen-role.index')->with('success', 'Role berhasil ditambahkan ke user.');
    }

    public function edit($idrole_user)
    {
        $roleUser = RoleUser::with(['user', 'role'])->findOrFail($idrole_user);
        return view('admin.manajemen-role.edit', compact('roleUser'));
    }

    public function update(Request $request, $idrole_user)
    {
        $roleUser = RoleUser::findOrFail($idrole_user);

        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $roleUser->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.manajemen-role.index')->with('success', 'Status role user berhasil diperbarui.');
    }

    public function destroy($idrole_user)
    {
        $roleUser = RoleUser::findOrFail($idrole_user);
        $roleUser->delete();

        return redirect()->route('admin.manajemen-role.index')->with('success', 'Role user berhasil dihapus.');
    }
}