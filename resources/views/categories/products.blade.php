@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="hero">
        <!-- Left Section: Category Description -->
        <div class="hero-left">
            <h3 class="category">{{ $category->name }}</h3>
            <h1 class="product-title">Explore {{ $category->name }}</h1>
            <p class="product-short-desc">Discover the latest products and offerings in this category.</p>
        </div>

        <!-- Right Section: Category Image -->
        <div class="hero-right">
            <img src="https://fastly.picsum.photos/id/160/200/200.jpg?hmac=0fql9ogVWlCf8ddvQCF-vGiiso9i0m0A68TP5De28tI"
                 alt="{{ $category->name }}" class="w-full h-72 object-cover rounded-lg shadow-md">
        </div>
    </div>

    <!-- Products Section -->
    <div class="section-container">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="product-card group">
                        <img src="{{ $product->imageUrl ?? 'https://via.placeholder.com/200' }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-48 object-cover transition-transform duration-300 ease-in-out group-hover:scale-110">
                        <h4>{{ $product->name }}</h4>
                        <p class="text-gray-700">{{ $product->description }}</p>
                        <p class="text-green-600 font-semibold">${{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn-view mt-2">View Product</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">No products available in this category.</p>
        @endif
    </div>

    <!-- Pagination -->
    <div class="pagination-container mt-8 text-center">
        {{ $products->links() }}
    </div>
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
    }

    @media (min-width: 992px) {
        .hero {
            grid-template-columns: 1.2fr 1fr;
            height: 60vh;
        }
    }

    .hero-left {
        display: flex;
        flex-direction: column;
        justify-content: center;
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

    .hero-right img {
        width: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .section-container {
        padding: 20px 50px;
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
        width: 100%;
        height: 150px;
        object-fit: cover;
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

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

</style>
