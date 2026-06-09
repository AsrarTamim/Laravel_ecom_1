@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <a href="{{ route('products.index') }}"> Back to products</a>
    <h1>{{ $product->name }}</h1>
    <p>Category: {{ $product->category->name }}</p>
    <p class="price">${{ number_format($product->price, 2) }}</p>
    <p>{{ $product->description }}</p>
    <p>In stock: {{ $product->stock }}</p>
    @if ($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" width="200">
    <form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <button type="submit">Add to cart</button>
</form>
@endif
@endsection