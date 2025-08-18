<!DOCTYPE html>
<html>
<head>
    <title>Laravel Products App</title>
    <style>
        nav { background: #f8f8f8; padding:10px; margin-bottom:20px; }
        nav a { margin-right:10px; }
    </style>
</head>
<body>
    <nav>
        @auth
            <span>Welcome, {{ auth()->user()->name }}!</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
            <a href="{{ route('products.index') }}">Products</a>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>

    <div class="container">
        @if(session('success'))
            <div style="color:green">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
