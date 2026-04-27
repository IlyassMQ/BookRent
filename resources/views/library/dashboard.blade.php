@extends('layouts.app')

@section('title', 'My Library')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-stone-800">
            {{ $library->name }}
        </h1>
        <p class="text-sm text-stone-500">
            {{ $library->address }}
        </p>
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        <div class="bg-white border border-amber-100 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-stone-500 mb-1">Books</p>
            <p class="text-2xl font-semibold text-stone-800">{{ $booksCount }}</p>
        </div>

        <div class="bg-white border border-amber-100 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-stone-500 mb-1">Total Stock</p>
            <p class="text-2xl font-semibold text-amber-700">{{ $totalStock }}</p>
        </div>

        <div class="bg-white border border-amber-100 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-stone-500 mb-1">Stock Value</p>
            <p class="text-2xl font-semibold text-green-600">{{ $totalValue }} DH</p>
        </div>

    </div>

    {{-- ACTIONS --}}
    <div class="flex flex-wrap gap-3 mb-8">

        <a href="{{ route('library.books.create') }}"
           class="bg-amber-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-amber-800">
            + Add Book
        </a>

        <a href="{{ route('library.stock.index') }}"
           class="bg-stone-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-black">
            Manage Stock
        </a>

        <a href="{{ route('library.withdraw.index') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700">
            Validate Pickup
        </a>

    </div>

    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- BOOKS --}}
        <div class="bg-white border border-amber-100 rounded-2xl shadow-sm">

            <div class="p-4 border-b border-amber-100 flex justify-between items-center">
                <h2 class="text-sm font-semibold text-stone-700">Books</h2>
                <span class="text-xs text-stone-400">{{ $booksCount }}</span>
            </div>

            <div class="divide-y">

                @forelse($books->take(6) as $book)
                <div class="p-4 flex justify-between items-center">

                    <div>
                        <p class="text-sm font-medium text-stone-800">
                            {{ $book->title }}
                        </p>
                        <p class="text-xs text-stone-500">
                            {{ $book->author }}
                        </p>
                    </div>

                    <div class="flex gap-2">

                        <a href="{{ route('library.books.edit', $book->id) }}"
                           class="text-xs text-blue-600 hover:underline">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('library.books.destroy', $book->id) }}"
                              onsubmit="return confirm('Delete this book?')">
                            @csrf
                            @method('DELETE')

                            <button class="text-xs text-red-600 hover:underline">
                                Delete
                            </button>
                        </form>

                    </div>

                </div>

                @empty
                    <div class="p-6 text-center text-stone-400 text-sm">
                        No books yet
                    </div>
                @endforelse

            </div>

        </div>

        {{-- STOCK --}}
        <div class="bg-white border border-amber-100 rounded-2xl shadow-sm">

            <div class="p-4 border-b border-amber-100 flex justify-between items-center">
                <h2 class="text-sm font-semibold text-stone-700">Stock Overview</h2>
            </div>

            <div class="divide-y">

                @forelse($stocks->sortBy('quantity')->take(6) as $stock)
                <div class="p-4 flex justify-between items-center">

                    <div>
                        <p class="text-sm font-medium text-stone-800">
                            {{ $stock->book->title }}
                        </p>
                    </div>

                    <span class="text-sm font-semibold
                        {{ $stock->quantity > 5 ? 'text-green-600' :
                           ($stock->quantity > 0 ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ $stock->quantity }}
                    </span>

                </div>

                @empty
                    <div class="p-6 text-center text-stone-400 text-sm">
                        No stock yet
                    </div>
                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection