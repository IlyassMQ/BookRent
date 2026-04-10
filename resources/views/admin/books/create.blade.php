@extends('layouts.admin')

@section('content')

<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">

<h2 class="text-lg font-semibold mb-4">Create Book</h2>

<form method="POST" action="{{ route('admin.books.store') }}">
@csrf

<input name="title" placeholder="Title" class="w-full mb-3 p-2 border rounded">
<input name="author" placeholder="Author" class="w-full mb-3 p-2 border rounded">
<input name="category" placeholder="Category" class="w-full mb-3 p-2 border rounded">
<input name="isbn" placeholder="ISBN" class="w-full mb-3 p-2 border rounded">

<textarea name="description" placeholder="Description"
    class="w-full mb-3 p-2 border rounded"></textarea>

<input name="purchase_price" placeholder="Purchase Price"
    class="w-full mb-3 p-2 border rounded">

<input name="rental_price" placeholder="Rental Price"
    class="w-full mb-3 p-2 border rounded">

<button class="w-full bg-indigo-600 text-white p-2 rounded">
Create
</button>

</form>

</div>

@endsection