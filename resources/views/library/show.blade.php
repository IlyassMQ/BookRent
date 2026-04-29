@extends('layouts.app')

@section('title', $library->name . ' Library')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- LIBRARY HERO SECTION --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-amber-50 to-amber-100/30 rounded-2xl shadow-lg border border-amber-200 mb-8">
        
        {{-- Decorative library icon background --}}
        <div class="absolute top-0 right-0 opacity-10 transform -translate-y-8 translate-x-8">
            <svg class="w-48 h-48 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>

        <div class="relative z-10 p-6 md:p-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
                        <p class="text-sm font-semibold text-amber-700 uppercase tracking-wider">Partner Library</p>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold serif-font text-[#2C1810] mb-2">
                        {{ $library->name }}
                    </h1>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <p class="text-stone-600">
                            {{ $library->address }}
                        </p>
                    </div>
                </div>

                {{-- Statistics Cards --}}
                <div class="flex gap-4">
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl px-5 py-3 border border-amber-200 shadow-sm">
                        <p class="text-xs text-amber-700 font-semibold">Total Books</p>
                        <div class="flex items-baseline gap-1">
                            <p class="text-2xl font-bold text-amber-800">{{ $library->books->count() }}</p>
                            <p class="text-xs text-stone-500">titles</p>
                        </div>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl px-5 py-3 border border-emerald-200 shadow-sm">
                        <p class="text-xs text-emerald-700 font-semibold">Available</p>
                        <div class="flex items-baseline gap-1">
                            <p class="text-2xl font-bold text-emerald-700">{{ $library->books->where('totalStock', '>', 0)->count() }}</p>
                            <p class="text-xs text-stone-500">titles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION HEADER --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <h2 class="text-xl font-bold serif-font text-[#2C1810]">Available Books</h2>
        </div>
        <p class="text-sm text-stone-500 ml-7">Browse our collection of books from this library</p>
    </div>

    {{-- BOOKS GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
        @forelse($library->books as $book)
            <a href="{{ route('books.show', $book->id) }}"
               class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-amber-100 hover:border-amber-300 transform hover:-translate-y-1">
                
                {{-- BOOK COVER --}}
                <div class="relative h-56 bg-gradient-to-br from-amber-50 to-stone-100 overflow-hidden">
                    <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                         alt="{{ $book->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    
                    {{-- Stock Badge Overlay --}}
                    <div class="absolute top-3 right-3">
                        @if($book->totalStock > 5)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-semibold bg-emerald-500 text-white rounded-lg shadow-md">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                In Stock
                            </span>
                        @elseif($book->totalStock > 0)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-semibold bg-yellow-500 text-white rounded-lg shadow-md">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Limited
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-semibold bg-red-500 text-white rounded-lg shadow-md">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Out of Stock
                            </span>
                        @endif
                    </div>
                </div>

                {{-- BOOK INFO --}}
                <div class="p-4">
                    {{-- Title --}}
                    <h3 class="text-base font-bold serif-font text-[#2C1810] group-hover:text-amber-700 transition-colors line-clamp-2 mb-2">
                        {{ $book->title }}
                    </h3>

                    {{-- Author --}}
                    <div class="flex items-center gap-1 mb-3">
                        <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <p class="text-xs text-stone-600">
                            {{ $book->author }}
                        </p>
                    </div>

                    {{-- Category --}}
                    <div class="flex items-center gap-1 mb-3">
                        <svg class="w-3 h-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                        <p class="text-xs text-stone-500">
                            {{ $book->category->name ?? 'Uncategorized' }}
                        </p>
                    </div>

                    {{-- Price Info --}}
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-amber-100">
                        <div class="flex flex-col">
                            <span class="text-xs text-stone-400">Purchase</span>
                            <span class="text-sm font-bold text-emerald-700">{{ number_format($book->purchase_price, 2) }} DH</span>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-xs text-stone-400">Rental/day</span>
                            <span class="text-sm font-bold text-blue-700">{{ number_format($book->rental_price, 2) }} DH</span>
                        </div>
                    </div>

                    {{-- View Details Link --}}
                    <div class="mt-3 text-right">
                        <span class="text-xs text-amber-600 group-hover:text-amber-700 font-medium inline-flex items-center gap-1">
                            View Details
                            <svg class="w-3 h-3 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-2xl shadow-xl border border-amber-100 p-16 text-center">
                    <div class="flex flex-col items-center gap-4">
                        <div class="w-24 h-24 rounded-full bg-amber-50 flex items-center justify-center">
                            <svg class="w-12 h-12 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-stone-700">No Books Available</h3>
                        <p class="text-stone-400 max-w-md">This library doesn't have any books in their collection yet. Check back later!</p>
                        <a href="{{ route('home') }}" class="mt-2 inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#8B4513] to-[#6B3410] text-white rounded-lg hover:shadow-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Browse Other Libraries
                        </a>
                    </div>
                </div>
            </div>
        @endforelse

    </div>

</div>

@endsection