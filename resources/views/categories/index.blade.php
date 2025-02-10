@extends('layouts.app')

@section('content')
    <header class="text-center py-6 bg-white shadow-md">
        <h1 class="text-primary font-bold text-4xl">QNET PRODUCTS</h1>
    </header>

    <div class="container mx-auto px-6 py-12">
        <section class="text-center mb-12">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('categories.products', $category->id) }}"
                        class="block relative overflow-hidden rounded-lg shadow-lg bg-white group transform transition-transform duration-300 hover:-translate-y-2">
                        <img src="{{$category->image_url}}"
                            alt="{{ $category->name }}"
                            class="w-full h-48 object-cover transition-transform duration-300 ease-in-out group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-black/50 transition-opacity duration-300 ease-in-out group-hover:bg-black/20">
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3
                                class="text-white text-lg font-bold group-hover:text-primary transition-colors duration-300">
                                {{ $category->name }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <div class="mt-8">
            {{ $categories->links('pagination::tailwind') }}
        </div>
    </div>

    <style>
        :root {
            --primary: #f07021;
        }

        .text-primary {
            color: var(--primary);
        }

        .btn-discover {
            padding: 12px 20px;
            background-color: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
        }

        .btn-discover:hover {
            background-color: var(--primary);
            color: white;
        }

        .group:hover img {
            transform: scale(1.1);
        }

        .group:hover .absolute {
            opacity: 1;
        }

        /* Hover effect to move the card upwards */
        .hover\\:-translate-y-2 {
            transition: transform 0.3s ease;
        }

        .group {
            cursor: pointer;
        }
    </style>
@endsection
