@extends('layouts.app')

@section('title', 'Our Products')

@section('content')
    <h1>Our Products</h1>

    <form method="GET" action="{{ route('products.index') }}">
    <input type="text" name="search" value="{{ $search }}" placeholder="Search products...">

    <select name="category" onchange="this.form.submit()">
        <option value="">All categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected($selectedCategory == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Search</button>
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

    @if ($products->hasPages())
        <div style="margin-top: 1rem;">
            @if ($products->onFirstPage())
                <span>« Previous</span>
            @else
                <a href="{{ $products->previousPageUrl() }}">« Previous</a>
            @endif

            <span>&nbsp; Page {{ $products->currentPage() }} of {{ $products->lastPage() }} &nbsp;</span>

            @if ($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}">Next »</a>
            @else
                <span>Next »</span>
            @endif
        </div>
    @endif
@endsection

