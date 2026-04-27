@extends('layouts.app')

@section('title', $library->name)

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-6 mb-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-semibold text-stone-800">
                    {{ $library->name }}
                </h1>

                <p class="text-sm text-stone-500 mt-1">
                    {{ $library->address }}
                </p>
            </div>

            {{-- OPTIONAL STATS --}}
            <div class="flex gap-6 text-sm">

                <div>
                    <p class="text-stone-400">Books</p>
                    <p class="font-semibold text-stone-800">
                        {{ $library->books->count() }}
                    </p>
                </div>

                <div>
                    <p class="text-stone-400">Available</p>
                    <p class="font-semibold text-green-600">
                        {{ $library->books->where('totalStock', '>', 0)->count() }}
                    </p>
                </div>

            </div>

        </div>

    </div>

    {{-- SECTION TITLE --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-stone-800">
            Available Books
        </h2>
        <p class="text-sm text-stone-500">
            Browse books from this library
        </p>
    </div>

    {{-- BOOKS GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($library->books as $book)

        <a href="{{ route('books.show', $book->id) }}"
           class="group bg-white border border-amber-100 rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition flex flex-col">

            {{-- IMAGE --}}
            <div class="h-52 bg-stone-100 overflow-hidden">
                <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
            </div>

            <div class="p-4 flex flex-col flex-1">

                {{-- TITLE --}}
                <h3 class="text-sm font-semibold text-stone-800 line-clamp-1 mb-1">
                    {{ $book->title }}
                </h3>

                {{-- AUTHOR --}}
                <p class="text-xs text-stone-500 mb-2">
                    {{ $book->author }}
                </p>

                {{-- STATUS --}}
                <div class="mt-auto text-xs font-medium">
                    @if($book->totalStock > 5)
                        <span class="text-green-600">Available</span>
                    @elseif($book->totalStock > 0)
                        <span class="text-yellow-600">Limited</span>
                    @else
                        <span class="text-red-500">Out of stock</span>
                    @endif
                </div>

            </div>

        </a>

        @empty

        <div class="col-span-full text-center text-stone-400 py-12">
            <div class="text-4xl mb-3">📚</div>
            <p>No books available in this library</p>
        </div>

        @endforelse

    </div>

</div>

@endsection