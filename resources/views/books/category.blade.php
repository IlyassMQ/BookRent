@extends('layouts.app')

@section('title', 'Category: '.$category->name)

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            Category: {{ $category->name }}
        </h1>
        <p class="text-gray-500 text-sm">
            Browse all books in this category
        </p>
    </div>
<a href="{{ url('/') }}" class="text-sm text-gray-500 hover:underline mb-4 inline-block">
    ← Back to Home
</a>
    {{-- GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($books as $book)

        <a href="{{ route('books.show', $book->id) }}">
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">

                <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                     class="w-full h-48 object-cover rounded-t-xl">

                <div class="p-4">

                    <h3 class="font-semibold text-sm line-clamp-1">
                        {{ $book->title }}
                    </h3>

                    <p class="text-xs text-gray-500">
                        {{ $book->author }}
                    </p>

                    @if($book->totalStock > 0)
                        <span class="text-green-600 text-xs">Available</span>
                    @else
                        <span class="text-red-500 text-xs">Out of stock</span>
                    @endif

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