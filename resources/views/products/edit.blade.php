@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <h1>Edit Product</h1>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <p>Name<br><input type="text" name="name" value="{{ old('name', $product->name) }}"></p>

        <p>Category<br>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>Description<br><textarea name="description">{{ old('description', $product->description) }}</textarea></p>
        <p>Price<br><input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"></p>
        <p>Stock<br><input type="number" name="stock" value="{{ old('stock', $product->stock) }}"></p>

        <p>
            Current image:<br>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="80">
            @else
                None
            @endif
        </p>
        <p>Change image <br><input type="file" name="image"></p>

        <button type="submit">Update</button>
    </form>
@endsection