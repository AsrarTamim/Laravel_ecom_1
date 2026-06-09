@extends('layouts.app')

@section('title', 'All Orders')

@section('content')
    <h1>All Orders</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Date</th>
                <th>Customer (typed)</th>
                <th>Account</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('M j, Y') }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->user?->name ?? 'Guest' }}</td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td><a href="{{ route('orders.show', $order->id) }}">View</a></td>
                </tr>
            @empty
                <tr><td colspan="6">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection