@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="bg-white shadow-md rounded px-8 py-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Login to BookRent</h2>

    <form method="POST" action="/login">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-600 mb-2" for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" 
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block text-gray-600 mb-2" for="password">Password</label>
            <input id="password" name="password" type="password" 
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                Login
            </button>
        </div>

        <p class="mt-4 text-center text-gray-500">
            Don't have an account? <a href="/register" class="text-blue-500 hover:underline">Register</a>
        </p>
    </form>
</div>
@endsection