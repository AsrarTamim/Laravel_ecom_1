@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
    <h1>Add Product</h1>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <p>Name<br><input type="text" name="name" value="{{ old('name') }}"></p>

        <p>Category<br>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>Description<br><textarea name="description">{{ old('description') }}</textarea></p>
        <p>Price<br><input type="number" step="0.01" name="price" value="{{ old('price') }}"></p>
        <p>Stock<br><input type="number" name="stock" value="{{ old('stock') }}"></p>

        <button type="submit">Save</button>
    </form>
@endsection