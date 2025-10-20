<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roleuser.role'])->get();
        return view('admin.data-user.index',compact('users'));
    }

    public function create()
    {
        $roles = role::all();
        return view('admin.data-user.tambahuser', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|varchar|max:100',
            'email' => 'required|varchar|email|max:100|unique:user,email',
            'password' => 'required|varchar|min:6',
            'role_id' => 'required|exists:role,idrole',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        RoleUser::create([
            'iduser' => $user->iduser,
            'idrole' => $request->idrole,
            'status' => 1,
        ]);

        return redirect()->route('admin.data-user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($iduser)
    {
        $user = User::with('roleuser')->findOrFail($iduser);
        $roles = Role::all();
        return view('admin.data-user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $iduser)
    {
        $user = User::findOrFail($iduser);

        $request->validate([
            'name' => 'required|varchar|max:100',
            'email' => 'required|varchar|email|max:100|unique:user,email,'.$iduser.',iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'nullable|in:0,1',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $roleUser = RoleUser::where('iduser', $iduser)->first();
        if ($roleUser) {
            $roleUser->update([
                'idrole' => $request->idrole,
                'status' => $request->status,
            ]);
        }
        return redirect()->route('admin.data-user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function resetPassword($iduser)
    {
        $user = User::findOrFail($iduser);
        $defaultPassword = '123456';

        $user->update([
            'password' => Hash::make($defaultPassword),
        ]);

        return redirect()->route('admin.data-user.index')->with('success', 'Password user berhasil direset.');
    }

    public function destroy($iduser)
    {
        $user = User::findOrFail($iduser);

        $roleUser = RoleUser::where('iduser', $iduser)->delete();
        $user->delete();

        return redirect()->route('admin.data-user.index')->with('success', 'User berhasil dihapus.');
    }
}