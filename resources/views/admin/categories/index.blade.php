@extends('layouts.admin')

@section('title', 'Book Categories')
@section('header', 'Categories Management')
@section('subheader', 'Organize your library collection')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- HEADER WITH STATS --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-8 h-0.5 bg-gradient-to-r from-amber-600 to-transparent rounded-full"></div>
                <p class="text-xs font-semibold text-amber-700 uppercase tracking-wider">Library Organization</p>
            </div>
            <h2 class="text-2xl font-bold serif-font text-[#2C1810]">Book Categories</h2>
            <p class="text-sm text-stone-500 mt-1">Manage and organize your book genres</p>
        </div>

        <div class="flex gap-3">
            {{-- Stats Badge --}}
            <div class="bg-gradient-to-br from-amber-50 to-amber-100/30 rounded-xl px-4 py-2 border border-amber-200">
                <p class="text-xs text-amber-700 font-semibold">Total Categories</p>
                <p class="text-2xl font-bold text-amber-800">{{ $categories->count() }}</p>
            </div>
            
            <a href="{{ route('admin.categories.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white text-sm font-medium px-5 py-2 rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create Category
            </a>
        </div>
    </div>

    {{-- CATEGORIES GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        
        @forelse($categories as $category)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-amber-100 hover:border-amber-300 overflow-hidden group">
                
                {{-- Category Card Content --}}
                <div class="p-5">
                    {{-- Category Icon and Header --}}
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                        </div>
                        
                        {{-- Book Count Badge --}}
                        <div class="px-2.5 py-1 rounded-full bg-amber-50 border border-amber-200">
                            <p class="text-xs font-semibold text-amber-700">
                                {{ $category->books_count ?? 0 }} books
                            </p>
                        </div>
                    </div>

                    {{-- Category Name --}}
                    <div class="mb-3">
                        <h3 class="text-lg font-bold serif-font text-[#2C1810] group-hover:text-amber-700 transition-colors">
                            {{ $category->name }}
                        </h3>
                        <div class="w-12 h-0.5 bg-gradient-to-r from-amber-400 to-transparent rounded-full mt-2 group-hover:w-20 transition-all duration-300"></div>
                    </div>

                    {{-- Category Description --}}
                    @if($category->description)
                        <p class="text-sm text-stone-600 mb-4">
                            {{ Str::limit($category->description, 80) }}
                        </p>
                    @else
                        <p class="text-sm text-stone-400 italic mb-4">
                            No description available
                        </p>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-2 pt-3 border-t border-amber-100">
                        <a href="{{ route('admin.categories.edit', $category) }}" 
                           class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-emerald-700 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.categories.destroy', $category) }}"
                              onsubmit="return confirm('Delete category \"{{ $category->name }}\"? This will also affect books in this category. This action cannot be undone.')"
                              class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-red-700 bg-red-50 rounded-lg hover:bg-red-100 transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-2xl shadow-xl border border-amber-100 p-12 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-20 h-20 rounded-full bg-amber-50 flex items-center justify-center">
                            <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-stone-700">No Categories Found</h3>
                        <p class="text-sm text-stone-400">Start organizing your library by creating your first category</p>
                        <a href="{{ route('admin.categories.create') }}" class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-amber-700 text-white rounded-lg hover:bg-amber-800 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create Category
                        </a>
                    </div>
                </div>
            </div>
        @endforelse

    </div>

    {{-- STATISTICS SECTION --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-4 border border-amber-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-amber-700 font-semibold">Total Categories</p>
                    <p class="text-2xl font-bold text-amber-800">{{ $categories->count() }}</p>
                </div>
                <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                </svg>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-blue-50 to-transparent rounded-xl p-4 border border-blue-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-blue-700 font-semibold">With Books</p>
                    <p class="text-2xl font-bold text-blue-800">
                        {{ $categories->filter(function($cat) { return ($cat->books_count ?? 0) > 0; })->count() }}
                    </p>
                </div>
                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-r from-emerald-50 to-transparent rounded-xl p-4 border border-emerald-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-emerald-700 font-semibold">Empty Categories</p>
                    <p class="text-2xl font-bold text-emerald-800">
                        {{ $categories->filter(function($cat) { return ($cat->books_count ?? 0) == 0; })->count() }}
                    </p>
                </div>
                <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-50 to-transparent rounded-xl p-4 border border-purple-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-purple-700 font-semibold">Most Popular</p>
                    <p class="text-sm font-bold text-purple-800 truncate">
                        {{ $categories->sortByDesc('books_count')->first()->name ?? 'N/A' }}
                    </p>
                </div>
                <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- PAGINATION (if you have it) --}}
    @if(method_exists($categories, 'links') && $categories->hasPages())
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    @endif

</div>

@endsection