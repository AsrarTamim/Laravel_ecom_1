@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Products</th>
            <th>Categories</th>
            <th>Orders</th>
            <th>Revenue</th>
            <th>Users</th>
        </tr>
        <tr>
            <td>{{ $stats['products'] }}</td>
            <td>{{ $stats['categories'] }}</td>
            <td>{{ $stats['orders'] }}</td>
            <td>${{ number_format($stats['revenue'], 2) }}</td>
            <td>{{ $stats['users'] }}</td>
        </tr>
    </table>

    <h2>Recent Orders</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentOrders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('M j, Y') }}</td>
                    <td>{{ $order->user?->name ?? 'Guest' }}</td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td><a href="{{ route('orders.show', $order->id) }}">View</a></td>
                </tr>
            @empty
                <tr><td colspan="5">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection