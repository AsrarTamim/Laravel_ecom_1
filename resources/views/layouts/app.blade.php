<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Shop')</title>
    <style>
        body { font-family: sans-serif; max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
        a { color: #2563eb; text-decoration: none; }
        a:hover { text-decoration: underline; }

        header {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            padding-bottom: 1rem;
            border-bottom: 1px solid #ddd;
            margin-bottom: 1.5rem;
        }
        header .brand { font-size: 1.4rem; font-weight: bold; color: #111; }
        header nav { display: flex; gap: 1rem; flex-wrap: wrap; }
        header .auth { display: flex; align-items: center; gap: 0.75rem; margin-left: auto; }
        header .auth form { margin: 0; }

        .flash { padding: 0.5rem 0; }
        .flash.success { color: #16a34a; }
        .flash.error { color: #dc2626; }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem; }
        .card { border: 1px solid #ddd; border-radius: 8px; padding: 1rem; }
        .price { font-weight: bold; color: #2563eb; }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('products.index') }}" class="brand">My Shop</a>

        <nav>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('cart.index') }}">Cart ({{ array_sum(session('cart', [])) }})</a>

            @auth
                <a href="{{ route('orders.index') }}">My Orders</a>
            @endauth

            @if (auth()->user()?->isAdmin())
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.orders') }}">All Orders</a>
                <a href="{{ route('products.create') }}">Add Product</a>
                <a href="{{ route('categories.index') }}">Categories</a>
            @endif
        </nav>

        <div class="auth">
            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @else
                <span>Hi, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endguest
        </div>
    </header>

    @if (session('success'))
        <p class="flash success">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p class="flash error">{{ session('error') }}</p>
    @endif

    @yield('content')
</body>
</html>