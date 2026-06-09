@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
    <h1>My Orders</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Date</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('M j, Y') }}</td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td><a href="{{ route('orders.show', $order->id) }}">View</a></td>
                </tr>
            @empty
                <tr><td colspan="4">You haven't placed any orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection