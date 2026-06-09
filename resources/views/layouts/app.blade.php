<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'My Shop')</title>
    <style>
        body { font-family: sans-serif; max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
        a { color: #2563eb; text-decoration: none; }
        header { margin-bottom: 1.5rem; }
        header a { font-size: 1.5rem; font-weight: bold; color: #111; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem; }
        .card { border: 1px solid #ddd; border-radius: 8px; padding: 1rem; }
        .price { font-weight: bold; color: #2563eb; }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('products.index') }}">My Shop</a>

    </header>
            @if (auth()->user()?->isAdmin())
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    @endif
    <br>
    @guest
        <a href="{{ route('login') }}">Login</a> <br>
        <a href="{{ route('register') }}">Register</a> <br>
    @else
        <span>Hi, {{ auth()->user()->name }}</span>
        <form action="{{ route('logout') }}" method="post" style="display:inline">
            @csrf
            <button type="submit">Logout</button> <br>
        </form>
        <a href="{{ route('orders.index') }}">My Orders</a>
    @endguest
    <a href="{{ route('cart.index') }}">Cart ({{ array_sum(session('cart', [])) }})</a>

    @yield('content')
</body>
</html>