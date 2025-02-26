<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\ShippingMethod;
use App\Services\ShippingService;
use App\Services\PaymentGatewayService;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\InventoryLog;
use App\Models\User;
use App\Notifications\LowStockNotification;
use Illuminate\Support\Facades\Notification;
use App\Factories\PaymentGatewayFactory;

class CheckoutController extends Controller
{
    protected $shippingService;

    public function __construct(ShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    public function initiateCheckout(Request $request)
    {
        $isGuest = Session::get('is_guest', false);
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty');
        }

        // $shippingMethods = $this->shippingService->getAvailableShippingMethods();

        return view('checkout.checkout', [
            'cart' => $cart,
            'shippingMethods' => [],
            'isGuest' => $isGuest
        ]);
    }

    public function processCheckout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'shipping_address' => 'required|string',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'payment_method' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty');
        }

        // Calculate total amount
        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        $shippingMethod = ShippingMethod::find($request->shipping_method_id);
        $totalAmount = $subtotal + $shippingMethod->price;

        // Create order
        $order = Order::create([
            'customer_email' => $request->email,
            'shipping_address' => $request->shipping_address,
            'shipping_method_id' => $request->shipping_method_id,
            'payment_method' => $request->payment_method,
            'total_amount' => $totalAmount,
            'status' => 'pending'
        ]);

        // Process payment
        $paymentResult = $this->processPayment($order, $request->payment_method);

        if ($paymentResult['success']) {
            $order->update(['status' => 'paid']);
            
            // Clear cart
            Session::forget('cart');
            
            return redirect()->route('checkout.confirmation', ['order' => $order->id])
                ->with('success', 'Order placed successfully!');
        }

        $order->update(['status' => 'failed']);
        return redirect()->back()
            ->with('error', 'Payment failed. Please try again.');
    }

    public function showConfirmation(Order $order)
    {
        return view('checkout.confirmation', [
            'order' => $order
        ]);
    }

    public function guestCheckout(Request $request)
    {
        $cart = Session::get('cart', []);
        
        // Store cart in guest session
        Session::put('guest_cart', $cart);
        Session::put('is_guest', true);

        return redirect()->route('checkout.initiate');
    }

    protected function processPayment($order, $paymentMethod)
    {
        $paymentGateway = PaymentGatewayFactory::create($paymentMethod);
        return $paymentGateway->processPayment($order->total_amount, [
            'order_id' => $order->id,
            'customer_email' => $order->customer_email
        ]);
    }
}
