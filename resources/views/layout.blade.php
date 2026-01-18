<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'URL Shortener')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1rem 0;
            color: white;
        }

        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .navbar h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .navbar nav a {
            color: white;
            text-decoration: none;
            margin-left: 2rem;
            transition: opacity 0.3s;
        }

        .navbar nav a:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            flex: 1;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .alert-success {
            background: #10b981;
            color: white;
        }

        .alert-error {
            background: #ef4444;
            color: white;
        }

        .card {
            background: white;
            border-radius: 0.5rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6270;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f3f4f6;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        tr:hover {
            background: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .badge-primary {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .btn-group {
            display: flex;
            gap: 0.5rem;
        }

        footer {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: auto;
        }
    </style>
    @yield('extra-css')
</head>
<body>
    <header>
        <div class="navbar">
            <h1>🔗 URL Shortener</h1>
            <nav>
                @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    @if(auth()->user()->isMember())
                        <a href="{{ route('urls.create') }}">Create URL</a>
                    @endif
                    <a href="{{ route('urls.index') }}">URLs</a>
                    @if(!auth()->user()->isSuperAdmin())
                        <a href="{{ route('invitations.index') }}">Invitations</a>
                    @endif
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-error">{{ $error }}</div>
            @endforeach
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <footer>
        <p>&copy; 2026 URL Shortener. Built with Laravel & ❤️</p>
    </footer>
</body>
</html>
