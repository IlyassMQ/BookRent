@extends('layouts.admin')

@section('title', 'Create Tag')
@section('header', 'Create Tag')
@section('subheader', 'Add a new keyword or topic for book discovery')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- BREADCRUMB NAVIGATION --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-stone-500">
            <a href="{{ route('admin.tags.index') }}" class="hover:text-amber-700 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                Tags
            </a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-amber-700 font-semibold">Create New Tag</span>
        </div>
    </div>

    {{-- MAIN FORM CARD --}}
    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
        
        {{-- FORM HEADER --}}
        <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-6 py-4 border-b border-amber-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-600 to-amber-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold serif-font text-[#2C1810]">Tag Information</h3>
                    <p class="text-xs text-stone-500">Enter the details for the new tag</p>
                </div>
            </div>
        </div>

        {{-- FORM BODY --}}
        <form method="POST" action="{{ route('admin.tags.store') }}" class="p-6 space-y-6">
            @csrf

            {{-- ERROR DISPLAY --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-600 rounded-lg p-4">
                    <div class="flex items-start gap-2 mb-2">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold text-red-700">Please fix the following errors:</span>
                    </div>
                    <ul class="space-y-1 ml-7">
                        @foreach($errors->all() as $error)
                            <li class="text-sm text-red-600 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- TAG NAME FIELD --}}
            <div class="group">
                <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                    <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Tag Name *
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="e.g., Bestseller, Award-Winning, Classic, New Release..."
                           class="w-full pl-10 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('name') border-red-500 @enderror">
                </div>
                <p class="text-xs text-stone-400 mt-1">Choose a clear, descriptive keyword for this tag</p>
            </div>

            {{-- TAG EXAMPLES (Helpful hints) --}}
            <div class="bg-amber-50/50 rounded-lg p-4 border border-amber-200">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-[#2C1810]">Popular Tag Examples</p>
                        <div class="flex flex-wrap gap-2 mt-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-white text-xs text-stone-600 border border-amber-200">🏆 Bestseller</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-white text-xs text-stone-600 border border-amber-200">⭐ Award-Winning</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-white text-xs text-stone-600 border border-amber-200">📖 Classic</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-white text-xs text-stone-600 border border-amber-200">🆕 New Release</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-white text-xs text-stone-600 border border-amber-200">🔥 Trending</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-white text-xs text-stone-600 border border-amber-200">📚 Young Adult</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-white text-xs text-stone-600 border border-amber-200">🎧 Audiobook</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-white text-xs text-stone-600 border border-amber-200">📱 eBook</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAG USAGE INFO --}}
            <div class="bg-blue-50/50 rounded-lg p-4 border border-blue-200">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-[#2C1810]">How Tags Work</p>
                        <p class="text-xs text-stone-600 mt-1">Tags help users discover books by specific topics or themes. You can assign multiple tags to each book, making it easier for readers to find what they're looking for.</p>
                    </div>
                </div>
            </div>

            {{-- FORM ACTIONS --}}
            <div class="flex gap-3 pt-4 border-t border-amber-200">
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white py-2.5 rounded-lg transition-all duration-300 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Tag
                    </span>
                </button>
                
                <a href="{{ route('admin.tags.index') }}" 
                   class="px-6 py-2.5 border-2 border-stone-300 text-stone-700 rounded-lg hover:bg-stone-50 transition-all duration-200 font-medium text-center">
                    Cancel
                </a>
            </div>

        </form>
    </div>

    {{-- HELPER INFO CARD --}}
    <div class="mt-6 bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-4 border border-amber-100">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-[#2C1810]">Best Practices for Tags</p>
                <p class="text-xs text-stone-600 mt-1">• Use lowercase for consistency (e.g., "bestseller" instead of "Bestseller")<br>• Keep tags short and descriptive (1-3 words)<br>• Avoid duplicate or very similar tags<br>• Create tags that reflect common search terms</p>
            </div>
        </div>
    </div>

</div>

@endsection