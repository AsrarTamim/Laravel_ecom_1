@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <h1>Your Cart</h1>

    @if (count($cart) > 0)
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th></tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($products as $product)
                    @php
                        $qty = $cart[$product->id];
                        $subtotal = $product->price * $qty;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.update', $product->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $qty }}" min="1" style="width:60px">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>${{ number_format($subtotal, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Remove this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td colspan="2"><strong>${{ number_format($total, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Your cart is empty.</p>
    @endif
    <a href="{{ route('checkout') }}">Proceed to Checkout</a>
@endsection