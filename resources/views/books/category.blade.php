@extends('layouts.app')

@section('title', $category->name . ' Category')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HERO SECTION with category info --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-amber-50 to-amber-100/30 rounded-2xl shadow-lg border border-amber-200 p-8 mb-8">
        
        {{-- Decorative category icon background --}}
        <div class="absolute top-0 right-0 opacity-10 transform -translate-y-8 translate-x-8">
            <svg class="w-48 h-48 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
            </svg>
        </div>

        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
                        <p class="text-sm font-semibold text-amber-700 uppercase tracking-wider">Book Category</p>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold serif-font text-[#2C1810] mb-2">
                        {{ $category->name }}
                    </h1>
                    <p class="text-stone-600">
                        <span class="inline-flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            {{ $books->total() }} {{ Str::plural('book', $books->total()) }} in this category
                        </span>
                    </p>
                    @if($category->description)
                        <p class="text-sm text-stone-500 mt-3 max-w-2xl">
                            {{ $category->description }}
                        </p>
                    @endif
                </div>
                
                <div class="flex gap-3">
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl px-4 py-2 border border-amber-200">
                        <p class="text-xs text-amber-700 font-semibold">Total Books</p>
                        <p class="text-2xl font-bold text-amber-800">{{ $books->total() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BACK BUTTON --}}
    <div class="mb-6">
        <a href="{{ route('home') }}"
           class="inline-flex items-center gap-2 text-sm text-stone-600 hover:text-amber-700 transition group">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Browse All Categories
        </a>
    </div>

    {{-- BOOKS GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
        @forelse($books as $book)
            <a href="{{ route('books.show', $book->id) }}"
               class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-amber-100 hover:border-amber-300 transform hover:-translate-y-1">
                
                {{-- BOOK COVER --}}
                <div class="relative h-64 bg-gradient-to-br from-amber-50 to-stone-100 overflow-hidden">
                    <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                         alt="{{ $book->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    
                    {{-- Stock Badge Overlay --}}
                    <div class="absolute top-3 right-3">
                        @if($book->totalStock > 5)
                            <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold bg-emerald-500 text-white rounded-lg shadow-md">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Available
                            </span>
                        @elseif($book->totalStock > 0)
                            <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold bg-yellow-500 text-white rounded-lg shadow-md">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Limited
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold bg-red-500 text-white rounded-lg shadow-md">
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

                    {{-- Price Info --}}
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-amber-100">
                        <div class="flex flex-col">
                            <span class="text-xs text-stone-400">Purchase</span>
                            <span class="text-sm font-bold text-emerald-700">{{ number_format($book->purchase_price, 2) }} DH</span>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-xs text-stone-400">Rental</span>
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
                <div class="bg-white rounded-2xl shadow-xl border border-amber-100 p-12 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-24 h-24 rounded-full bg-amber-50 flex items-center justify-center">
                            <svg class="w-12 h-12 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-stone-700">No Books Found</h3>
                        <p class="text-stone-400">We don't have any books in the "{{ $category->name }}" category yet.</p>
                        <a href="{{ route('home') }}" class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-amber-700 text-white rounded-lg hover:bg-amber-800 transition">
                            Browse Other Categories
                        </a>
                    </div>
                </div>
            </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    @if($books->hasPages())
        <div class="mt-10 flex justify-center">
            <div class="bg-white rounded-xl shadow-md border border-amber-100 px-4 py-2">
                {{ $books->links() }}
            </div>
        </div>
    @endif

    {{-- RELATED TAGS SECTION --}}
    @if($books->isNotEmpty() && isset($category->tags) && $category->tags->count() > 0)
        <div class="mt-12 bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-5 border border-amber-100">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-[#2C1810]">Popular Tags in {{ $category->name }}</p>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach($category->tags->take(10) as $tag)
                            <a href="{{ route('books.tag', $tag->id) }}" 
                               class="inline-flex items-center px-3 py-1.5 text-xs rounded-full bg-white text-stone-600 border border-amber-200 hover:bg-amber-100 hover:border-amber-300 hover:text-amber-700 transition">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- CATEGORY INSIGHT --}}
    @if($books->isNotEmpty())
        <div class="mt-6 bg-gradient-to-r from-blue-50 to-transparent rounded-xl p-4 border border-blue-100">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-[#2C1810]">About This Category</p>
                    <p class="text-xs text-stone-600 mt-1">
                        Explore our collection of {{ $books->total() }} {{ Str::plural('book', $books->total()) }} in the 
                        <strong class="text-amber-700">{{ $category->name }}</strong> category. 
                        Whether you're looking to purchase or rent, find the perfect read for your next adventure.
                    </p>
                </div>
            </div>
        </div>
    @endif

</div>

@endsection