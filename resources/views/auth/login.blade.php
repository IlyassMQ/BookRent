@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="space-y-6">

    {{-- TITLE --}}
    <div class="text-center">
        <h2 class="text-2xl font-semibold text-stone-800">
            Welcome back
        </h2>
        <p class="text-sm text-stone-500 mt-1">
            Login to continue to BookRent
        </p>
    </div>

    <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
        @csrf

        {{-- EMAIL --}}
        <div>
            <label class="block text-sm text-stone-600 mb-1">
                Email
            </label>

            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="you@example.com"
                   class="w-full px-3 py-2 rounded-lg border border-stone-300 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 text-sm">

            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- PASSWORD --}}
        <div>
            <label class="block text-sm text-stone-600 mb-1">
                Password
            </label>

            <input type="password"
                   name="password"
                   placeholder="••••••••"
                   class="w-full px-3 py-2 rounded-lg border border-stone-300 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 text-sm">

            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- BUTTON --}}
        <button type="submit"
                class="w-full bg-amber-700 text-white py-2.5 rounded-lg hover:bg-amber-800 transition text-sm font-medium">
            Login
        </button>

    </form>

    {{-- FOOTER --}}
    <p class="text-center text-sm text-stone-500">
        Don’t have an account?
        <a href="{{ route('register') }}"
           class="text-amber-700 hover:underline font-medium">
            Register
        </a>
    </p>

</div>

@endsection