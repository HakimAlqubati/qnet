@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Create User</h1>

        <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
            @csrf

            <!-- Parent -->
            <div class="mb-6">
                <label for="parent_id" class="block text-gray-800 font-semibold">Parent</label>
                <input type="text" id="parent_id" name="parent_id" value="{{ old('parent_id') }}" 
                       class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                @error('parent_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- Full Name -->
            <div class="mb-6">
                <label for="name" class="block text-gray-800 font-semibold">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                       class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-gray-800 font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                       class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-800 font-semibold">Password</label>
                <input type="password" id="password" name="password" 
                       class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div> --}}

            {{-- <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-800 font-semibold">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                       class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
            </div> --}}

            <!-- Phone Number -->
            <div class="mb-6">
                <label for="phonenumber" class="block text-gray-800 font-semibold">Phone Number</label>
                <input type="text" id="phonenumber" name="phonenumber" value="{{ old('phonenumber') }}" 
                       class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                @error('phonenumber')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

           

            <!-- Country -->
            <div class="mb-6">
                <label for="country_id" class="block text-gray-800 font-semibold">Country</label>
                <select id="country_id" name="country_id" 
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]" 
                        onchange="updateCities()">
                    <option value="">Select a country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" 
                                {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('country_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- City -->
            <div class="mb-6">
                <label for="city_id" class="block text-gray-800 font-semibold">City</label>
                <select id="city_id" name="city_id" 
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                    <option value="">Select a city</option>
                </select>
                @error('city_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Address -->
            <div class="mb-6">
                <label for="address" class="block text-gray-800 font-semibold">Address</label>
                <textarea id="address" name="address" 
                          class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">{{ old('address') }}</textarea>
                @error('address')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- <!-- Rank -->
            <div class="mb-6">
                <label for="rank_id" class="block text-gray-800 font-semibold">Rank</label>
                <select id="rank_id" name="rank_id" 
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                    <option value="">Select a rank</option>
                </select>
                @error('rank_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div> --}}

            <!-- Submit Button -->
            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-[#f07021] text-white px-6 py-3 rounded-lg hover:bg-[#e0561b] orange-bg">
                    Create User
                </button>
            </div>
        </form>
    </div>

    <script>
        function updateCities() {
            const countryId = document.getElementById('country_id').value;
            const citySelect = document.getElementById('city_id');
            citySelect.innerHTML = '<option value="">Loading cities...</option>';

            fetch(`/api/countries/${countryId}/cities`)
                .then(response => response.json())
                .then(cities => {
                    citySelect.innerHTML = '<option value="">Select a city</option>';
                    cities.forEach(city => {
                        citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                    });
                })
                .catch(() => {
                    citySelect.innerHTML = '<option value="">Error loading cities</option>';
                });
        }
    </script>
@endsection

<style>
    body {
        background-color: #f9fafb;
        font-family: 'Poppins', Arial, sans-serif;
    }

    .w-full {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .rounded-lg {
        transition: background-color 0.3s;
    }

    .orange-bg {
        background: orange !important;
    }
</style>
