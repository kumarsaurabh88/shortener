@extends('layout')

@section('title', 'Manage Invitations')

@section('content')
    <div class="card">
        <h2 style="margin-bottom: 1rem;">Manage Invitations</h2>

        <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
            <a href="{{ route('invitations.create') }}" class="btn btn-primary">+ Send Invitation</a>
        </div>

        @if($invitations->isEmpty())
            <div style="text-align: center; padding: 2rem; color: #6b7280;">
                <p style="font-size: 3rem; margin-bottom: 1rem;">📧</p>
                <p>No invitations yet</p>
            </div>
        @else
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Invited By</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invitations as $invitation)
                            <tr>
                                <td>{{ $invitation->email }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $invitation->role->name }}</span>
                                </td>
                                <td>{{ $invitation->invitedBy->name }}</td>
                                <td>
                                    @if($invitation->isAccepted())
                                        <span class="badge badge-success">✓ Accepted</span>
                                    @else
                                        <span class="badge badge-warning">⏳ Pending</span>
                                    @endif
                                </td>
                                <td>{{ $invitation->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 2rem;">
                {{ $invitations->links() }}
            </div>
        @endif
    </div>

    <div class="card" style="background: #f9fafb; border-left: 4px solid #667eea; margin-top: 1rem;">
        <h4 style="margin-bottom: 1rem;">📋 Invitation Rules:</h4>
        <ul style="margin-left: 1.5rem; color: #6b7280; font-size: 0.875rem;">
            @if(auth()->user()->isSuperAdmin())
                <li>SuperAdmin can only invite Admins to new companies</li>
            @else
                <li>Admin can only invite Members to their company</li>
                <li>Member cannot invite anyone</li>
            @endif
            <li>Invitations are sent via email</li>
            <li>Invitations expire after a certain period</li>
            <li>Users cannot register directly for admin roles</li>
        </ul>
    </div>
@endsection
