{{-- resources/views/library/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'My Library')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ $library->name }}</h1>
        <p class="text-gray-500">{{ $library->address }}</p>
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

        <div class="bg-white p-5 rounded-xl shadow flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Books</p>
                <p class="text-2xl font-bold">{{ $booksCount }}</p>
            </div>
            <div class="text-indigo-500 text-3xl">📚</div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Stock</p>
                <p class="text-2xl font-bold">{{ $totalStock }}</p>
            </div>
            <div class="text-green-500 text-3xl">📦</div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Stock Value</p>
                <p class="text-2xl font-bold">{{ $totalValue }} DH</p>
            </div>
            <div class="text-yellow-500 text-3xl">💰</div>
        </div>

    </div>

    {{-- ACTIONS --}}
    <div class="flex gap-3 mb-6">
        <a href="{{ route('library.books.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Add Book
        </a>

        <a href="{{ route('library.stock.index') }}"
           class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
            Manage Stock
        </a>
    </div>

    {{-- BOOKS TABLE --}}
    <div class="mb-10">

        <h2 class="text-lg font-semibold mb-3">My Books</h2>

        <div class="overflow-x-auto bg-white rounded-xl shadow">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-3 text-left">Title</th>
                        <th class="p-3 text-left">Author</th>
                        <th class="p-3 text-left">Category</th>
                        <th class="p-3 text-left">ISBN</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($books as $book)
                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-3 font-medium">{{ $book->title }}</td>
                        <td class="p-3">{{ $book->author }}</td>
                        <td class="p-3">{{ $book->category->name ?? 'No Category' }}</td>
                        <td class="p-3 text-gray-500">{{ $book->isbn }}</td>

                        <td class="p-3 text-right flex justify-end gap-2">

                            <a href="{{ route('library.books.edit', $book->id) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('library.books.destroy', $book->id) }}"
                                  onsubmit="return confirm('Delete this book?')">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>

                        </td>

                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">
                                No books yet
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- STOCK TABLE --}}
    <div>

        <h2 class="text-lg font-semibold mb-3">My Stock</h2>

        <div class="overflow-x-auto bg-white rounded-xl shadow">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-3 text-left">Book</th>
                        <th class="p-3 text-left">Quantity</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($stocks as $stock)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $stock->book->title }}</td>
                        <td class="p-3 font-medium">{{ $stock->quantity }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="p-4 text-center text-gray-500">
                                No stock yet
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection