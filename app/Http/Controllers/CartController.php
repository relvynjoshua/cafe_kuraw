<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('frontend.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Session::get('cart', []);
        $cart[$request->item_id] = [
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ];
        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Session::get('cart', []);
        if (isset($cart[$request->item_id])) {
            $cart[$request->item_id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove(Request $request)
    {
        $request->validate(['item_id' => 'required|integer']);

        $cart = Session::get('cart', []);
        unset($cart[$request->item_id]);
        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}
