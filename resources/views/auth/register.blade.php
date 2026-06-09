<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Register</h1>
     @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('register') }}" method="post">
        @csrf
        <p>Name:</p>
        <input type="text" name="name" value="{{ old('name') }}">
        <br>
        <p>Email:</p>
        <input type="email" name="email" value="{{ old('email') }}">
        <br>
        <p>Password:</p>
        <input type="password" name="password">
        <br>
        <p>Confirm Password:</p>
        <input type="password" name="password_confirmation">
        <br>
        <Button type="submit"> Register</Button>


    </form>
</body>
</html>