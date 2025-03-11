@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100" style="min-height: 74vh;">
        <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-lg rounded-lg">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('storage/logo/logo.svg') }}" alt="Logo" class="h-16">
            </div>

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('custom.login') }}">
                @csrf

                <!-- Identify ID Field -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="identify_id">
                        {{ __('Your ID') }}
                    </label>
                    <input
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                        id="identify_id" type="text" name="identify_id" required autofocus>
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="password">
                        {{ __('Password') }}
                    </label>
                    <input
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                        id="password" type="password" name="password" required autocomplete="current-password">
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full px-4 py-2 text-white font-semibold rounded-lg transition bg-gradient-to-r from-indigo-500 to-indigo-700 hover:from-indigo-600 hover:to-indigo-800 focus:ring-4 focus:ring-indigo-300"
                    style="background: orange;width: 100%;">
                    <span style="width: 100%;text-align: center;">{{ __('Log in') }}</span>
                </button>
            </form>
        </div>
    </div>
@endsection
