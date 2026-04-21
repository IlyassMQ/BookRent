@extends('layouts.app')

@section('title', 'Order Summary')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-6">Order Summary</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- BOOK INFO --}}
        <div>
            <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                 class="w-full h-72 object-cover rounded-lg mb-4">

            <h2 class="text-xl font-semibold">{{ $book->title }}</h2>

            <p class="text-gray-600">Author: {{ $book->author }}</p>
            <p class="text-gray-500">
                Category: {{ $book->category->name ?? 'No Category' }}
            </p>
        </div>

        {{-- ORDER DETAILS --}}
        <div class="flex flex-col justify-between">

            <div>

                {{-- TYPE --}}
                <div class="mb-4">
                    <span class="text-sm text-gray-500">Type</span>
                    <p class="font-semibold text-lg capitalize">
                        {{ $type }}
                    </p>
                </div>

                {{-- QUANTITY --}}
                <div class="mb-4">
                    <span class="text-sm text-gray-500">Quantity</span>
                    <p class="font-semibold">{{ $quantity }}</p>
                </div>

                {{-- RENT DETAILS --}}
                @if($type === 'rental')
                    <div class="mb-4">
                        <span class="text-sm text-gray-500">Days</span>
                        <p class="font-semibold">{{ $days }}</p>
                    </div>
                @endif

                {{-- UNIT PRICE --}}
                <div class="mb-4">
                    <span class="text-sm text-gray-500">Unit Price</span>
                    <p class="font-semibold">
                        {{ $unitPrice }} DH
                    </p>
                </div>

                {{-- TOTAL --}}
                <div class="mb-6 border-t pt-4">
                    <span class="text-sm text-gray-500">Total</span>
                    <p class="text-2xl font-bold text-indigo-600">
                        {{ $total }} DH
                    </p>
                </div>

            </div>

            {{-- ACTIONS --}}
            <div class="flex gap-3">

                {{-- BACK --}}
                <a href="{{ route('books.show', $book->id) }}"
                   class="w-1/2 text-center bg-gray-300 py-2 rounded hover:bg-gray-400">
                    Cancel
                </a>

                {{-- CONFIRM --}}
                <form method="POST" action="{{ route('transactions.checkout') }}" class="w-1/2">
                    @csrf

                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="quantity" value="{{ $quantity }}">
                    <input type="hidden" name="days" value="{{ $days }}">
                    <input type="hidden" name="type" value="{{ $type }}">

                    <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
                        Confirm & Pay
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

@endsection