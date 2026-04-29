@extends('layouts.admin')

@section('title', 'Edit Book')
@section('header', 'Edit Book')
@section('subheader', 'Update book information and details')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- BREADCRUMB NAVIGATION --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-stone-500">
            <a href="{{ route('admin.books.index') }}" class="hover:text-amber-700 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Books
            </a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-amber-700 font-semibold">Edit: {{ $book->title }}</span>
        </div>
    </div>

    {{-- MAIN FORM CARD --}}
    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
        
        {{-- FORM HEADER --}}
        <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-6 py-4 border-b border-amber-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-600 to-amber-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold serif-font text-[#2C1810]">Edit Book Details</h3>
                    <p class="text-xs text-stone-500">Update the information for "{{ $book->title }}"</p>
                </div>
            </div>
        </div>

        {{-- FORM BODY --}}
        <form method="POST" action="{{ route('admin.books.update', $book) }}" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- BOOK TITLE & AUTHOR --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Title Field --}}
                <div class="group">
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Book Title *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="title" 
                               value="{{ old('title', $book->title) }}"
                               placeholder="Enter book title"
                               class="w-full pl-10 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('title') border-red-500 @enderror">
                    </div>
                    @error('title')
                        <p class="text-red-600 text-xs mt-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Author Field --}}
                <div class="group">
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Author *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="author" 
                               value="{{ old('author', $book->author) }}"
                               placeholder="Author name"
                               class="w-full pl-10 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('author') border-red-500 @enderror">
                    </div>
                    @error('author')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- CATEGORY & LIBRARY --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Category Field --}}
                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                        Category
                    </label>
                    <select name="category_id"
                            class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all bg-white">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @selected(old('category_id', $book->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Library Field --}}
                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Library
                    </label>
                    <select name="library_id"
                            class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all bg-white">
                        <option value="">Select Library</option>
                        @foreach($libraries as $library)
                            <option value="{{ $library->id }}"
                                    @selected(old('library_id', $book->library_id) == $library->id)>
                                {{ $library->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                    <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                    Description
                </label>
                <textarea name="description" 
                          rows="4" 
                          placeholder="Enter book description..."
                          class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">{{ old('description', $book->description) }}</textarea>
            </div>

            {{-- PRICES & QUANTITY --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Purchase Price --}}
                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                        </svg>
                        Purchase Price (DH)
                    </label>
                    <input type="number" 
                           name="purchase_price" 
                           value="{{ old('purchase_price', $book->purchase_price) }}"
                           step="0.01"
                           placeholder="0.00"
                           class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
                </div>

                {{-- Rental Price --}}
                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Rental Price (DH)
                    </label>
                    <input type="number" 
                           name="rental_price" 
                           value="{{ old('rental_price', $book->rental_price) }}"
                           step="0.01"
                           placeholder="0.00"
                           class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
                </div>

                {{-- Quantity --}}
                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Quantity
                    </label>
                    <input type="number" 
                           name="quantity" 
                           value="{{ old('quantity', $book->quantity ?? 0) }}"
                           placeholder="0"
                           class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
                </div>
            </div>

            {{-- TAGS --}}
            <div>
                <label class="block text-sm font-medium text-[#5C2E0B] mb-3 serif-font">
                    <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Tags
                </label>
                <div class="flex flex-wrap gap-2 p-3 bg-amber-50/30 rounded-lg border border-amber-200">
                    @foreach($tags as $tag)
                        <label class="group flex items-center gap-2 px-3 py-1.5 border-2 border-amber-200 rounded-full text-sm cursor-pointer transition-all duration-200 hover:border-amber-600 hover:bg-amber-50">
                            <input type="checkbox" 
                                   name="tags[]" 
                                   value="{{ $tag->id }}"
                                   @checked($book->tags->contains($tag->id))
                                   class="w-4 h-4 rounded border-amber-300 text-amber-700 focus:ring-amber-500">
                            <span class="text-stone-700 group-hover:text-amber-800 transition-colors">
                                {{ $tag->name }}
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('tags')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- FORM ACTIONS --}}
            <div class="flex gap-3 pt-4 border-t border-amber-200">
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white py-2.5 rounded-lg transition-all duration-300 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Update Book
                    </span>
                </button>
                
                <a href="{{ route('admin.books.index') }}" 
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
                <p class="text-sm font-semibold text-[#2C1810]">Book Management Tips</p>
                <p class="text-xs text-stone-600 mt-1">Ensure all book details are accurate before saving. Tags help users discover books by genre or topic. Price fields accept decimal values for precise pricing.</p>
            </div>
        </div>
    </div>

</div>

@endsection