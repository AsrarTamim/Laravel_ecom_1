@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('content')
    <h1>Thank you for your order!</h1>
    <p>Order #{{ $order->id }}</p>
    <p>{{ $order->customer_name }} — {{ $order->customer_email }}</p>
    <p>{{ $order->customer_address }}</p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total: ${{ number_format($order->total, 2) }}</strong></p>
@endsection