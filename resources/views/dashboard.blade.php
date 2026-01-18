@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <div>
        <div class="card">
            <h2>Welcome, {{ auth()->user()->name }}! 👋</h2>
            <p style="color: #6b7280; margin-top: 0.5rem;">
                Role: <span class="badge badge-primary">{{ auth()->user()->role->name }}</span>
                @if(auth()->user()->company)
                    | Company: <strong>{{ auth()->user()->company->name }}</strong>
                @endif
            </p>
        </div>

        @if(auth()->user()->isSuperAdmin())
            <div class="card">
                <h3>SuperAdmin Dashboard</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    As a SuperAdmin, you can:
                </p>
                <ul style="margin-left: 1.5rem; color: #374151;">
                    <li>Invite new Admins to companies</li>
                    <li>Manage all invitations</li>
                    <li>View system statistics</li>
                </ul>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 1.5rem;">
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;">-</div>
                        <div style="color: #6b7280; font-size: 0.875rem;">Total Companies</div>
                    </div>
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;">-</div>
                        <div style="color: #6b7280; font-size: 0.875rem;">Total Users</div>
                    </div>
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;">-</div>
                        <div style="color: #6b7280; font-size: 0.875rem;">Total URLs</div>
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->isAdmin())
            <div class="card">
                <h3>Admin Dashboard</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    As an Admin, you can:
                </p>
                <ul style="margin-left: 1.5rem; color: #374151;">
                    <li>View short URLs from other companies</li>
                    <li>Invite Members to your company</li>
                    <li>Manage company invitations</li>
                </ul>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-top: 1.5rem;">
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;">{{ $stats['company_urls'] ?? 0 }}</div>
                        <div style="color: #6b7280; font-size: 0.875rem;">Your Company URLs</div>
                    </div>
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;">{{ $shortUrls->count() }}</div>
                        <div style="color: #6b7280; font-size: 0.875rem;">URLs from Other Companies</div>
                    </div>
                </div>
            </div>
        @else
            <div class="card">
                <h3>Member Dashboard</h3>
                <p style="color: #6b7280; margin: 1rem 0;">
                    As a Member, you can:
                </p>
                <ul style="margin-left: 1.5rem; color: #374151;">
                    <li>Create and manage your own short URLs</li>
                    <li>View short URLs created by other members</li>
                    <li>Track URL statistics</li>
                </ul>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-top: 1.5rem;">
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;">{{ $stats['my_urls'] ?? 0 }}</div>
                        <div style="color: #6b7280; font-size: 0.875rem;">My URLs</div>
                    </div>
                    <div style="background: #f0f4ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;">{{ $shortUrls->count() }}</div>
                        <div style="color: #6b7280; font-size: 0.875rem;">Other URLs</div>
                    </div>
                </div>
            </div>
        @endif

        <div class="card">
            <h3>Quick Actions</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem;">
                @if(auth()->user()->isSuperAdmin())
                    <a href="{{ route('roles.index') }}" class="btn btn-primary">👥 Manage Roles</a>
                @elseif(auth()->user()->isMember())
                    <a href="{{ route('urls.create') }}" class="btn btn-primary">+ Create Short URL</a>
                @endif
                <a href="{{ route('urls.index') }}" class="btn btn-secondary">View All URLs</a>
                @if(!auth()->user()->isSuperAdmin())
                    <a href="{{ route('invitations.create') }}" class="btn btn-secondary">Invite User</a>
                    <a href="{{ route('invitations.index') }}" class="btn btn-secondary">Manage Invitations</a>
                @endif
            </div>
        </div>
    </div>
@endsection
