@extends('layouts.app')

@section('title', 'Recommended Books')

@section('content')

<div class="max-w-7xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        Recommended for you
    </h1>

    @if($books->isEmpty())
        <p class="text-gray-500">
            No recommendations yet. Try selecting more interests.
        </p>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($books as $book)

        <a href="{{ route('books.show', $book->id) }}">
            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition">

                {{-- IMAGE --}}
                <div class="h-48 bg-gray-100">
                    <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                         class="w-full h-full object-cover">
                </div>

                <div class="p-4">

                    {{-- TITLE --}}
                    <h3 class="font-semibold line-clamp-1">
                        {{ $book->title }}
                    </h3>

                    {{-- AUTHOR --}}
                    <p class="text-sm text-gray-500">
                        {{ $book->author }}
                    </p>

                    {{-- STOCK --}}
                    <div class="mt-2 text-sm">
                        @if($book->totalStock > 0)
                            <span class="text-green-600">
                                Available
                            </span>
                        @else
                            <span class="text-red-500">
                                Out of stock
                            </span>
                        @endif
                    </div>

                </div>

            </div>
        </a>

        @endforeach

    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $books->links() }}
    </div>

</div>

@endsection