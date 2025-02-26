<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check() || auth()->user()->cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Create Order
        $order = Order::create([
            'customer_id' => auth()->id(),
            'order_date' => now(),
            'total_amount' => auth()->user()->cart->sum(fn($item) => $item->price * $item->quantity),
            'payment_status' => 'pending',
            'shipping_status' => 'processing',
            // 'status' => 'pending',
        ]);

        // Save Order Items
        foreach (auth()->user()->cart as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
            ]);
        }

        // Clear the Cart
        auth()->user()->cart()->delete();

        return redirect()->route('cart.index')->with('success', 'Order placed successfully!');
    }
}
