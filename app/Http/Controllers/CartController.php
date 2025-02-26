<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $cartItems = auth()->check()
            ? auth()->user()->cart()->with('product')->get() // Get cart items with product details
            : collect(); // Return empty collection for guests

        return view('cart', compact('cartItems'));
    }

    /**
     * Add product to cart
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!auth()->check()) {
            return redirect()->back()->with('error', 'You must be logged in to add items to your cart.');
        }

        $user = auth()->user();

        // Check if product already exists in cart
        $cartItem = $user->cart()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Increment quantity if already in cart
            $cartItem->increment('quantity');
        } else {
            // Add new cart item
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function removeFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if (auth()->id() === $cartItem->user_id) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Product removed from cart.');
    }
}
