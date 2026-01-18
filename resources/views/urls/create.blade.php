@extends('layout')

@section('title', 'Create Short URL')

@section('content')
    <div style="max-width: 600px;">
        <div class="card">
            <h2>Create Short URL</h2>
            <p style="color: #6b7280; margin-bottom: 1.5rem;">Enter a long URL to create a short link</p>

            <form method="POST" action="{{ route('urls.store') }}">
                @csrf

                <div class="form-group">
                    <label for="original_url">Original URL *</label>
                    <input type="url" id="original_url" name="original_url" 
                           placeholder="https://example.com/very/long/url" 
                           value="{{ old('original_url') }}" required>
                    @error('original_url')
                        <div style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary">Create Short URL</button>
                    <a href="{{ route('urls.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

        <div class="card" style="background: #f9fafb; border-left: 4px solid #667eea;">
            <h4 style="margin-bottom: 1rem;">💡 Tips:</h4>
            <ul style="margin-left: 1.5rem; color: #6b7280;">
                <li>Make sure the URL starts with http:// or https://</li>
                <li>You can share your short links with anyone</li>
                <li>Short URLs are not publicly discoverable</li>
                <li>You can delete URLs anytime</li>
            </ul>
        </div>
    </div>
@endsection
