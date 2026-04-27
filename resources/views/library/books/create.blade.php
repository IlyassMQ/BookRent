@extends('layouts.app')

@section('title', 'Add Book')

@section('content')

<div class="max-w-2xl mx-auto bg-white border border-amber-100 rounded-2xl shadow-sm p-6">

    {{-- HEADER --}}
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-stone-800">
            Add New Book
        </h2>
        <p class="text-sm text-stone-500">
            Fill in the details to add a new book to your library
        </p>
    </div>

    {{-- ERRORS --}}
    @if($errors->any())
        <div class="bg-red-50 text-red-600 px-4 py-3 rounded-lg mb-5 text-sm space-y-1">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST"
          action="{{ route('library.books.store') }}"
          enctype="multipart/form-data"
          class="space-y-5">

        @csrf

        {{-- BASIC INFO --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="text-sm text-stone-600">Title</label>
                <input type="text" name="title"
                       value="{{ old('title') }}"
                       class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="text-sm text-stone-600">Author</label>
                <input type="text" name="author"
                       value="{{ old('author') }}"
                       class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            </div>

        </div>

        {{-- CATEGORY --}}
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

        {{-- DESCRIPTION --}}
        <div>
            <label class="text-sm text-stone-600">Description</label>
            <textarea name="description"
                      rows="3"
                      class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">{{ old('description') }}</textarea>
        </div>

        {{-- ISBN --}}
        <div>
            <label class="text-sm text-stone-600">ISBN</label>
            <input type="text" name="isbn"
                   value="{{ old('isbn') }}"
                   class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
        </div>

        {{-- PRICES --}}
        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="text-sm text-stone-600">Purchase Price (DH)</label>
                <input type="number" step="0.01" name="purchase_price"
                       value="{{ old('purchase_price') }}"
                       class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="text-sm text-stone-600">Rental Price / day (DH)</label>
                <input type="number" step="0.01" name="rental_price"
                       value="{{ old('rental_price') }}"
                       class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            </div>

        </div>

        {{-- STOCK --}}
        <div>
            <label class="text-sm text-stone-600">Initial Stock</label>
            <input type="number" name="quantity"
                   value="{{ old('quantity') }}"
                   class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
        </div>

        {{-- IMAGE --}}
        <div>
            <label class="text-sm text-stone-600">Book Cover</label>
            <input type="file" name="image"
                   class="w-full mt-1 text-sm">
        </div>

        {{-- TAGS --}}
        <div>
            <label class="text-sm text-stone-600 mb-2 block">Tags</label>

            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <label class="text-xs bg-amber-50 px-3 py-1 rounded-full cursor-pointer hover:bg-amber-100">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="mr-1">
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
        </div>

        {{-- SUBMIT --}}
        <button class="w-full bg-amber-700 text-white py-2.5 rounded-lg font-medium hover:bg-amber-800 transition">
            Create Book
        </button>

    </form>

</div>

@endsection