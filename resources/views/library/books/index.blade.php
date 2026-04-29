@extends('layouts.app')

@section('title', 'My Library Collection')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER SECTION --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
            <p class="text-sm font-semibold text-amber-700 uppercase tracking-wider">Library Collection</p>
        </div>
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold serif-font text-[#2C1810] mb-2">
                    My Books
                </h1>
                <p class="text-stone-600">
                    <span class="inline-flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Manage your library catalog
                    </span>
                </p>
            </div>

            <a href="{{ route('books.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white px-5 py-2.5 rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Book
            </a>
        </div>
    </div>

    {{-- STATS OVERVIEW --}}
    @if($books->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
            <div class="bg-gradient-to-r from-emerald-50 to-transparent rounded-xl p-4 border border-emerald-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-emerald-700 font-semibold">Total Books</p>
                        <p class="text-2xl font-bold text-emerald-800">{{ $books->count() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-blue-50 to-transparent rounded-xl p-4 border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-blue-700 font-semibold">Total Stock</p>
                        <p class="text-2xl font-bold text-blue-800">{{ $books->sum('totalStock') }}</p>
                    </div>
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-4 border border-amber-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-amber-700 font-semibold">Avg. Price</p>
                        <p class="text-2xl font-bold text-amber-800">{{ number_format($books->avg('purchase_price') ?? 0, 0) }} DH</p>
                    </div>
                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-50 to-transparent rounded-xl p-4 border border-purple-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-purple-700 font-semibold">Low Stock</p>
                        <p class="text-2xl font-bold text-purple-800">{{ $books->filter(fn($b) => $b->totalStock <= 5 && $b->totalStock > 0)->count() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>
    @endif

    {{-- EMPTY STATE --}}
    @if($books->isEmpty())
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 p-16 text-center">
            <div class="flex flex-col items-center gap-4">
                <div class="w-24 h-24 rounded-full bg-amber-50 flex items-center justify-center">
                    <svg class="w-12 h-12 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-stone-700">Your library is empty</h3>
                <p class="text-stone-400 max-w-md">Start building your collection by adding your first book to the library catalog.</p>
                <a href="{{ route('books.create') }}" class="mt-2 inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#8B4513] to-[#6B3410] text-white rounded-lg hover:shadow-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Your First Book
                </a>
            </div>
        </div>
    @else
        {{-- BOOKS GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-amber-100 hover:border-amber-300 transform hover:-translate-y-1 flex flex-col">
                    
                    {{-- BOOK COVER --}}
                    <div class="relative h-56 bg-gradient-to-br from-amber-50 to-stone-100 overflow-hidden">
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
                                    In Stock
                                </span>
                            @elseif($book->totalStock > 0)
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold bg-yellow-500 text-white rounded-lg shadow-md">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Low Stock
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
                    <div class="p-4 flex flex-col flex-1">
                        {{-- Title --}}
                        <h3 class="text-base font-bold serif-font text-[#2C1810] group-hover:text-amber-700 transition-colors line-clamp-2 mb-1">
                            {{ $book->title }}
                        </h3>

                        {{-- Author --}}
                        <div class="flex items-center gap-1 mb-2">
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

                        {{-- Stock Quantity --}}
                        <div class="mb-3 p-2 bg-amber-50/50 rounded-lg border border-amber-200">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-stone-600">Available copies:</span>
                                <span class="text-sm font-bold 
                                    @if($book->totalStock > 10) text-emerald-600
                                    @elseif($book->totalStock > 0) text-yellow-600
                                    @else text-red-600 @endif">
                                    {{ $book->totalStock ?? 0 }}
                                </span>
                            </div>
                        </div>

                        {{-- Prices --}}
                        <div class="grid grid-cols-2 gap-2 mb-4 text-xs">
                            <div class="text-center p-1.5 bg-emerald-50 rounded-lg">
                                <p class="text-stone-500">Purchase</p>
                                <p class="font-bold text-emerald-700">{{ number_format($book->purchase_price, 2) }} DH</p>
                            </div>
                            <div class="text-center p-1.5 bg-blue-50 rounded-lg">
                                <p class="text-stone-500">Rental/day</p>
                                <p class="font-bold text-blue-700">{{ number_format($book->rental_price, 2) }} DH</p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-auto flex gap-2">
                            <a href="{{ route('books.edit', $book->id) }}"
                               class="flex-1 inline-flex items-center justify-center gap-1 text-xs bg-stone-700 hover:bg-stone-800 text-white py-2 rounded-lg transition font-medium">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>

                            <form method="POST" action="{{ route('books.destroy', $book->id) }}"
                                  onsubmit="return confirm('Delete "{{ $book->title }}"? This action cannot be undone.')"
                                  class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center gap-1 text-xs bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg transition font-medium">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($books, 'links') && $books->hasPages())
            <div class="mt-10 flex justify-center">
                <div class="bg-white rounded-xl shadow-md border border-amber-100 px-4 py-2">
                    {{ $books->links() }}
                </div>
            </div>
        @endif
    @endif

</div>

@endsection