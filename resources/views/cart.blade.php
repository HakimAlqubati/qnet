@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <h2 class="text-2xl font-semibold mb-4">Your Shopping Cart</h2>

        <!-- Cart Listing -->
        <div class="space-y-4">
            @if ($cartItems->count() > 0)
                @foreach ($cartItems as $item)
                    <div class="bg-white shadow-md rounded-lg p-4 flex flex-col md:flex-row items-center md:items-start">
                        <!-- Product Image -->
                        <div class="w-full md:w-1/4">
                            <img style="max-width: 40%;"
                                src="{{ $item->product->imageUrl ?? 'https://via.placeholder.com/150' }}"
                                alt="{{ $item->product->name }}" class="w-full rounded-lg object-cover">
                        </div>

                        <!-- Product Details -->
                        <div class="w-full md:w-3/4 px-4 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-xl font-bold text-orange-500">USD {{ number_format($item->price, 2) }}</p>
                                <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                            </div>

                            <!-- Remove from Cart -->
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-sm hover:underline">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <!-- Order Form -->
                <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                    <h3 class="text-xl font-semibold mb-4">Checkout</h3>
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="customer_email" value="{{ auth()->user()->email }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-gray-700">Full Name</label>
                                <input type="text" value="{{ auth()->user()->name }}" disabled
                                    class="w-full p-2 border rounded-md bg-gray-100">
                            </div>
                            <div>
                                <label class="block font-medium text-gray-700">Email</label>
                                <input type="email" value="{{ auth()->user()->email }}" disabled
                                    class="w-full p-2 border rounded-md bg-gray-100">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-orange-500 text-white py-2 rounded-md mt-4 hover:bg-orange-600">
                            Place Order
                        </button>
                    </form>
                </div>
            @else
                <p class="text-center text-gray-500">Your cart is empty.</p>
            @endif
        </div>
    </div>

@endsection

<style>
    /* Container */
    .container {
        max-width: 1100px;
    }

    /* Cart Items */
    .bg-white {
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: box-shadow 0.3s ease-in-out;
    }

    .bg-white:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Product Image */


    /* Remove Button */
    button.text-red-500 {
        transition: color 0.3s ease-in-out;
    }

    button.text-red-500:hover {
        color: darkred;
    }
</style>
