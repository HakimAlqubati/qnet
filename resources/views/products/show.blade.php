@extends('layouts.app')

@section('content')
    <div class="hero">
        <!-- Left Section: Product Description -->
        <div class="hero-left">
            <h3 class="category">{{ $product->category->name ?? 'Category' }}</h3>
            <h1 class="product-title">{{ $product->name }}</h1>
            <p class="product-short-desc">{{ $product->short_description ?? 'No short description available.' }}</p>
        </div>

        <!-- Right Section: Product Image -->
        <div class="hero-right">
            <img src="{{ $product->imageUrl }}" alt="{{ $product->name }}">
        </div>
    </div>

    <!-- Accordion Section -->
    <div class="section-container">
        <div class="details">
            <div class="accordion">
                <h3 onclick="toggleAccordion(this)">Description</h3>
                <div class="accordion-content">
                    <p>{{ $product->long_description ?? 'No long description available.' }}</p>
                </div>
            </div>

            <div class="accordion">
                <h3 onclick="toggleAccordion(this)">Price & Stock</h3>
                <div class="accordion-content">
                    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p><strong>Inventory Count:</strong> {{ $product->inventory_count }}</p>
                    <p class="{{ $product->inventory_count > 0 ? 'in-stock' : 'out-stock' }}">
                        {{ $product->inventory_count > 0 ? 'In Stock' : 'Out of Stock' }}
                    </p>
                </div>
            </div>
            <div class="accordion">
                <h3 onclick="toggleAccordion(this)">Cart</h3>
                <div class="accordion-content">
                    @php
                        $cartItem = auth()->check()
                            ? \App\Models\CartItem::where('user_id', auth()->id())
                                ->where('product_id', $product->id)
                                ->exists()
                            : \App\Models\CartItem::where('session_id', session()->getId())
                                ->where('product_id', $product->id)
                                ->exists();
                    @endphp

                    @if ($cartItem)
                        <!-- Product is already in cart -->
                        <button class="btn-in-cart" disabled>✅ In Cart</button>
                    @else
                        <!-- Add to Cart Form -->
                        <form action="{{ route('cart.add') }}" method="POST" class="cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn-cart">🛒 Add to Cart</button>
                        </form>
                    @endif
                </div>
            </div>


            @if (isset($recommendations) && count($recommendations) > 0)
                <div class="accordion">
                    <h3 onclick="toggleAccordion(this)">Recommended Products</h3>
                    <div class="accordion-content">
                        <div class="recommended-products">
                            @foreach ($recommendations as $recommendedProduct)
                                <div class="product-card">
                                    <img src="{{ $recommendedProduct->imageUrl ?? '/images/placeholder.png' }}"
                                        alt="{{ $recommendedProduct->name }}">
                                    <h4>{{ $recommendedProduct->name }}</h4>
                                    <p>${{ number_format($recommendedProduct->price, 2) }}</p>
                                    <a href="{{ route('products.show', $recommendedProduct->id) }}" class="btn-view">View
                                        Product</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function toggleAccordion(element) {
            element.classList.toggle('active');
            element.nextElementSibling.classList.toggle('active');
        }
    </script>
@endsection

<style>
    body {
        font-family: 'Poppins', Arial, sans-serif;
        background-color: #f4f4f9;
        color: #333;
        line-height: 1.6;
        margin: 0;
    }

    .hero {
        display: grid;
        grid-template-columns: 1fr;
        background-color: #1e3a34;
        color: white;
        padding: 50px;
        align-items: center;
        justify-content: center;
        text-align: left;
        position: relative;
    }

    @media (min-width: 992px) {
        .hero {
            grid-template-columns: 1fr 1fr;
            /* Two columns */
            height: 60vh;
        }
    }

    .hero-left {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px;
    }

    .hero-right {
        /* display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden; */
    }

    /* Ensure the image fits properly */
    .hero-right img {
        height: 100%;
        /* max-width: 100%; */
        /* height: auto; */
        /* max-height: 300px; */
        /* Limit height */
        /* object-fit: contain; */
        /* Prevent cropping */
        /* border-radius: 10px; */
    }

    .category {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #ffcb05;
        text-transform: uppercase;
    }

    .product-title {
        font-size: 48px;
        font-weight: 700;
        margin: 0;
    }

    .product-short-desc {
        font-size: 18px;
        margin: 20px 0;
        color: #d3d3d3;
    }

    .section-container {
        padding: 20px 50px;
    }

    .accordion {
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
    }

    .accordion h3 {
        background-color: #e3e3e3;
        padding: 15px;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
    }

    .accordion h3::after {
        content: "+";
        font-size: 20px;
        transition: transform 0.3s ease;
    }

    .accordion h3.active::after {
        transform: rotate(45deg);
    }

    .accordion-content {
        display: none;
        padding: 15px;
        background-color: #ffffff;
    }

    .accordion-content.active {
        display: block;
    }

    .in-stock {
        color: #28a745;
    }

    .out-stock {
        color: #dc3545;
    }

    .recommended-products {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .product-card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        padding: 15px;
        text-align: center;
        border-radius: 8px;
        transition: box-shadow 0.3s ease;
    }

    .product-card:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .product-card img {
        width: 100px;
        height: auto;
        margin-bottom: 10px;
    }

    .product-card h4 {
        font-size: 18px;
        margin: 10px 0;
        color: #1b491e;
    }

    .btn-view {
        display: inline-block;
        padding: 8px 16px;
        background-color: #1e3a34;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-view:hover {
        background-color: #145a40;
    }

    /* Floating "Add to Cart" Button */
    .btn-cart {
        position: relative;
        padding: 12px 18px;
        background-color: #ff6600;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 50px;
        font-size: 16px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease, transform 0.2s ease-in-out;
    }

    .btn-cart i {
        margin-right: 5px;
    }

    .btn-cart:hover {
        background-color: #e65c00;
        transform: scale(1.05);
    }

    /* Disabled Button for Out of Stock */
    .btn-out-of-stock {
        padding: 12px 18px;
        background-color: #ccc;
        color: white;
        border: none;
        cursor: not-allowed;
        border-radius: 50px;
        font-size: 16px;
        font-weight: bold;
    }
</style>
