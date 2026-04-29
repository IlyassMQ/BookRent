@extends('layouts.app')

@section('title', 'Stock Management')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER SECTION --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
            <p class="text-sm font-semibold text-amber-700 uppercase tracking-wider">Inventory Control</p>
        </div>
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold serif-font text-[#2C1810] mb-2">
                    Stock Management
                </h1>
                <p class="text-stone-600">
                    <span class="inline-flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        Manage your book inventory efficiently
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-600 rounded-lg p-4">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm text-emerald-800">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- STATS OVERVIEW --}}
    @if($stocks->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
            <div class="bg-gradient-to-r from-emerald-50 to-transparent rounded-xl p-4 border border-emerald-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-emerald-700 font-semibold">Total Books</p>
                        <p class="text-2xl font-bold text-emerald-800">{{ $stocks->count() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-blue-50 to-transparent rounded-xl p-4 border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-blue-700 font-semibold">Total Units</p>
                        <p class="text-2xl font-bold text-blue-800">{{ $stocks->sum('quantity') }}</p>
                    </div>
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-4 border border-amber-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-amber-700 font-semibold">Well Stocked</p>
                        <p class="text-2xl font-bold text-amber-800">{{ $stocks->filter(fn($s) => $s->quantity > 10)->count() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-r from-red-50 to-transparent rounded-xl p-4 border border-red-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-red-700 font-semibold">Low Stock</p>
                        <p class="text-2xl font-bold text-red-800">{{ $stocks->filter(fn($s) => $s->quantity <= 5 && $s->quantity > 0)->count() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>
    @endif

    {{-- ADD STOCK SECTION --}}
    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-6 py-4 border-b border-amber-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-600 to-emerald-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold serif-font text-[#2C1810]">Add Stock</h3>
                    <p class="text-xs text-stone-500">Increase inventory for existing books</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('library.stock.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @csrf

                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Select Book
                    </label>
                    <select name="book_id"
                            class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all bg-white">
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">
                                {{ $book->title }} ({{ $book->author }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Quantity to Add
                    </label>
                    <input type="number" 
                           name="quantity"
                           placeholder="e.g., 10"
                           min="1"
                           class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
                </div>

                <div class="flex items-end">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white py-2.5 rounded-lg transition-all duration-300 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Stock
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- STOCK LIST SECTION --}}
    @if($stocks->isEmpty())
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 p-12 text-center">
            <div class="flex flex-col items-center gap-3">
                <div class="w-24 h-24 rounded-full bg-amber-50 flex items-center justify-center">
                    <svg class="w-12 h-12 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-stone-700">No Stock Records</h3>
                <p class="text-stone-400">Add stock for your books using the form above</p>
            </div>
        </div>
    @else
        <div>
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h2 class="text-xl font-bold serif-font text-[#2C1810]">Current Inventory</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($stocks as $stock)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-amber-100 hover:border-amber-300 overflow-hidden group">
                        
                        {{-- Card Header --}}
                        <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-4 py-3 border-b border-amber-200">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-sm font-bold serif-font text-[#2C1810] line-clamp-1">
                                        {{ $stock->book->title }}
                                    </h3>
                                    <p class="text-xs text-stone-500">
                                        {{ $stock->book->author }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="p-4">
                            {{-- Stock Level Display --}}
                            <div class="mb-4 p-3 rounded-lg border-2 transition-all
                                @if($stock->quantity > 10) bg-emerald-50 border-emerald-200
                                @elseif($stock->quantity > 0) bg-yellow-50 border-yellow-200
                                @else bg-red-50 border-red-200 @endif">
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-stone-600">Current Stock:</span>
                                    <span class="text-2xl font-bold 
                                        @if($stock->quantity > 10) text-emerald-600
                                        @elseif($stock->quantity > 0) text-yellow-600
                                        @else text-red-600 @endif">
                                        {{ $stock->quantity }}
                                    </span>
                                </div>
                                
                                @if($stock->quantity <= 5 && $stock->quantity > 0)
                                    <div class="mt-2 text-xs text-yellow-700 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        Low stock warning - Consider restocking soon
                                    </div>
                                @elseif($stock->quantity == 0)
                                    <div class="mt-2 text-xs text-red-700 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Out of stock - Immediate restocking recommended
                                    </div>
                                @elseif($stock->quantity > 10)
                                    <div class="mt-2 text-xs text-emerald-700 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Well stocked
                                    </div>
                                @endif
                            </div>

                            {{-- Update Form --}}
                            <form method="POST"
                                  action="{{ route('library.stock.update', $stock->id) }}"
                                  class="flex gap-2 mb-3">
                                @csrf
                                @method('PUT')
                                <div class="flex-1">
                                    <input type="number"
                                           name="quantity"
                                           value="{{ $stock->quantity }}"
                                           min="0"
                                           class="w-full px-2 py-1.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all text-sm">
                                </div>
                                <button type="submit" 
                                        class="px-3 py-1.5 bg-stone-700 hover:bg-stone-800 text-white rounded-lg transition text-xs font-medium">
                                    Update
                                </button>
                            </form>

                            {{-- Delete Button --}}
                            <form method="POST"
                                  action="{{ route('library.stock.destroy', $stock->id) }}"
                                  onsubmit="return confirm('Remove {{ $stock->book->title }} from inventory? This will delete all stock records for this book.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full mt-1 text-xs bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg transition font-medium">
                                    Remove from Inventory
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            @if(method_exists($stocks, 'links') && $stocks->hasPages())
                <div class="mt-10 flex justify-center">
                    <div class="bg-white rounded-xl shadow-md border border-amber-100 px-4 py-2">
                        {{ $stocks->links() }}
                    </div>
                </div>
            @endif
        </div>
    @endif

    {{-- HELPER INFO CARD --}}
    @if($stocks->isNotEmpty())
        <div class="mt-8 bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-4 border border-amber-100">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-[#2C1810]">Inventory Management Tips</p>
                    <p class="text-xs text-stone-600 mt-1">• Green indicates healthy stock levels (>10 copies)<br>• Yellow highlights low stock items that need attention (1-5 copies)<br>• Red shows out-of-stock items requiring immediate restocking<br>• Regular inventory updates ensure accurate availability for customers</p>
                </div>
            </div>
        </div>
    @endif

</div>

@endsection