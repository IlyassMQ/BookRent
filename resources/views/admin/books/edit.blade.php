@extends('layouts.admin')

@section('content')

<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">

<h2 class="text-lg font-semibold mb-4">Edit Book</h2>

<form method="POST" action="{{ route('admin.books.update', $book) }}">
@csrf
@method('PUT')

<input name="title" value="{{ $book->title }}" class="w-full mb-3 p-2 border rounded">
<input name="author" value="{{ $book->author }}" class="w-full mb-3 p-2 border rounded">
<input name="category" value="{{ $book->category }}" class="w-full mb-3 p-2 border rounded">

<textarea name="description"
    class="w-full mb-3 p-2 border rounded">{{ $book->description }}</textarea>

<input name="purchase_price" value="{{ $book->purchase_price }}"
    class="w-full mb-3 p-2 border rounded">

<input name="rental_price" value="{{ $book->rental_price }}"
    class="w-full mb-3 p-2 border rounded">

<button class="w-full bg-indigo-600 text-white p-2 rounded">
Update
</button>

</form>

</div>

@endsection