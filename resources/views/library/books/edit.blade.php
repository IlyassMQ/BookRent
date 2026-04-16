@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Edit Book</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
            @foreach($errors->all() as $error)
                <div>- {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('library.books.update', $book->id) }}" class="space-y-3">
        @csrf
        @method('PUT')

        <input name="title" value="{{ old('title', $book->title) }}"
               class="w-full border p-2 rounded">

        <input name="author" value="{{ old('author', $book->author) }}"
               class="w-full border p-2 rounded">

        <input name="category" value="{{ old('category', $book->category) }}"
               class="w-full border p-2 rounded">

        <textarea name="description"
                  class="w-full border p-2 rounded">{{ old('description', $book->description) }}</textarea>

        <input name="isbn" value="{{ old('isbn', $book->isbn) }}"
               class="w-full border p-2 rounded">

        <input type="number" step="0.01" name="purchase_price"
               value="{{ old('purchase_price', $book->purchase_price) }}"
               class="w-full border p-2 rounded">

        <input type="number" step="0.01" name="rental_price"
               value="{{ old('rental_price', $book->rental_price) }}"
               class="w-full border p-2 rounded">

        <button class="w-full bg-indigo-600 text-white py-2 rounded">
            Update Book
        </button>

    </form>

</div>

@endsection