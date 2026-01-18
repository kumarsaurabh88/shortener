<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $users = User::with('role')->paginate(20);
        $roles = Role::all();
        return view('roles.index', compact('users', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update(['role_id' => $request->role_id]);

        return redirect()->route('roles.index')->with('success', "Role updated for {$user->name}");
    }
}
