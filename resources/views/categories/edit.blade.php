<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Add Category</h1>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('categories.update', $category-> id) }}" method="POST">
        @csrf
        @method('PUT')
        <p>Name<br><input type="text" name="name" value="{{ old('name',$category->name) }}"></p>
        <button type="submit">Save</button>
    </form>
</body>
</html>