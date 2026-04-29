@extends('layouts.admin')

@section('title', 'Book Catalog')
@section('header', 'Book Catalog')
@section('subheader', 'Manage your library collection')

@section('content')

<div class="space-y-6">

    {{-- HEADER WITH STATS --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-8 h-0.5 bg-gradient-to-r from-amber-600 to-transparent rounded-full"></div>
                <p class="text-xs font-semibold text-amber-700 uppercase tracking-wider">Library Collection</p>
            </div>
            <h2 class="text-2xl font-bold serif-font text-[#2C1810]">Books Directory</h2>
            <p class="text-sm text-stone-500 mt-1">Manage your complete book inventory</p>
        </div>

        <div class="flex gap-3">
            {{-- Stats Badges --}}
            <div class="bg-gradient-to-br from-amber-50 to-amber-100/30 rounded-xl px-4 py-2 border border-amber-200">
                <p class="text-xs text-amber-700 font-semibold">Total Books</p>
                <p class="text-2xl font-bold text-amber-800">{{ $books->count() }}</p>
            </div>
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/30 rounded-xl px-4 py-2 border border-emerald-200">
                <p class="text-xs text-emerald-700 font-semibold">Categories</p>
                <p class="text-2xl font-bold text-emerald-800">{{ $books->groupBy('category_id')->count() }}</p>
            </div>
            <a href="{{ route('admin.books.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white text-sm font-medium px-5 py-2 rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Book
            </a>
        </div>
    </div>

    {{-- SEARCH & FILTER BAR --}}
    <div class="bg-white rounded-xl shadow-md border border-amber-100 p-4">
        <div class="flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
            <div class="relative flex-1 max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" 
                       placeholder="Search by title, author, or ISBN..." 
                       class="w-full pl-10 pr-4 py-2 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
            </div>
            <div class="flex gap-2">
                <select class="px-4 py-2 rounded-lg border-2 border-amber-200 bg-white text-stone-700 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all text-sm">
                    <option>All Categories</option>
                    @php
                        $categories = $books->pluck('category.name')->unique();
                    @endphp
                    @foreach($categories as $category)
                        @if($category)
                            <option>{{ $category }}</option>
                        @endif
                    @endforeach
                </select>
                <button class="px-4 py-2 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition font-medium text-sm">
                    Filter
                </button>
            </div>
        </div>
    </div>

    {{-- BOOKS TABLE --}}
    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                
                {{-- TABLE HEADER --}}
                <thead>
                    <tr class="bg-gradient-to-r from-amber-50 to-amber-100/50 border-b-2 border-amber-200">
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Book Title
                            </span>
                        </th>
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Author
                            </span>
                        </th>
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                </svg>
                                Category
                            </span>
                        </th>
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Prices
                            </span>
                        </th>
                        <th class="text-right px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider">Actions</span>
                        </th>
                    </tr>
                </thead>

                {{-- TABLE BODY --}}
                <tbody class="divide-y divide-amber-50">
                    @forelse($books as $book)
                        <tr class="hover:bg-amber-50/40 transition-all duration-200 group table-row-hover">
                            
                            {{-- BOOK TITLE with cover icon --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <div class="w-10 h-12 rounded bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center shadow-inner">
                                            <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-stone-800 group-hover:text-amber-700 transition-colors">
                                            {{ $book->title }}
                                        </p>
                                        @if($book->isbn)
                                            <p class="text-xs text-stone-400 font-mono">ISBN: {{ $book->isbn }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- AUTHOR --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-stone-700">{{ $book->author }}</span>
                                </div>
                            </td>

                            {{-- CATEGORY --}}
                            <td class="px-6 py-4">
                                @if($book->category)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                        </svg>
                                        {{ $book->category->name }}
                                    </span>
                                @else
                                    <span class="text-xs text-stone-400 italic">No Category</span>
                                @endif
                            </td>

                            {{-- PRICES --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1.5">
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-semibold w-fit">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                                        </svg>
                                        Purchase: {{ number_format($book->purchase_price, 2) }} DH
                                    </div>
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 text-xs font-semibold w-fit">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Rental: {{ number_format($book->rental_price, 2) }} DH
                                    </div>
                                </div>
                            </td>

                            {{-- ACTIONS --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.books.edit', $book) }}"
                                       class="p-2 text-stone-500 hover:text-emerald-700 transition rounded-lg hover:bg-emerald-50"
                                       title="Edit Book">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    <form method="POST" action="{{ route('admin.books.destroy', $book) }}"
                                          onsubmit="return confirm('Delete "{{ $book->title }}"? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 text-stone-500 hover:text-red-600 transition rounded-lg hover:bg-red-50"
                                                title="Delete Book">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-20 h-20 rounded-full bg-amber-50 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-stone-700">No Books Found</h3>
                                    <p class="text-sm text-stone-400">Start building your library collection</p>
                                    <a href="{{ route('admin.books.create') }}" class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-amber-700 text-white rounded-lg hover:bg-amber-800 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Add First Book
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($books, 'links') && $books->hasPages())
            <div class="px-6 py-4 border-t border-amber-100 bg-amber-50/30">
                {{ $books->links() }}
            </div>
        @endif
    </div>

    {{-- QUICK STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-4 border border-amber-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-amber-700 font-semibold">Avg. Purchase Price</p>
                    <p class="text-2xl font-bold text-amber-800">{{ number_format($books->avg('purchase_price') ?? 0, 2) }} DH</p>
                </div>
                <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                </svg>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-blue-50 to-transparent rounded-xl p-4 border border-blue-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-blue-700 font-semibold">Avg. Rental Price</p>
                    <p class="text-2xl font-bold text-blue-800">{{ number_format($books->avg('rental_price') ?? 0, 2) }} DH</p>
                </div>
                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-r from-emerald-50 to-transparent rounded-xl p-4 border border-emerald-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-emerald-700 font-semibold">Most Expensive</p>
                    <p class="text-lg font-bold text-emerald-800 truncate">{{ $books->max('purchase_price') ?? 0 }} DH</p>
                </div>
                <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-50 to-transparent rounded-xl p-4 border border-purple-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-purple-700 font-semibold">Total Value</p>
                    <p class="text-2xl font-bold text-purple-800">{{ number_format($books->sum('purchase_price'), 2) }} DH</p>
                </div>
                <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm-6-8h.01M9 16h.01"></path>
                </svg>
            </div>
        </div>
    </div>

</div>

@endsection