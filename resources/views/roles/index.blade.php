@extends('layout')

@section('title', 'Manage Roles')

@section('content')
    <div>
        <div class="card">
            <h2>Manage User Roles</h2>
            <p style="color: #6b7280; margin-top: 0.5rem;">Assign roles to users in the system.</p>
        </div>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb;">
                        <th style="text-align: left; padding: 0.75rem; font-weight: 600;">Name</th>
                        <th style="text-align: left; padding: 0.75rem; font-weight: 600;">Email</th>
                        <th style="text-align: left; padding: 0.75rem; font-weight: 600;">Current Role</th>
                        <th style="text-align: left; padding: 0.75rem; font-weight: 600;">Assign Role</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 0.75rem;">{{ $user->name }}</td>
                            <td style="padding: 0.75rem;">{{ $user->email }}</td>
                            <td style="padding: 0.75rem;">
                                <span class="badge badge-primary">{{ $user->role->name }}</span>
                            </td>
                            <td style="padding: 0.75rem;">
                                <form method="POST" action="{{ route('roles.update', $user->id) }}" style="display: flex; gap: 0.5rem; align-items: center;">
                                    @csrf
                                    @method('PUT')
                                    <select name="role_id" style="padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id === $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm" style="padding: 0.5rem 1rem; background: #667eea; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-size: 0.875rem;">Update</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 1rem; text-align: center; color: #6b7280;">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($users->hasPages())
                <div style="margin-top: 1.5rem; display: flex; justify-content: center; gap: 0.5rem;">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

        <div style="margin-top: 1rem;">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
@endsection
