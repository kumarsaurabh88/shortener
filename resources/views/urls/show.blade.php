@extends('layout')

@section('title', 'Short URL Details')

@section('content')
    <div style="max-width: 700px;">
        <div class="card">
            <h2>Short URL Details</h2>

            <div style="margin-top: 2rem;">
                <div style="background: #f0f4ff; padding: 1.5rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                    <label style="color: #6b7280; font-size: 0.875rem;">Short Link:</label>
                    <div style="display: flex; gap: 1rem; align-items: center; margin-top: 0.5rem;">
                        <code style="flex: 1; background: white; padding: 0.75rem; border-radius: 0.25rem; border: 1px solid #e5e7eb;">
                            {{ config('app.url') }}/s/{{ $shortUrl->short_code }}
                        </code>
                        <button onclick="copyToClipboard('{{ config('app.url') }}/s/{{ $shortUrl->short_code }}')" 
                                class="btn btn-primary" style="white-space: nowrap;">
                            📋 Copy
                        </button>
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="color: #6b7280; font-size: 0.875rem;">Original URL:</label>
                    <div style="margin-top: 0.5rem;">
                        <a href="{{ $shortUrl->original_url }}" target="_blank" 
                           style="color: #667eea; word-break: break-all;">
                            {{ $shortUrl->original_url }}
                        </a>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                    <div style="background: #f9fafb; padding: 1rem; border-radius: 0.5rem;">
                        <div style="color: #6b7280; font-size: 0.875rem;">Total Clicks</div>
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea; margin-top: 0.5rem;">
                            {{ $shortUrl->clicks }}
                        </div>
                    </div>

                    <div style="background: #f9fafb; padding: 1rem; border-radius: 0.5rem;">
                        <div style="color: #6b7280; font-size: 0.875rem;">Created By</div>
                        <div style="font-weight: 500; margin-top: 0.5rem;">{{ $shortUrl->creator->name }}</div>
                    </div>

                    <div style="background: #f9fafb; padding: 1rem; border-radius: 0.5rem;">
                        <div style="color: #6b7280; font-size: 0.875rem;">Created On</div>
                        <div style="font-weight: 500; margin-top: 0.5rem;">{{ $shortUrl->created_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                @if($shortUrl->created_by === auth()->user()->id)
                    <form method="POST" action="{{ route('urls.destroy', $shortUrl) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                            🗑️ Delete URL
                        </button>
                    </form>
                @endif
                <a href="{{ route('urls.index') }}" class="btn btn-secondary">← Back to URLs</a>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Copied to clipboard!');
            });
        }
    </script>
@endsection
