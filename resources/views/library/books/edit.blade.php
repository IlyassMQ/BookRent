@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')

<div class="max-w-3xl mx-auto px-4 py-8">

    {{-- BREADCRUMB NAVIGATION --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-stone-500">
            <a href="{{ route('library.dashboard') }}" class="hover:text-amber-700 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
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
                    <h3 class="text-lg font-bold serif-font text-[#2C1810]">Edit Book</h3>
                    <p class="text-xs text-stone-500">Update the details of "{{ $book->title }}"</p>
                </div>
            </div>
        </div>

        {{-- FORM BODY --}}
        <form method="POST"
              action="{{ route('library.books.update', $book->id) }}"
              enctype="multipart/form-data"
              class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- ERROR DISPLAY --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-600 rounded-lg p-4">
                    <div class="flex items-start gap-2 mb-2">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold text-red-700">Please fix the following errors:</span>
                    </div>
                    <ul class="space-y-1 ml-7">
                        @foreach($errors->all() as $error)
                            <li class="text-sm text-red-600 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- BOOK INFO SECTION --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Title Field --}}
                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Book Title *
                    </label>
                    <input type="text" 
                           name="title"
                           value="{{ old('title', $book->title) }}"
                           placeholder="Enter book title"
                           class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('title') border-red-500 @enderror">
                </div>

                {{-- Author Field --}}
                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Author *
                    </label>
                    <input type="text" 
                           name="author"
                           value="{{ old('author', $book->author) }}"
                           placeholder="Author name"
                           class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('author') border-red-500 @enderror">
                </div>
            </div>

            {{-- CATEGORY & ISBN --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
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
                            <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ISBN Field --}}
                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        ISBN
                    </label>
                    <input type="text" 
                           name="isbn"
                           value="{{ old('isbn', $book->isbn) }}"
                           placeholder="978-3-16-148410-0"
                           class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
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
                          placeholder="Enter book description, synopsis, or notes..."
                          class="w-full px-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">{{ old('description', $book->description) }}</textarea>
            </div>

            {{-- PRICES --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Purchase Price --}}
                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                        </svg>
                        Purchase Price (DH)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-amber-600 font-semibold">DH</span>
                        </div>
                        <input type="number" 
                               step="0.01" 
                               name="purchase_price"
                               value="{{ old('purchase_price', $book->purchase_price) }}"
                               placeholder="0.00"
                               class="w-full pl-12 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
                    </div>
                </div>

                {{-- Rental Price --}}
                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Rental Price / day (DH)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-amber-600 font-semibold">DH</span>
                        </div>
                        <input type="number" 
                               step="0.01" 
                               name="rental_price"
                               value="{{ old('rental_price', $book->rental_price) }}"
                               placeholder="0.00"
                               class="w-full pl-12 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
                    </div>
                </div>
            </div>

            {{-- BOOK COVER IMAGE --}}
            <div>
                <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                    <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Book Cover Image
                </label>
                
                {{-- Current Image Preview --}}
                @if($book->image)
                    <div class="mb-3">
                        <p class="text-xs text-stone-500 mb-2">Current Cover:</p>
                        <div class="relative inline-block">
                            <img src="{{ asset('storage/'.$book->image) }}"
                                 class="w-24 h-32 object-cover rounded-lg shadow-md border border-amber-200">
                            <div class="absolute -top-2 -right-2 w-5 h-5 bg-emerald-500 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mt-1 flex items-center gap-3">
                    <div class="w-20 h-24 rounded-lg border-2 border-dashed border-amber-200 bg-amber-50/30 flex items-center justify-center">
                        <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <input type="file" 
                               name="image"
                               accept="image/*"
                               class="w-full text-sm text-stone-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition">
                        <p class="text-xs text-stone-400 mt-1">Leave empty to keep current image. Recommended: JPG, PNG. Max 2MB</p>
                    </div>
                </div>
            </div>

            {{-- TAGS --}}
            <div>
                <label class="block text-sm font-medium text-[#5C2E0B] mb-3 serif-font">
                    <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Tags (Select all that apply)
                </label>
                <div class="flex flex-wrap gap-2 p-3 bg-amber-50/30 rounded-lg border border-amber-200 max-h-40 overflow-y-auto">
                    @foreach($tags as $tag)
                        <label class="group flex items-center gap-2 px-3 py-1.5 border-2 rounded-full text-sm cursor-pointer transition-all duration-200
                            {{ $book->tags->contains($tag->id) 
                                ? 'bg-amber-100 border-amber-600 text-amber-800' 
                                : 'border-amber-200 bg-white text-stone-700 hover:border-amber-600 hover:bg-amber-50' }}">
                            <input type="checkbox" 
                                   name="tags[]" 
                                   value="{{ $tag->id }}"
                                   {{ $book->tags->contains($tag->id) ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-amber-300 text-amber-700 focus:ring-amber-500">
                            <span class="group-hover:text-amber-800 transition-colors">
                                {{ $tag->name }}
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('tags')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- BOOK STATS INFO BOX --}}
            <div class="bg-amber-50/50 rounded-lg p-4 border border-amber-200">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-[#2C1810]">Book Information</p>
                        <div class="grid grid-cols-2 gap-3 mt-2">
                            <div>
                                <p class="text-xs text-stone-500">Book ID</p>
                                <p class="text-sm font-mono font-semibold text-amber-700">#{{ str_pad($book->id, 3, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-stone-500">Created</p>
                                <p class="text-xs text-stone-600">{{ $book->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-stone-500">Last Updated</p>
                                <p class="text-xs text-stone-600">{{ $book->updated_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-stone-500">Total Stock</p>
                                <p class="text-sm font-semibold text-amber-700">{{ $book->totalStock ?? 0 }} copies</p>
                            </div>
                        </div>
                    </div>
                </div>
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
                
                <a href="{{ route('library.dashboard') }}" 
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
                <p class="text-sm font-semibold text-[#2C1810]">Quick Tips</p>
                <p class="text-xs text-stone-600 mt-1">• Update book information carefully to maintain accuracy<br>• Upload a new cover image only if needed (leave empty to keep current)<br>• Tags help readers discover your book through search</p>
            </div>
        </div>
    </div>

</div>

@endsection