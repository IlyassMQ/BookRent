@extends('layouts.app')

@section('title', 'Category: '.$category->name)

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-6 mb-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-semibold text-stone-800">
                    {{ $category->name }}
                </h1>

                <p class="text-sm text-stone-500 mt-1">
                    Books in this category
                </p>
            </div>

            <div class="text-sm text-stone-500">
                {{ $books->total() }} book(s)
            </div>

        </div>

    </div>

    {{-- BACK --}}
    <a href="{{ route('home') }}"
       class="text-sm text-stone-500 hover:text-amber-700 mb-6 inline-block">
        ← Back to Home
    </a>

    {{-- GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($books as $book)

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

                {{-- STOCK --}}
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
            <p>No books found in this category</p>
        </div>

        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-8 flex justify-center">
        {{ $books->links() }}
    </div>

</div>

@endsection