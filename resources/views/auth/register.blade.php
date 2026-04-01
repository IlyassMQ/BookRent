@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="bg-white shadow-md rounded px-8 py-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Register for BookRent</h2>

    <form method="POST" action="/register">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label class="block text-gray-600 mb-2" for="name">Full Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" 
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

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

        <!-- Confirm Password -->
        <div class="mb-4">
            <label class="block text-gray-600 mb-2" for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" 
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <!-- Tags -->
        <div class="mb-4">
            <label class="block text-gray-600 mb-2">Select your interests</label>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <label class="flex items-center gap-1 border px-2 py-1 rounded cursor-pointer hover:bg-blue-50">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                               {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                Register
            </button>
        </div>

        <p class="mt-4 text-center text-gray-500">
            Already have an account? <a href="/login" class="text-blue-500 hover:underline">Login</a>
        </p>
    </form>
</div>
@endsection