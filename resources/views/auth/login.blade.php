@extends('layouts.app')

@section('content')
    <div class="min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-4 text-sm text-gray-600">
                {{-- {{ __('Please sign in to access the admin panel.') }} --}}
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label class="block font-medium text-sm text-gray-700" for="email">
                        {{ __('Email') }}
                    </label>
                    <input
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                        id="email" type="email" name="email" required="required" autofocus="autofocus">
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="password">
                        {{ __('Password') }}
                    </label>
                    <input
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                        id="password" type="password" name="password" required="required" autocomplete="current-password">
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <input type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            id="remember_me" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                        {{ __('Log in') }}
                    </button>
                </div>

                <a href="/forgot-password" class="underline text-sm text-gray-600 hover:text-gray-900">Forgot password?</a>
            </form>

            {{-- Demo Credentials Section --}}
            {{-- <div class="mt-6 p-4 bg-gray-100 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Demo Credentials</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div class="border p-4 rounded bg-white shadow-sm">
                        <h4 class="font-bold text-gray-800">Admin</h4>
                        <div class="mt-2">
                            <span class="block text-sm text-gray-600 font-mono">admin@example.com</span>
                        </div>
                        <div class="mt-2">
                            <span class="block text-sm text-gray-600 font-mono">password</span>
                        </div>
                    </div>

                    <div class="border p-4 rounded bg-white shadow-sm">
                        <h4 class="font-bold text-gray-800">Staff</h4>
                        <div class="mt-2">
                            <span class="block text-sm text-gray-600 font-mono">staff@example.com</span>
                        </div>
                        <div class="mt-2">

                            <span class="block text-sm text-gray-600 font-mono">password</span>
                        </div>
                    </div>
                </div>
            </div> --}}



        </div>
    </div>
@endsection
