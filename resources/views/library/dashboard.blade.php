{{-- resources/views/library/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'My Library')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ $library->name }}</h1>
        <p class="text-gray-500">{{ $library->address }}</p>
    </div>

    {{-- ACTION BUTTONS --}}
    <div class="flex gap-3 mb-6">

        <a href="{{ route('library.books.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded">
            + Add Book
        </a>

        <a href="{{ route('library.stock.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded">
            Manage Stock
        </a>

    </div>

    {{-- BOOKS SECTION --}}
    <div class="mb-8">

        <h2 class="text-lg font-semibold mb-3">My Books</h2>

        @if($books->isEmpty())
            <p class="text-gray-500">No books yet</p>
        @else
            <table class="w-full bg-white shadow rounded text-sm">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">Title</th>
                        <th class="p-3 text-left">Author</th>
                        <th class="p-3 text-left">Category</th>
                        <th class="p-3 text-left">ISBN</th>
                        <th class="p-3 text-right">Actions</th> {{-- ADD THIS --}}
                    </tr>
                </thead>

                <tbody>
                    @foreach($books as $book)
                    <tr class="border-t">
                        <td class="p-3">{{ $book->title }}</td>
                        <td class="p-3">{{ $book->author }}</td>
                        <td class="p-3">{{ $book->category }}</td>
                        <td class="p-3">{{ $book->isbn }}</td>
                        {{-- ACTIONS --}}
                    <td class="p-3 text-right">

                        <a href="{{ route('library.books.edit', $book->id) }}"
                        class="text-blue-600 hover:underline mr-2">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form method="POST" action="{{ route('library.books.destroy', $book->id) }}"
                            onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </form>

                    </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        @endif

    </div>

    {{-- STOCK SECTION --}}
    <div>

        <h2 class="text-lg font-semibold mb-3">My Stock</h2>

        @if($stocks->isEmpty())
            <p class="text-gray-500">No stock available</p>
        @else
            <table class="w-full bg-white shadow rounded text-sm">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">Book</th>
                        <th class="p-3 text-left">Quantity</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($stocks as $stock)
                    <tr class="border-t">
                        <td class="p-3">{{ $stock->book->title }}</td>
                        <td class="p-3">{{ $stock->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        @endif

    </div>

</div>

@endsection