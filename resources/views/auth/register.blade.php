@extends('layouts.auth')

@section('title', 'Join Our Literary Community')

@section('content')

<div class="space-y-7">

    {{-- HEADER with bookish decoration --}}
    <div class="text-center">
        <div class="flex justify-center mb-3">
            <div class="w-16 h-0.5 bg-gradient-to-r from-transparent via-amber-600 to-transparent rounded-full"></div>
        </div>
        <h2 class="text-3xl font-bold serif-font bg-gradient-to-r from-[#5C2E0B] to-[#8B4513] bg-clip-text text-transparent">
            Begin Your Journey
        </h2>
        <p class="text-sm text-[#6B4F12] mt-2 italic">
            "Every reader finds their story"
        </p>
        <div class="flex justify-center mt-3">
            <div class="w-12 h-0.5 bg-gradient-to-r from-transparent via-amber-600 to-transparent rounded-full"></div>
        </div>
    </div>

    <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
        @csrf

        {{-- FULL NAME with user icon --}}
        <div class="group">
            <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Full Name
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="John Doe"
                       class="w-full pl-10 pr-3 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 focus:outline-none transition-all duration-200 bg-white/90 text-stone-800 placeholder-stone-400">
            </div>
            @error('name')
                <p class="text-red-600 text-xs mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- EMAIL with envelope icon --}}
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

    <div class="group">
            <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                City
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <input type="text"
                       name="city"
                       value="{{ old('city') }}"
                       placeholder="City"
                       class="w-full pl-10 pr-3 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 focus:outline-none transition-all duration-200 bg-white/90 text-stone-800 placeholder-stone-400">
            </div>
            @error('city')
                <p class="text-red-600 text-xs mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- PASSWORD with lock icon --}}
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
                       placeholder="Create a strong password"
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

        {{-- CONFIRM PASSWORD with check icon --}}
        <div class="group">
            <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Confirm Password
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <input type="password"
                       name="password_confirmation"
                       placeholder="Confirm your password"
                       class="w-full pl-10 pr-3 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 focus:outline-none transition-all duration-200 bg-white/90 text-stone-800">
            </div>
        </div>

        {{-- TAGS / INTERESTS with book categories --}}
        <div>
            <label class="block text-sm font-medium text-[#5C2E0B] mb-3 serif-font">
                <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                Your Literary Interests
            </label>
            <div class="text-xs text-stone-500 mb-3 italic">
                Select genres you love
            </div>
            <div class="flex flex-wrap gap-2 max-h-32 overflow-y-auto p-1">
                @foreach($tags as $tag)
                    <label class="group flex items-center gap-2 px-3 py-2 border-2 border-amber-200 rounded-full text-sm cursor-pointer transition-all duration-200 hover:border-amber-600 hover:bg-amber-50 hover:shadow-sm">
                        <input type="checkbox"
                               name="tags[]"
                               value="{{ $tag->id }}"
                               class="w-4 h-4 rounded border-amber-300 text-amber-700 focus:ring-amber-500 focus:ring-1 cursor-pointer"
                               {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                        <span class="text-stone-700 group-hover:text-amber-800 transition-colors">
                            {{ $tag->name }}
                        </span>
                    </label>
                @endforeach
            </div>
            @error('tags')
                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
            @enderror
            @error('tags.*')
                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- REGISTER BUTTON with book animation --}}
        <button type="submit"
                class="group relative w-full bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white py-3 rounded-lg transition-all duration-300 text-sm font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
            <span class="flex items-center justify-center gap-2">
                <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Start Reading Journey
            </span>
        </button>

    </form>

    {{-- DIVIDER --}}
    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-amber-200"></div>
        </div>
        <div class="relative flex justify-center text-xs">
            <span class="px-3 bg-white/80 text-stone-500 serif-font italic">already a member?</span>
        </div>
    </div>

    {{-- LOGIN LINK --}}
    <p class="text-center text-sm text-stone-600">
        Already have an account?
        <a href="{{ route('login') }}"
           class="text-amber-700 hover:text-amber-800 font-semibold hover:underline transition-all ml-1 inline-flex items-center gap-1">
            Sign in here
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
            <span>"Join us and discover your next great read"</span>
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.255 0 2.443.29 3.5.804v-10zM5.5 4c1.255 0 2.443.29 3.5.804v10c-1.057-.514-2.245-.804-3.5-.804s-2.443.29-3.5.804v-10C3.057 4.29 4.245 4 5.5 4z"></path>
            </svg>
        </div>
    </div>

</div>

@endsection