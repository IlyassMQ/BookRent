@extends('layouts.app')

@section('title', 'Browse Libraries')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER SECTION --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
            <p class="text-sm font-semibold text-amber-700 uppercase tracking-wider">Partner Network</p>
        </div>
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold serif-font text-[#2C1810] mb-2">
                    Browse Libraries
                </h1>
                <p class="text-stone-600">
                    <span class="inline-flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Discover partner libraries near you
                    </span>
                </p>
            </div>
            <div class="text-sm text-stone-500">
                {{ $libraries->count() }} {{ Str::plural('library', $libraries->count()) }}
            </div>
        </div>
    </div>

    
    {{-- LIBRARIES GRID --}}
    @if($libraries->isEmpty())
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 p-16 text-center">
            <div class="flex flex-col items-center gap-4">
                <div class="w-24 h-24 rounded-full bg-amber-50 flex items-center justify-center">
                    <svg class="w-12 h-12 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-stone-700">No Libraries Found</h3>
                <p class="text-stone-400 max-w-md">There are no libraries registered yet. Check back later!</p>
                <a href="{{ route('home') }}" class="mt-2 inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#8B4513] to-[#6B3410] text-white rounded-lg hover:shadow-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Browse Books
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($libraries as $library)
                <a href="{{ route('library.show', $library->id) }}" 
                   class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-amber-100 hover:border-amber-300 transform hover:-translate-y-1 block">
                    
                    <div class="p-5">
                        {{-- Header with icon --}}
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="px-2.5 py-1 rounded-full bg-amber-50 border border-amber-200">
                                <p class="text-xs font-semibold text-amber-700">
                                    {{ $library->books_count ?? 0 }} books
                                </p>
                            </div>
                        </div>

                        {{-- Library Name --}}
                        <h3 class="text-lg font-bold serif-font text-[#2C1810] group-hover:text-amber-700 transition-colors mb-2">
                            {{ $library->name }}
                        </h3>

                        {{-- Location --}}
                        <div class="flex items-center gap-1 mb-3">
                            <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-sm text-stone-600">
                                {{ $library->city ?? 'Unknown Location' }}
                            </p>
                        </div>

                        {{-- Address preview --}}
                        @if($library->address)
                            <div class="flex items-start gap-1 mb-3">
                                <svg class="w-3 h-3 text-stone-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <p class="text-xs text-stone-500 line-clamp-1">
                                    {{ Str::limit($library->address, 60) }}
                                </p>
                            </div>
                        @endif

                        {{-- Status Badge (if library has status) --}}
                        @if(isset($library->status) && $library->status === 'approved')
                            <div class="mt-3 pt-3 border-t border-amber-100">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs rounded-full bg-emerald-100 text-emerald-700">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Active
                                </span>
                            </div>
                        @endif

                        {{-- View Link --}}
                        <div class="mt-3 text-right">
                            <span class="text-xs text-amber-600 group-hover:text-amber-700 font-medium inline-flex items-center gap-1">
                                View Library
                                <svg class="w-3 h-3 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    {{-- PAGINATION --}}
    @if(method_exists($libraries, 'links') && $libraries->hasPages())
        <div class="mt-10 flex justify-center">
            <div class="bg-white rounded-xl shadow-md border border-amber-100 px-4 py-2">
                {{ $libraries->links() }}
            </div>
        </div>
    @endif

</div>

@endsection