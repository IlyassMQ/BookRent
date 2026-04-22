@extends('layouts.app')

@section('title', $library->name)

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded shadow mb-6">
        <h1 class="text-2xl font-bold">{{ $library->name }}</h1>
        <p class="text-gray-500">{{ $library->address }}</p>
    </div>

    {{-- BOOKS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        @foreach($library->books as $book)

        <a href="{{ route('books.show', $book->id) }}">
            <div class="bg-white rounded shadow hover:shadow-lg transition">

                {{-- IMAGE --}}
                <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                     class="w-full h-48 object-cover rounded-t">

                <div class="p-4">

                    <h3 class="font-semibold">{{ $book->title }}</h3>

                    <p class="text-sm text-gray-500">{{ $book->author }}</p>

                    {{-- STOCK --}}
                    @if($book->totalStock > 0)
                        <span class="text-green-600 text-sm">Available</span>
                    @else
                        <span class="text-red-500 text-sm">Out of stock</span>
                    @endif

                </div>

            </div>
        </a>

        @endforeach

    </div>

</div>

@endsection