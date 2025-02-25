@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-10">Shopping Cart</h1>
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="p-8 space-y-8">
                        @forelse ($cartItems as $item)
                            <div class="cart-item flex items-center justify-between border-b pb-8 last:border-b-0 last:pb-0">
                                <div class="flex items-center space-x-8">
                                    <img src="{{ $item->product->featured_image }}" alt="{{ $item->product->name }}"
                                        class="w-32 h-32 object-cover rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                                    <div>
                                        <h3 class="text-2xl font-semibold text-gray-900 mb-3">{{ $item->product->name }}
                                        </h3>
                                        <p class="text-base text-gray-600">{{ $item->product->short_description }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-8">
                                    <div class="flex items-center border-2 rounded-lg shadow-sm">
                                        <button class="quantity-button p-3 hover:bg-gray-100"
                                            onclick="updateQuantity({{ $item->id }}, 'decrease')">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" value="{{ $item->quantity }}"
                                            class="quantity-input w-20 text-center border-x-2 py-3 font-medium text-lg"
                                            min="1" readonly>
                                        <button class="quantity-button p-3 hover:bg-gray-100"
                                            onclick="updateQuantity({{ $item->id }}, 'increase')">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-2xl font-bold text-gray-900">
                                        ${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                                    <button
                                        class="delete-button text-red-500 hover:text-red-700 p-3 rounded-full hover:bg-red-50"
                                        onclick="removeItem({{ $item->id }})">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16">
                                <svg class="mx-auto h-20 w-20 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <h3 class="mt-6 text-xl font-medium text-gray-900">Your cart is empty</h3>
                                <p class="mt-3 text-gray-500">Start shopping to add items to your cart.</p>
                                <div class="mt-10">
                                    <a href="{{ route('shop') }}"
                                        class="inline-flex items-center px-8 py-4 text-lg font-medium rounded-xl shadow-md text-white bg-orange-600 hover:bg-orange-700 transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                        Continue Shopping
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- Order Summary -->
            <div class="lg:w-1/3">
                <div class="cart-summary bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="p-10">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8">Order Summary</h2>
                        <div class="space-y-8">
                            <div class="flex justify-between items-center">
                                <p class="text-xl text-gray-600">Subtotal</p>
                                <p class="text-xl font-semibold text-gray-900">${{ number_format($total, 2) }}</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-xl text-gray-600">Shipping</p>
                                <p class="text-xl font-semibold text-gray-900">Calculated at checkout</p>
                            </div>
                            <div class="border-t-2 pt-8">
                                <div class="flex justify-between items-center">
                                    <p class="text-2xl font-bold text-gray-900">Total</p>
                                    <p class="text-2xl font-bold text-gray-900">${{ number_format($total, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .cart-item {
            transition: all 0.4s ease-in-out;
            padding: 1.5rem;
            border-radius: 1rem;
        }

        .cart-item:hover {
            transform: translateY(-4px);
            background-color: rgba(249, 250, 251, 0.8);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .quantity-input::-webkit-inner-spin-button,
        .quantity-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-input {
            -moz-appearance: textfield;
        }

        .quantity-button {
            transition: all 0.3s ease;
        }

        .quantity-button:active {
            transform: scale(0.9);
        }

        .delete-button {
            transition: all 0.3s ease;
        }

        .delete-button:hover {
            transform: rotate(8deg);
        }

        .cart-summary {
            position: sticky;
            top: 2rem;
            z-index: 10;
        }

        @media (max-width: 1024px) {
            .cart-summary {
                position: static;
                margin-top: 2rem;
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        function updateQuantity(itemId, action) {
            fetch(`/cart/update/${itemId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: action
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function removeItem(itemId) {
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                fetch(`/cart/remove/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>
@endpush
