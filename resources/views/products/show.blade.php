@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <a href="{{ route('products.index') }}">&larr; Back to products</a>

    <h1>{{ $product->name }}</h1>
    <p>Category: {{ $product->category->name }}</p>
    <p class="price">${{ number_format($product->price, 2) }}</p>
    <p>{{ $product->description }}</p>
    <p>In stock: {{ $product->stock }}</p>
@endsection