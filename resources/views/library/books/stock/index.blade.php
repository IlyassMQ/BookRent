@extends('layouts.app')

@section('title', 'Stock Management')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-stone-800">
            Stock Management
        </h1>
        <p class="text-sm text-stone-500">
            Manage your book inventory
        </p>
    </div>

    {{-- ADD STOCK --}}
    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-5 mb-8">

        <h3 class="text-sm font-semibold text-stone-700 mb-3">
            Add / Increase Stock
        </h3>

        <form method="POST" action="{{ route('library.stock.store') }}" class="grid md:grid-cols-3 gap-3">
            @csrf

            <select name="book_id"
                    class="border border-stone-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-amber-500">
                @foreach(auth()->user()->library->books as $book)
                    <option value="{{ $book->id }}">
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="quantity"
                   placeholder="Quantity"
                   class="border border-stone-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-amber-500">

            <button class="bg-amber-700 text-white rounded-lg hover:bg-amber-800">
                Add Stock
            </button>

        </form>

    </div>

    {{-- STOCK LIST --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($stocks as $stock)

        <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-4 flex flex-col">

            {{-- BOOK --}}
            <h3 class="text-sm font-semibold text-stone-800 line-clamp-1">
                {{ $stock->book->title }}
            </h3>

            <p class="text-xs text-stone-500 mb-3">
                {{ $stock->book->author }}
            </p>

            {{-- QUANTITY --}}
            <div class="mb-4 text-sm">
                <span class="text-stone-600">Stock:</span>
                <span class="font-semibold text-amber-700">
                    {{ $stock->quantity }}
                </span>
            </div>

            {{-- UPDATE --}}
            <form method="POST"
                  action="{{ route('library.stock.update', $stock->id) }}"
                  class="flex gap-2 mb-2">
                @csrf
                @method('PUT')

                <input type="number"
                       name="quantity"
                       value="{{ $stock->quantity }}"
                       class="border border-stone-300 px-2 py-1 rounded w-full">

                <button class="bg-stone-800 text-white px-3 rounded hover:bg-black text-xs">
                    Update
                </button>
            </form>

            {{-- DELETE --}}
            <form method="POST"
                  action="{{ route('library.stock.destroy', $stock->id) }}">
                @csrf
                @method('DELETE')

                <button class="w-full text-xs bg-red-600 text-white py-2 rounded-lg hover:bg-red-700">
                    Remove Stock
                </button>
            </form>

        </div>

        @endforeach

    </div>

</div>

@endsection