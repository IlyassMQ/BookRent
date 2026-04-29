@extends('layouts.app')

@section('title', 'Books Near You')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-6 mb-8">

        <h1 class="text-2xl font-semibold text-stone-800">
            📍 Books near you
        </h1>

        <p class="text-sm text-stone-500 mt-1">
            Showing books available in {{ auth()->user()->city }}
        </p>

    </div>

    {{-- GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($books as $book)

            <a href="{{ route('books.show', $book->id) }}"
               class="group bg-white border border-amber-100 rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition flex flex-col">

                <div class="h-52 bg-stone-100">
                    <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition">
                </div>

                <div class="p-4 flex flex-col flex-1">

                    <h3 class="text-sm font-semibold text-stone-800 line-clamp-1">
                        {{ $book->title }}
                    </h3>

                    <p class="text-xs text-stone-500">
                        {{ $book->author }}
                    </p>

                    <p class="text-xs text-amber-700 mt-1">
                        {{ $book->library->name ?? '' }}
                    </p>

                    <div class="mt-auto text-xs font-medium">
                        @if($book->totalStock > 0)
                            <span class="text-green-600">Available</span>
                        @else
                            <span class="text-red-500">Out of stock</span>
                        @endif
                    </div>

                </div>

            </a>

        @empty

            <div class="col-span-full text-center text-stone-400 py-12">
                No books found in your city
            </div>

        @endforelse

    </div>

    <div class="mt-8 flex justify-center">
        {{ $books->links() }}
    </div>

</div>

@endsection