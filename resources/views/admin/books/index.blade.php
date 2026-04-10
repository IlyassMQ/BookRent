@extends('layouts.admin')

@section('content')

<div class="flex justify-between mb-6">
    <h2 class="text-xl font-semibold">Books</h2>

    <a href="{{ route('admin.books.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded">
        + Add Book
    </a>
</div>

<table class="w-full bg-white rounded shadow text-sm">

<thead class="bg-gray-50">
<tr>
    <th class="p-4 text-left">Title</th>
    <th class="p-4 text-left">Author</th>
    <th class="p-4 text-left">Category</th>
    <th class="p-4 text-left">Prices</th>
    <th class="p-4 text-right">Actions</th>
</tr>
</thead>

<tbody>
@foreach($books as $book)
<tr class="border-t">

    <td class="p-4 font-medium">{{ $book->title }}</td>
    <td class="p-4">{{ $book->author }}</td>
    <td class="p-4">{{ $book->category }}</td>

    <td class="p-4 text-sm">
        <span class="text-green-600">Buy: {{ $book->purchase_price }}</span><br>
        <span class="text-blue-600">Rent: {{ $book->rental_price }}</span>
    </td>

    <td class="p-4 text-right flex gap-2 justify-end">

        <a href="{{ route('admin.books.edit', $book) }}"
           class="text-indigo-600">Edit</a>

        <form method="POST" action="{{ route('admin.books.destroy', $book) }}">
            @csrf
            @method('DELETE')
            <button class="text-red-600">Delete</button>
        </form>

    </td>

</tr>
@endforeach
</tbody>

</table>

@endsection