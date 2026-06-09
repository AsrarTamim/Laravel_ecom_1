@extends('layouts.app')

@section('title', 'Our Products')

@section('content')
    <h1>Our Products</h1>
    @if (session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif
    @if (auth()->user()?->isAdmin())
        <a href="{{ route('products.create') }}">Add Product</a>
        <br>
        <a href="{{ route('admin.orders') }}">All Orders</a>
    @endif
    <form method="GET" action="{{ route('products.index') }}">
    <select name="category" onchange="this.form.submit()">
        <option value="">All categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected($selectedCategory == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <button type="submit">Filter</button>
</form>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" width="50">
                        @endif
                    </td>
                    <td><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></td>
                    <td>{{ $product->category->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        @if (auth()->user()?->isAdmin())
                            <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No products found.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection