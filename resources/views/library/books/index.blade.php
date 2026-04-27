@extends('layouts.app')

@section('title', 'My Books')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-2xl font-bold text-stone-800">
                My Books
            </h1>
            <p class="text-sm text-stone-500">
                Manage your library catalog
            </p>
        </div>

        <a href="{{ route('books.create') }}"
           class="bg-amber-700 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-amber-800 transition">
            + Add Book
        </a>

    </div>

    {{-- EMPTY --}}
    @if($books->isEmpty())
        <div class="text-center py-16 text-stone-400">
            <div class="text-4xl mb-3">📚</div>
            <p class="font-medium">No books yet</p>
            <p class="text-xs mt-1">Start by adding your first book</p>
        </div>
    @endif

    {{-- GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($books as $book)

        <div class="bg-white border border-amber-100 rounded-2xl shadow-sm hover:shadow-lg transition flex flex-col overflow-hidden">

            {{-- IMAGE --}}
            <div class="h-48 bg-stone-100 overflow-hidden">
                <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                     class="w-full h-full object-cover">
            </div>

            <div class="p-4 flex flex-col flex-1">

                {{-- TITLE --}}
                <h3 class="text-sm font-semibold text-stone-800 line-clamp-1">
                    {{ $book->title }}
                </h3>

                {{-- AUTHOR --}}
                <p class="text-xs text-stone-500">
                    {{ $book->author }}
                </p>

                {{-- CATEGORY --}}
                <p class="text-xs text-stone-400 mb-2">
                    {{ $book->category->name ?? 'No Category' }}
                </p>

                {{-- STOCK --}}
                <div class="mb-2 text-xs font-medium">
                    @if($book->totalStock > 5)
                        <span class="text-green-600">Available</span>
                    @elseif($book->totalStock > 0)
                        <span class="text-yellow-600">Limited stock</span>
                    @else
                        <span class="text-red-600">Out of stock</span>
                    @endif
                </div>

                {{-- PRICES --}}
                <div class="text-xs text-stone-600 mb-4">
                    <p>Buy: <span class="text-amber-700">{{ $book->purchase_price }} DH</span></p>
                    <p>Rent: <span class="text-amber-700">{{ $book->rental_price }} DH/day</span></p>
                </div>

                {{-- ACTIONS --}}
                <div class="mt-auto flex gap-2">

                    <a href="{{ route('books.edit', $book->id) }}"
                       class="flex-1 text-center text-xs bg-stone-800 text-white py-2 rounded-lg hover:bg-black">
                        Edit
                    </a>

                    <form method="POST" action="{{ route('books.destroy', $book->id) }}"
                          class="flex-1">
                        @csrf
                        @method('DELETE')

                        <button class="w-full text-xs bg-red-600 text-white py-2 rounded-lg hover:bg-red-700">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection