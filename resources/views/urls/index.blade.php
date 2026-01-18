@extends('layout')

@section('title', 'Short URLs')

@section('content')
    <div class="card">
        <h2 style="margin-bottom: 1rem;">Short URLs</h2>

        @if($shortUrls->isEmpty())
            <div style="text-align: center; padding: 2rem; color: #6b7280;">
                <p style="font-size: 3rem; margin-bottom: 1rem;">📭</p>
                <p>No short URLs to display</p>
                @if(auth()->user()->isMember())
                    <a href="{{ route('urls.create') }}" class="btn btn-primary" style="margin-top: 1rem;">Create one now</a>
                @endif
            </div>
        @else
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Short Code</th>
                            <th>Original URL</th>
                            <th>Created By</th>
                            <th>Clicks</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shortUrls as $url)
                            <tr>
                                <td>
                                    <code style="background: #f0f4ff; padding: 0.25rem 0.5rem; border-radius: 0.25rem;">
                                        {{ $url->short_code }}
                                    </code>
                                </td>
                                <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <a href="{{ $url->original_url }}" target="_blank" title="{{ $url->original_url }}">
                                        {{ $url->original_url }}
                                    </a>
                                </td>
                                <td>{{ $url->creator->name }}</td>
                                <td>
                                    <span class="badge badge-success">{{ $url->clicks }}</span>
                                </td>
                                <td>{{ $url->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('urls.show', $url) }}" class="btn btn-secondary" style="font-size: 0.875rem;">View</a>
                                        @if($url->created_by === auth()->user()->id)
                                            <form method="POST" action="{{ route('urls.destroy', $url) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="font-size: 0.875rem;" 
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 2rem;">
                {{ $shortUrls->links() }}
            </div>
        @endif
    </div>

    @if(auth()->user()->isMember())
        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <a href="{{ route('urls.create') }}" class="btn btn-primary">+ Create New URL</a>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    @endif
@endsection
