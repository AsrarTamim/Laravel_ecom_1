<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();

        return view('orders.index', compact('orders'));
    }
    public function create()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        return view('checkout', ['products' => $products, 'cart' => $cart]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_address' => 'required|string',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        $total = 0;
        foreach ($products as $product) {
            $total += $product->price * $cart[$product->id];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_address' => $validated['customer_address'],
            'total' => $total,
        ]);

        foreach ($products as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $product->price,
                'quantity' => $cart[$product->id],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed!');
    }

    public function show($id)
{
    $order = Order::with('items')->findOrFail($id);

    $user = auth()->user();

    $canView = $user?->isAdmin()                 
        || $order->user_id === $user?->id        
        || $order->user_id === null;             

    if (! $canView) {
        abort(403);
    }

    return view('orders.show', compact('order'));
}
    public function adminIndex()
    {
        $orders = Order::with('user')->latest()->get();

        return view('orders.admin', compact('orders'));
    }
}