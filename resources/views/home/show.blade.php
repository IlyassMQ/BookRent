@extends('layouts.app')

@section('title', $book->title)

@section('content')

<div class="max-w-6xl mx-auto px-4 py-8">

    {{-- BREADCRUMB NAVIGATION --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-stone-500">
            <a href="{{ route('home') }}" class="hover:text-amber-700 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        Home
                    </a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-amber-700 font-semibold line-clamp-1">{{ $book->title }}</span>
                </div>
            </div>
        </div>

        {{-- MAIN CONTENT CARD --}}
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                
                {{-- LEFT COLUMN: BOOK COVER --}}
                <div class="bg-gradient-to-br from-amber-50 to-stone-100 p-8 flex items-center justify-center">
                    <div class="relative">
                        <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                             alt="{{ $book->title }}"
                             class="w-full max-w-md h-auto object-cover rounded-xl shadow-2xl">
                        
                        {{-- Stock Badge --}}
                        <div class="absolute top-4 right-4">
                            @if($book->totalStock > 5)
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold bg-emerald-500 text-white rounded-lg shadow-md">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    In Stock
                                </span>
                            @elseif($book->totalStock > 0)
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold bg-yellow-500 text-white rounded-lg shadow-md">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Limited Stock
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold bg-red-500 text-white rounded-lg shadow-md">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Out of Stock
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: BOOK DETAILS --}}
                <div class="p-8">
                    
                    {{-- Title --}}
                    <h1 class="text-3xl md:text-4xl font-bold serif-font text-[#2C1810] mb-3">
                        {{ $book->title }}
                    </h1>

                    {{-- Author --}}
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <p class="text-stone-600">
                            by
                            <a href="{{ route('books.author', $book->author) }}"
                               class="text-amber-700 hover:text-amber-800 font-medium hover:underline">
                                {{ $book->author }}
                            </a>
                        </p>
                    </div>

                    {{-- Category --}}
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                        <a href="{{ route('books.category', $book->category->id) }}"
                           class="text-xs text-stone-500 hover:text-amber-700 transition">
                            {{ $book->category->name ?? 'Uncategorized' }}
                        </a>
                    </div>

                    {{-- Description --}}
                    <div class="mb-6 p-4 bg-amber-50/30 rounded-xl border border-amber-100">
                        <p class="text-sm text-stone-600 leading-relaxed">
                            {{ $book->description ?: 'No description available for this book.' }}
                        </p>
                    </div>

                    {{-- Tags --}}
                    @if($book->tags->isNotEmpty())
                        <div class="mb-6">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span class="text-xs font-semibold text-stone-500 uppercase tracking-wider">Tags</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach($book->tags as $tag)
                                    <a href="{{ route('books.tag', $tag->id) }}"
                                       class="inline-flex items-center px-2.5 py-1 text-xs rounded-full bg-amber-100 text-amber-700 hover:bg-amber-200 hover:text-amber-800 transition">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Pricing --}}
                    <div class="mb-6 grid grid-cols-2 gap-3">
                        <div class="p-3 bg-emerald-50 rounded-lg border border-emerald-200 text-center">
                            <p class="text-xs text-stone-500">Purchase Price</p>
                            <p class="text-xl font-bold text-emerald-700">{{ number_format($book->purchase_price, 2) }} DH</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg border border-blue-200 text-center">
                            <p class="text-xs text-stone-500">Rental Price / day</p>
                            <p class="text-xl font-bold text-blue-700">{{ number_format($book->rental_price, 2) }} DH</p>
                        </div>
                    </div>

                    {{-- Libraries --}}
                    @if($book->stocks->where('quantity', '>', 0)->isNotEmpty())
                        <div class="mb-6 p-3 bg-stone-50 rounded-lg border border-stone-200">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span class="text-xs font-semibold text-stone-500 uppercase tracking-wider">Available at</span>
                            </div>
                            <ul class="space-y-2">
                                @foreach($book->stocks->where('quantity', '>', 0) as $stock)
                                    <li class="flex items-center justify-between">
                                        <a href="{{ route('library.show', $stock->library->id) }}"
                                           class="text-sm text-stone-700 hover:text-amber-700 transition flex items-center gap-2">
                                            <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            {{ $stock->library->name }}
                                        </a>
                                        <span class="text-xs font-semibold text-amber-700">{{ $stock->quantity }} copies</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Action Forms --}}
                    @guest
                        <div class="text-center p-4 bg-amber-50 rounded-lg border border-amber-200">
                            <p class="text-sm text-stone-600">
                                <a href="{{ route('login') }}" class="text-amber-700 font-semibold hover:underline">Login</a>
                                to purchase or rent this book
                            </p>
                        </div>
                    @else
                        @if(auth()->user()->library)
                            <div class="text-center p-4 bg-amber-50 rounded-lg border border-amber-200">
                                <p class="text-sm text-stone-600">
                                    You are logged in as a library account. Please use a reader account to purchase or rent books.
                                </p>
                            </div>
                        @else
                            @if($book->totalStock > 0)
                                <div class="space-y-4">
                                    {{-- Buy Form --}}
                                    <form method="POST" action="{{ route('books.summary', $book->id) }}" class="p-4 bg-gradient-to-r from-emerald-50 to-transparent rounded-xl border border-emerald-200">
                                        @csrf
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                                                </svg>
                                                <h3 class="text-sm font-bold text-emerald-800">Buy this Book</h3>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <label class="text-xs text-stone-500">Quantity</label>
                                                <input type="number" name="quantity" value="1" min="1" max="{{ $book->totalStock }}"
                                                       class="border border-emerald-300 px-2 py-1 rounded w-16 focus:ring-2 focus:ring-emerald-500">
                                            </div>
                                        </div>
                                        <input type="hidden" name="type" value="purchase">
                                        <button class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white py-2 rounded-lg transition font-medium">
                                            Buy Now
                                        </button>
                                    </form>

                                    {{-- Rent Form --}}
                                    <form method="POST" action="{{ route('books.summary', $book->id) }}" class="p-4 bg-gradient-to-r from-blue-50 to-transparent rounded-xl border border-blue-200">
                                        @csrf
                                        <div class="grid grid-cols-2 gap-3 mb-3">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <h3 class="text-sm font-bold text-blue-800">Rent this Book</h3>
                                            </div>
                                            <div class="flex items-center gap-2 justify-end">
                                                <label class="text-xs text-stone-500">Quantity</label>
                                                <input type="number" name="quantity" value="1" min="1" max="{{ $book->totalStock }}"
                                                       class="border border-blue-300 px-2 py-1 rounded w-16 focus:ring-2 focus:ring-blue-500">
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3 mb-3">
                                            <div class="flex-1">
                                                <label class="text-xs text-stone-500 block mb-1">Number of Days</label>
                                                <input type="number" name="days" value="1" min="1"
                                                       class="w-full border border-blue-300 px-3 py-1.5 rounded focus:ring-2 focus:ring-blue-500">
                                            </div>
                                            <div class="flex-1">
                                                <label class="text-xs text-stone-500 block mb-1">Total Price</label>
                                                <div class="text-lg font-bold text-blue-700">{{ number_format($book->rental_price, 2) }} DH</div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="type" value="rental">
                                        <button class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-2 rounded-lg transition font-medium">
                                            Rent Now
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="text-center p-4 bg-red-50 rounded-lg border border-red-200">
                                    <div class="flex items-center justify-center gap-2 mb-2">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <p class="text-sm font-semibold text-red-700">Currently Out of Stock</p>
                                    </div>
                                    <p class="text-xs text-stone-500">This book is not available at the moment. Please check back later.</p>
                                </div>
                            @endif
                        @endif
                    @endguest
                </div>
            </div>
        </div>

    </div>

    @endsection