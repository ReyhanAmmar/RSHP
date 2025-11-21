<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roleUser.role'])->get(); 
        return view('admin.data-user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.data-user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:user,email', 
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.data-user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($iduser)
    {
        $user = User::with('roleUser')->findOrFail($iduser);
        $roles = Role::all();
        return view('admin.data-user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $iduser)
    {
        $user = User::findOrFail($iduser);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:user,email,'.$iduser.',iduser',
            'idrole' => 'required|exists:role,idrole', // Pastikan input name di form edit adalah 'idrole'
            'status' => 'nullable|in:0,1',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        RoleUser::updateOrCreate(
            ['iduser' => $iduser],
            [
                'idrole' => $request->idrole,
                'status' => $request->status ?? 1 
            ]
        );

        return redirect()->route('admin.data-user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function resetPassword($iduser)
    {
        $user = User::findOrFail($iduser);
        $defaultPassword = '123456'; 

        $user->update([
            'password' => Hash::make($defaultPassword),
        ]);

        return redirect()->route('admin.data-user.index')->with('success', 'Password user berhasil direset menjadi 123456.');
    }

    public function destroy($iduser)
    {
        $user = User::findOrFail($iduser);

        RoleUser::where('iduser', $iduser)->delete();
        
        $user->delete();

        return redirect()->route('admin.data-user.index')->with('success', 'User berhasil dihapus.');
    }
}