@extends('layouts.app')

@section('title', 'Add Book')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-bold mb-4">Add New Book</h2>

    {{-- ERRORS --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
            @foreach($errors->all() as $error)
                <div>- {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('library.books.store') }}" class="space-y-3">
        @csrf

        {{-- TITLE --}}
        <input type="text" name="title" placeholder="Book Title"
               value="{{ old('title') }}"
               class="w-full border p-2 rounded">

        {{-- AUTHOR --}}
        <input type="text" name="author" placeholder="Author"
               value="{{ old('author') }}"
               class="w-full border p-2 rounded">

        {{-- CATEGORY --}}
        <input type="text" name="category" placeholder="Category"
               value="{{ old('category') }}"
               class="w-full border p-2 rounded">

        {{-- DESCRIPTION --}}
        <textarea name="description" placeholder="Description (optional)"
                  class="w-full border p-2 rounded">{{ old('description') }}</textarea>

        {{-- ISBN --}}
        <input type="text" name="isbn" placeholder="ISBN"
               value="{{ old('isbn') }}"
               class="w-full border p-2 rounded">

        {{-- PURCHASE PRICE --}}
        <input type="number" step="0.01" name="purchase_price"
               placeholder="Purchase Price"
               value="{{ old('purchase_price') }}"
               class="w-full border p-2 rounded">

        {{-- RENTAL PRICE --}}
        <input type="number" step="0.01" name="rental_price"
               placeholder="Rental Price"
               value="{{ old('rental_price') }}"
               class="w-full border p-2 rounded">

        {{-- STOCK QUANTITY (IMPORTANT) --}}
        <input type="number" name="quantity"
               placeholder="Initial Stock Quantity"
               value="{{ old('quantity') }}"
               class="w-full border p-2 rounded">

        {{-- SUBMIT --}}
        <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
            Create Book
        </button>

    </form>

</div>

@endsection