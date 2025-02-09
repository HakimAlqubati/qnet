@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f5f5f5;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
        }

        .card {
            background-color: #e8f0fe;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            display: block;
            margin: 0 auto 20px auto;
            /* Center the image */
        }

        .card h3 {
            font-size: 20px;
            color: #003a8c;
            margin: 10px 0;
            font-weight: bold;
        }

        .card p {
            color: #555;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .read-more {
            display: inline-block;
            padding: 10px 20px;
            border: 2px solid #003a8c;
            color: #003a8c;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .read-more:hover {
            background-color: #003a8c;
            color: white;
        }
    </style>

    <div class="container">
        @if ($products->count() > 0)
            @foreach ($products as $product)
                <div class="card">
                    <a href="{{ route('products.show', ['product' => $product]) }}">
                        <img src="{{ $product->imageUrl }}" alt="{{ $product->name }}">
                    </a>
                    <h3>{{ $product->name }}</h3>
                    <p>{{ Str::limit($product->description, 70, '...') }}</p>
                    <a href="{{ route('products.show', ['product' => $product]) }}" class="read-more">Read More</a>
                </div>
            @endforeach
        @else
            <p>No products available.</p>
        @endif
    </div>

    <div class="pagination-container" style="text-align: center; margin-top: 20px;">
        {{ $products->links() }}
    </div>
@endsection
