@extends('layouts.admin')

@section('content')

<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">

<h2 class="text-lg font-semibold mb-4">Create Book</h2>

<form method="POST" action="{{ route('admin.books.store') }}">
@csrf

<input name="title" placeholder="Title" class="w-full mb-3 p-2 border rounded">
<input name="author" placeholder="Author" class="w-full mb-3 p-2 border rounded">

<select name="category_id" class="w-full mb-3 p-2 border rounded">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

<input name="isbn" placeholder="ISBN" class="w-full mb-3 p-2 border rounded">

<textarea name="description" placeholder="Description"
    class="w-full mb-3 p-2 border rounded"></textarea>

<input name="purchase_price" placeholder="Purchase Price"
    class="w-full mb-3 p-2 border rounded">

<input name="rental_price" placeholder="Rental Price"
    class="w-full mb-3 p-2 border rounded">
<input name="quantity" placeholder="Quantity"
    class="w-full mb-3 p-2 border rounded">

    @foreach($tags as $tag)
    <label>
        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
        {{ $tag->name }}
    </label>
    @endforeach

    {{-- LIBRARY --}}
        <select name="library_id" class="w-full mb-3 p-2 border rounded">
            <option value="">Select Library</option>
            @foreach($libraries as $library)
                <option value="{{ $library->id }}"
                    @selected(old('library_id') == $library->id)>
                    {{ $library->name }}
                </option>
            @endforeach
        </select>

<button class="w-full bg-indigo-600 text-white p-2 rounded">
Create
</button>

</form>

</div>

@endsection