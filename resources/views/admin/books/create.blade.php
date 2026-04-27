@extends('layouts.admin')

@section('title', 'Create Book')
@section('header', 'Create Book')

@section('content')

<div class="max-w-3xl mx-auto bg-white border border-amber-100 rounded-2xl shadow-sm p-6">

    <h2 class="text-lg font-semibold text-stone-800 mb-6">
        Add New Book
    </h2>

    <form method="POST" action="{{ route('admin.books.store') }}" class="space-y-5">
        @csrf

        {{-- TITLE + AUTHOR --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-stone-600">Title</label>
                <input name="title" value="{{ old('title') }}"
                    class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </div>

            <div>
                <label class="text-sm text-stone-600">Author</label>
                <input name="author" value="{{ old('author') }}"
                    class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </div>
        </div>

        {{-- CATEGORY + LIBRARY --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-stone-600">Category</label>
                <select name="category_id"
                    class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm text-stone-600">Library</label>
                <select name="library_id"
                    class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
                    <option value="">Select Library</option>
                    @foreach($libraries as $library)
                        <option value="{{ $library->id }}"
                            @selected(old('library_id') == $library->id)>
                            {{ $library->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- ISBN --}}
        <div>
            <label class="text-sm text-stone-600">ISBN</label>
            <input name="isbn" value="{{ old('isbn') }}"
                class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
        </div>

        {{-- DESCRIPTION --}}
        <div>
            <label class="text-sm text-stone-600">Description</label>
            <textarea name="description"
                class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500"
                rows="4">{{ old('description') }}</textarea>
        </div>

        {{-- PRICES + QUANTITY --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-sm text-stone-600">Purchase Price</label>
                <input name="purchase_price" value="{{ old('purchase_price') }}"
                    class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="text-sm text-stone-600">Rental Price</label>
                <input name="rental_price" value="{{ old('rental_price') }}"
                    class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="text-sm text-stone-600">Quantity</label>
                <input name="quantity" value="{{ old('quantity') }}"
                    class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            </div>
        </div>

        {{-- TAGS --}}
        <div>
            <label class="text-sm text-stone-600 mb-2 block">Tags</label>

            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <label class="flex items-center gap-2 px-3 py-1 border border-amber-200 rounded-full text-sm cursor-pointer hover:bg-amber-50">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
        </div>

        {{-- SUBMIT --}}
        <div class="pt-4">
            <button class="w-full bg-amber-700 hover:bg-amber-800 text-white py-2.5 rounded-lg font-medium transition">
                Create Book
            </button>
        </div>

    </form>

</div>

@endsection