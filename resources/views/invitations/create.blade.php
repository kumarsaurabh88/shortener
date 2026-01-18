@extends('layout')

@section('title', 'Invite User')

@section('content')
    <div style="max-width: 600px;">
        <div class="card">
            <h2>Invite User</h2>
            <p style="color: #6b7280; margin-bottom: 1.5rem;">
                @if(auth()->user()->isSuperAdmin())
                    Invite a new Admin to join the platform
                @else
                    Invite a new Member to join your company
                @endif
            </p>

            <form method="POST" action="{{ route('invitations.store') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" 
                           placeholder="user@example.com" 
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Role *</label>
                    <select id="role" name="role" required>
                        <option value="">Select a role...</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" @selected(old('role') === $role->name)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <div style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary">Send Invitation</button>
                    <a href="{{ route('invitations.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

        <div class="card" style="background: #f9fafb; border-left: 4px solid #667eea;">
            <h4 style="margin-bottom: 1rem;">📝 How it works:</h4>
            <ol style="margin-left: 1.5rem; color: #6b7280;">
                <li>Enter the email of the person you want to invite</li>
                <li>Select their role in the organization</li>
                <li>They'll receive an invitation email</li>
                <li>Once they accept, their account will be created</li>
            </ol>
        </div>
    </div>
@endsection
