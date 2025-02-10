@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Create User</h1>

        <!-- Step Header -->
        <div class="flex justify-between mb-6">
            <div id="step1Header" class="px-4 py-2 bg-[#f07021] text-white rounded-lg shadow-md orange-bg">Step 1: Basic Info</div>
            <div id="step2Header" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg shadow-md">Step 2: Additional Info</div>
        </div>

        <!-- Step 1 Form -->
        <form id="step1" class="space-y-6">
            @csrf
            <div class="mb-6">
                <label for="name" class="block text-gray-800 font-semibold">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-800 font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-800 font-semibold">Password</label>
                <input type="password" id="password" name="password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-800 font-semibold">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
            </div>

            <div class="mt-8 flex justify-end">
                <button type="button" class="bg-[#f07021] text-white px-6 py-3 rounded-lg hover:bg-[#e0561b] orange-bg" onclick="goToStep(2)">Next</button>
            </div>
        </form>

        <!-- Step 2 Form -->
        <form id="step2" class="hidden space-y-6" method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-6">
                <label for="phonenumber" class="block text-gray-800 font-semibold">Phone Number</label>
                <input type="text" id="phonenumber" name="phonenumber" value="{{ old('phonenumber') }}" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                @error('phonenumber')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="user_type" class="block text-gray-800 font-semibold">User Type</label>
                <select id="user_type" name="user_type" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                    <option value="">Select a user type</option>
                    <option value="customer" {{ old('user_type') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('user_type')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="country_id" class="block text-gray-800 font-semibold">Country</label>
                <select id="country_id" name="country_id" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]" onchange="updateCities()">
                    <option value="">Select a country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('country_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="city_id" class="block text-gray-800 font-semibold">City</label>
                <select id="city_id" name="city_id" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                    <option value="">Select a city</option>
                </select>
                @error('city_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="address" class="block text-gray-800 font-semibold">Address</label>
                <textarea id="address" name="address" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">{{ old('address') }}</textarea>
                @error('address')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="rank_id" class="block text-gray-800 font-semibold">Rank</label>
                <select id="rank_id" name="rank_id" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#f07021]">
                    <option value="">Select a rank</option>
                </select>
                @error('rank_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-8 flex justify-between">
                <button type="button" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 orange-bg" onclick="goToStep(1)">Back</button>
                <button type="submit" class="bg-[#f07021] text-white px-6 py-3 rounded-lg hover:bg-[#e0561b] orange-bg">Create User</button>
            </div>
        </form>
    </div>

    <script>
        function goToStep(step) {
            // Show/hide forms
            document.getElementById('step1').classList.toggle('hidden', step !== 1);
            document.getElementById('step2').classList.toggle('hidden', step !== 2);

            // Update step header styles
            document.getElementById('step1Header').classList.toggle('bg-[#f07021]', step === 1);
            document.getElementById('step1Header').classList.toggle('text-white', step === 1);
            document.getElementById('step2Header').classList.toggle('bg-[#f07021]', step === 2);
            document.getElementById('step2Header').classList.toggle('text-white', step === 2);
        }

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
    .orange-bg{
        background: orange !important;
    }
</style>
