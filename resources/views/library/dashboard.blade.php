@extends('layouts.app')

@section('title', 'My Library Dashboard')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER SECTION --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
            <p class="text-sm font-semibold text-amber-700 uppercase tracking-wider">Library Dashboard</p>
        </div>
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold serif-font text-[#2C1810] mb-2">
                    {{ $library->name }}
                </h1>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <p class="text-sm text-stone-600">
                        {{ $library->address }}
                    </p>
                </div>
            </div>
            
            {{-- Status Badge --}}
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold
                    @if($library->status === 'approved') bg-emerald-100 text-emerald-700 border border-emerald-200
                    @elseif($library->status === 'pending') bg-yellow-100 text-yellow-700 border border-yellow-200
                    @else bg-red-100 text-red-700 border border-red-200 @endif">
                    @if($library->status === 'approved')
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    @elseif($library->status === 'pending')
                        <svg class="w-3 h-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @else
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    @endif
                    {{ ucfirst($library->status) }}
                </span>
            </div>
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        
        {{-- Books Count Card --}}
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-amber-100 hover:border-amber-300 overflow-hidden">
            <div class="p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <svg class="w-8 h-8 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <p class="text-xs font-semibold text-stone-500 uppercase tracking-wider mb-1">Total Books</p>
                <p class="text-3xl font-bold text-[#2C1810]">{{ $booksCount }}</p>
                <p class="text-xs text-stone-400 mt-2">Unique titles in your catalog</p>
            </div>
        </div>

        {{-- Total Stock Card --}}
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-amber-100 hover:border-amber-300 overflow-hidden">
            <div class="p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-200 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <svg class="w-8 h-8 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <p class="text-xs font-semibold text-stone-500 uppercase tracking-wider mb-1">Total Stock</p>
                <p class="text-3xl font-bold text-emerald-700">{{ $totalStock }}</p>
                <p class="text-xs text-stone-400 mt-2">Total copies available</p>
            </div>
        </div>

        {{-- Stock Value Card --}}
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-amber-100 hover:border-amber-300 overflow-hidden">
            <div class="p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                        </svg>
                    </div>
                    <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-xs font-semibold text-stone-500 uppercase tracking-wider mb-1">Inventory Value</p>
                <p class="text-3xl font-bold text-blue-700">{{ number_format($totalValue, 0) }} DH</p>
                <p class="text-xs text-stone-400 mt-2">Total stock purchase value</p>
            </div>
        </div>
    </div>

    {{-- ACTION BUTTONS --}}
    <div class="flex flex-wrap gap-3 mb-8">
        <a href="{{ route('library.books.create') }}"
           class="inline-flex items-center gap-2 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white px-5 py-2.5 rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add New Book
        </a>

        <a href="{{ route('library.stock.index') }}"
           class="inline-flex items-center gap-2 bg-stone-700 hover:bg-stone-800 text-white px-5 py-2.5 rounded-lg transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            Manage Stock
        </a>

        <a href="{{ route('library.withdraw.index') }}"
           class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
            Validate Pickup
        </a>
        <a href="{{ route('library.edit') }}"
           class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
            Edit Library Info
        </a>
         <a href="{{ route('library.transactions') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path>
            </svg>
            View Orders
        </a>
    </div>

    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        {{-- RECENT BOOKS SECTION --}}
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-5 py-3 border-b border-amber-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <h2 class="text-sm font-bold serif-font text-[#2C1810]">Recent Books</h2>
                    </div>
                    <span class="text-xs text-amber-600 bg-amber-100 px-2 py-1 rounded-full">{{ $booksCount }} total</span>
                </div>
            </div>

            <div class="divide-y divide-amber-50 max-h-96 overflow-y-auto">
                @forelse($books->take(6) as $book)
                    <div class="p-4 hover:bg-amber-50/40 transition group">
                        <div class="flex justify-between items-center">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-10 rounded bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-stone-800 group-hover:text-amber-700 transition">
                                            {{ $book->title }}
                                        </p>
                                        <p class="text-xs text-stone-500">
                                            {{ $book->author }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <a href="{{ route('library.books.edit', $book->id) }}"
                                   class="text-xs text-emerald-600 hover:text-emerald-700 font-medium transition">
                                    Edit
                                </a>
                                <form method="POST"
                                      action="{{ route('library.books.destroy', $book->id) }}"
                                      onsubmit="return confirm('Delete "{{ $book->title }}"? This action cannot be undone.')"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 hover:text-red-700 font-medium transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-12 h-12 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <p class="text-sm text-stone-400">No books yet</p>
                            <a href="{{ route('library.books.create') }}" class="text-xs text-amber-600 hover:text-amber-700">Add your first book</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- STOCK OVERVIEW SECTION --}}
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-5 py-3 border-b border-amber-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h2 class="text-sm font-bold serif-font text-[#2C1810]">Stock Overview</h2>
                    </div>
                    <span class="text-xs text-amber-600 bg-amber-100 px-2 py-1 rounded-full">{{ $stocks->count() }} items</span>
                </div>
            </div>

            <div class="divide-y divide-amber-50 max-h-96 overflow-y-auto">
                @forelse($stocks->sortBy('quantity')->take(6) as $stock)
                    <div class="p-4 hover:bg-amber-50/40 transition group">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-stone-100 to-stone-200 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-stone-800">
                                        {{ $stock->book->title }}
                                    </p>
                                    <p class="text-xs text-stone-500">
                                        {{ $stock->book->author }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-sm font-bold rounded-lg
                                    @if($stock->quantity > 10) bg-emerald-100 text-emerald-700
                                    @elseif($stock->quantity > 0) bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ $stock->quantity }}
                                    <span class="text-xs font-normal">copies</span>
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-12 h-12 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p class="text-sm text-stone-400">No stock records yet</p>
                            <a href="{{ route('library.stock.index') }}" class="text-xs text-amber-600 hover:text-amber-700">Add stock to your books</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- HELPER INFO CARD --}}
    @if($library->status === 'pending')
        <div class="mt-6 bg-gradient-to-r from-yellow-50 to-transparent rounded-xl p-4 border border-yellow-200">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-yellow-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-[#2C1810]">Pending Approval</p>
                    <p class="text-xs text-stone-600 mt-1">Your library is waiting for administrator approval. Once approved, you'll be able to manage books, stock, and fulfill orders. You'll receive a notification when your library is active.</p>
                </div>
            </div>
        </div>
    @endif

</div>

@endsection