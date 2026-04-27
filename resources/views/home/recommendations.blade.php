@extends('layouts.app')

@section('title', 'Recommended Books')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-stone-800">
            Recommended for you
        </h1>
        <p class="text-sm text-stone-500 mt-1">
            Based on your interests and activity
        </p>
    </div>

    {{-- EMPTY STATE --}}
    @if($books->isEmpty())
        <div class="text-center py-16 text-stone-400">
            <div class="text-4xl mb-3">📚</div>
            <p class="font-medium">No recommendations yet</p>
            <p class="text-xs mt-1">Try interacting with books to get better suggestions</p>
        </div>
    @endif

    {{-- GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($books as $book)

        <a href="{{ route('books.show', $book->id) }}">
            <div class="bg-white border border-amber-100 rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden flex flex-col">

                {{-- IMAGE --}}
                <div class="h-48 bg-stone-100 overflow-hidden">
                    <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                         class="w-full h-full object-cover hover:scale-105 transition">
                </div>

                <div class="p-4 flex flex-col flex-1">

                    {{-- TITLE --}}
                    <h3 class="font-semibold text-stone-800 line-clamp-1">
                        {{ $book->title }}
                    </h3>

                    {{-- AUTHOR --}}
                    <p class="text-sm text-stone-500">
                        {{ $book->author }}
                    </p>

                    {{-- STOCK --}}
                    <div class="mt-3 text-xs font-medium">
                        @if($book->totalStock > 0)
                            <span class="text-green-600">
                                Available
                            </span>
                        @else
                            <span class="text-red-600">
                                Out of stock
                            </span>
                        @endif
                    </div>

                    {{-- CTA --}}
                    <div class="mt-auto pt-4">
                        <span class="block text-center bg-amber-700 text-white py-2 rounded-lg text-sm font-medium hover:bg-amber-800 transition">
                            View Book
                        </span>
                    </div>

                </div>

            </div>
        </a>

        @endforeach

    </div>

    {{-- PAGINATION --}}
    <div class="mt-10 flex justify-center">
        {{ $books->links() }}
    </div>

</div>

@endsection