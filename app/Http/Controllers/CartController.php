<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        return view('cart.index', ['products' => $products, 'cart' => $cart]);
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', $product->name . ' added to cart!');
    }
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cart = session('cart', []);

    if (isset($cart[$id])) {
        $cart[$id] = $validated['quantity'];
        session(['cart' => $cart]);
    }

    return redirect()->route('cart.index')->with('success', 'Cart updated!');
}

public function remove($id)
{
    $cart = session('cart', []);

    unset($cart[$id]);
    session(['cart' => $cart]);

    return redirect()->route('cart.index')->with('success', 'Item removed!');
}
}