@extends('layouts.auth')

@section('title', 'Login to Your Library')

@section('content')

<div class="space-y-7">

    {{-- TITLE with bookish decoration --}}
    <div class="text-center">
        <div class="flex justify-center mb-3">
            <div class="w-16 h-0.5 bg-gradient-to-r from-transparent via-amber-600 to-transparent rounded-full"></div>
        </div>
        <h2 class="text-3xl font-bold serif-font bg-gradient-to-r from-[#5C2E0B] to-[#8B4513] bg-clip-text text-transparent">
            Welcome Back
        </h2>
        <p class="text-sm text-[#6B4F12] mt-2 italic">
            "Returning to your literary journey"
        </p>
        <div class="flex justify-center mt-3">
            <div class="w-12 h-0.5 bg-gradient-to-r from-transparent via-amber-600 to-transparent rounded-full"></div>
        </div>
    </div>

    <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
        @csrf

        {{-- EMAIL FIELD with book icon --}}
        <div class="group">
            <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Email Address
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="reader@bookrent.com"
                       class="w-full pl-10 pr-3 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 focus:outline-none transition-all duration-200 bg-white/90 text-stone-800 placeholder-stone-400">
            </div>
            @error('email')
                <p class="text-red-600 text-xs mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- PASSWORD FIELD with lock icon --}}
        <div class="group">
            <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Password
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input type="password"
                       name="password"
                       placeholder="••••••••"
                       class="w-full pl-10 pr-3 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 focus:outline-none transition-all duration-200 bg-white/90 text-stone-800">
            </div>
            @error('password')
                <p class="text-red-600 text-xs mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- REMEMBER ME & FORGOT PASSWORD (optional - uncomment if you have these routes) --}}
        {{-- 
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-stone-600">
                <input type="checkbox" name="remember" class="rounded border-amber-300 text-amber-600 focus:ring-amber-500">
                <span>Remember me</span>
            </label>
            <a href="#" class="text-sm text-amber-700 hover:underline">Forgot password?</a>
        </div>
        --}}

        {{-- LOGIN BUTTON with book animation --}}
        <button type="submit"
                class="group relative w-full bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white py-3 rounded-lg transition-all duration-300 text-sm font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
            <span class="flex items-center justify-center gap-2">
                <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Login to Your Library
            </span>
        </button>

    </form>

    {{-- DIVIDER --}}
    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-amber-200"></div>
        </div>
        <div class="relative flex justify-center text-xs">
            <span class="px-3 bg-white/80 text-stone-500 serif-font italic">new reader?</span>
        </div>
    </div>

    {{-- REGISTER LINK --}}
    <p class="text-center text-sm text-stone-600">
        Don't have an account yet?
        <a href="{{ route('register') }}"
           class="text-amber-700 hover:text-amber-800 font-semibold hover:underline transition-all ml-1 inline-flex items-center gap-1">
            Create an account
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </p>

    {{-- DECORATIVE BOOK QUOTE --}}
    <div class="text-center pt-2">
        <div class="inline-flex items-center gap-2 text-xs text-amber-600/60 serif-font italic">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.255 0 2.443.29 3.5.804v-10zM5.5 4c1.255 0 2.443.29 3.5.804v10c-1.057-.514-2.245-.804-3.5-.804s-2.443.29-3.5.804v-10C3.057 4.29 4.245 4 5.5 4z"></path>
            </svg>
            <span>"A room without books is like a body without a soul"</span>
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.255 0 2.443.29 3.5.804v-10zM5.5 4c1.255 0 2.443.29 3.5.804v10c-1.057-.514-2.245-.804-3.5-.804s-2.443.29-3.5.804v-10C3.057 4.29 4.245 4 5.5 4z"></path>
            </svg>
        </div>
    </div>

</div>

@endsection