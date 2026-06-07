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

    @yield('content')
</body>
</html>