<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            $invitations = Invitation::paginate(15);
        } elseif ($user->isAdmin()) {
            $invitations = Invitation::where('company_id', $user->company_id)->paginate(15);
        } else {
            return redirect('/')->with('error', 'You do not have permission to manage invitations');
        }

        return view('invitations.index', compact('invitations'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            return view('invitations.create', ['roles' => Role::all()]);
        } elseif ($user->isAdmin()) {
            // Admin can only invite Members
            $roles = Role::where('name', Role::MEMBER)->get();
            return view('invitations.create', compact('roles'));
        } else {
            return redirect('/')->with('error', 'You do not have permission to invite users');
        }
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'role' => ['required', 'string'],
        ]);

        // Authorization checks
        if ($user->isSuperAdmin()) {
            $role = Role::where('name', $validated['role'])->firstOrFail();
            if ($validated['role'] !== Role::ADMIN) {
                return back()->with('error', 'SuperAdmin can only invite Admins');
            }
        } elseif ($user->isAdmin()) {
            if ($validated['role'] !== Role::MEMBER) {
                return back()->with('error', 'Admin can only invite Members');
            }
            $role = Role::where('name', Role::MEMBER)->firstOrFail();
        } else {
            return redirect('/')->with('error', 'You do not have permission to invite users');
        }

        $invitation = Invitation::create([
            'email' => $validated['email'],
            'company_id' => $user->isSuperAdmin() ? null : $user->company_id,
            'role_id' => $role->id,
            'invited_by' => $user->id,
            'token' => Str::random(32),
        ]);

        return redirect()->route('invitations.index')->with('success', 'Invitation sent successfully!');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        if ($invitation->isAccepted()) {
            return redirect('/')->with('error', 'This invitation has already been accepted');
        }

        // Create user from invitation
        $user = User::create([
            'name' => explode('@', $invitation->email)[0],
            'email' => $invitation->email,
            'password' => bcrypt(Str::random(16)),
            'company_id' => $invitation->company_id,
            'role_id' => $invitation->role_id,
        ]);

        $invitation->update(['accepted_at' => now()]);

        return redirect('/login')->with('success', 'Account created! Please login with your email and set a password.');
    }
}
