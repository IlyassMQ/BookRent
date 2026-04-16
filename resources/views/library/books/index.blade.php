
@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex justify-between mb-6">
        <h2 class="text-xl font-semibold">My Books</h2>

        <a href="{{ route('books.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded">
            + Add Book
        </a>
    </div>

    <table class="w-full bg-white shadow rounded text-sm">

        <thead class="bg-gray-50">
            <tr>
                <th class="p-3 text-left">Title</th>
                <th class="p-3 text-left">Author</th>
                <th class="p-3 text-left">Category</th>
                <th class="p-3 text-left">Prices</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($books as $book)
            <tr class="border-t">

                <td class="p-3">{{ $book->title }}</td>
                <td class="p-3">{{ $book->author }}</td>
                <td class="p-3">{{ $book->category }}</td>

                <td class="p-3">
                    <span class="text-green-600">Buy: {{ $book->purchase_price }}</span><br>
                    <span class="text-blue-600">Rent: {{ $book->rental_price }}</span>
                </td>

                <td class="p-3 text-right flex gap-2 justify-end">

                    <a href="{{ route('books.edit', $book->id) }}"
                       class="text-indigo-600">Edit</a>

                    <form method="POST" action="{{ route('books.destroy', $book->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>

                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection