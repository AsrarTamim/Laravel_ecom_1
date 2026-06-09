@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <h1>Checkout</h1>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Order Summary</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        @php $total = 0; @endphp
        @foreach ($products as $product)
            @php
                $qty = $cart[$product->id];
                $subtotal = $product->price * $qty;
                $total += $subtotal;
            @endphp
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $qty }} × ${{ number_format($product->price, 2) }}</td>
                <td>${{ number_format($subtotal, 2) }}</td>
            </tr>
        @endforeach
        <tr><td colspan="2"><strong>Total</strong></td><td><strong>${{ number_format($total, 2) }}</strong></td></tr>
    </table>

    <h2>Your Details</h2>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <p>Name<br><input type="text" name="customer_name" value="{{ old('customer_name') }}"></p>
        <p>Email<br><input type="email" name="customer_email" value="{{ old('customer_email') }}"></p>
        <p>Address<br><textarea name="customer_address">{{ old('customer_address') }}</textarea></p>
        <button type="submit">Place Order</button>
    </form>
@endsection