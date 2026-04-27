@extends('layouts.auth')

@section('title', 'Register')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="text-center">
        <h2 class="text-2xl font-semibold text-stone-800">
            Create your account
        </h2>
        <p class="text-sm text-stone-500 mt-1">
            Join BookRent and start exploring books
        </p>
    </div>

    <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
        @csrf

        {{-- NAME --}}
        <div>
            <label class="block text-sm text-stone-600 mb-1">Full Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   placeholder="John Doe"
                   class="w-full px-3 py-2 rounded-lg border border-stone-300 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 text-sm">

            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block text-sm text-stone-600 mb-1">Email</label>
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
            <label class="block text-sm text-stone-600 mb-1">Password</label>
            <input type="password"
                   name="password"
                   placeholder="••••••••"
                   class="w-full px-3 py-2 rounded-lg border border-stone-300 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 text-sm">

            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- CONFIRM --}}
        <div>
            <label class="block text-sm text-stone-600 mb-1">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   placeholder="••••••••"
                   class="w-full px-3 py-2 rounded-lg border border-stone-300 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 text-sm">
        </div>

        {{-- TAGS --}}
        <div>
            <label class="block text-sm text-stone-600 mb-2">
                Your interests
            </label>

            <div class="flex flex-wrap gap-2">

                @foreach($tags as $tag)
                    <label class="flex items-center gap-2 px-3 py-1.5 border border-stone-300 rounded-full text-xs cursor-pointer
                                  hover:bg-amber-50 transition">

                        <input type="checkbox"
                               name="tags[]"
                               value="{{ $tag->id }}"
                               class="accent-amber-700"
                               {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>

                        {{ $tag->name }}
                    </label>
                @endforeach

            </div>
        </div>

        {{-- BUTTON --}}
        <button type="submit"
                class="w-full bg-amber-700 text-white py-2.5 rounded-lg hover:bg-amber-800 transition text-sm font-medium">
            Create Account
        </button>

    </form>

    {{-- FOOTER --}}
    <p class="text-center text-sm text-stone-500">
        Already have an account?
        <a href="{{ route('login') }}"
           class="text-amber-700 hover:underline font-medium">
            Login
        </a>
    </p>

</div>

@endsection