@extends('layouts.app')

@section('title', 'Order Summary')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-stone-800">
            Order Summary
        </h1>
        <p class="text-sm text-stone-500">
            Review your order before proceeding to payment
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- BOOK --}}
        <div class="bg-white border border-amber-100 rounded-2xl shadow-sm overflow-hidden">

            <div class="h-72 bg-stone-100">
                <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                     class="w-full h-full object-cover">
            </div>

            <div class="p-5">
                <h2 class="text-lg font-semibold text-stone-800">
                    {{ $book->title }}
                </h2>

                <p class="text-sm text-stone-500">
                    {{ $book->author }}
                </p>

                <p class="text-xs text-stone-400 mt-1">
                    {{ $book->category->name ?? 'No Category' }}
                </p>
            </div>

        </div>

        {{-- ORDER DETAILS --}}
        <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-6 flex flex-col justify-between">

            <div>

                {{-- TYPE --}}
                <div class="mb-4">
                    <p class="text-xs text-stone-500">Type</p>
                    <p class="font-semibold text-stone-800 capitalize">
                        {{ $type }}
                    </p>
                </div>

                {{-- QUANTITY --}}
                <div class="mb-4">
                    <p class="text-xs text-stone-500">Quantity</p>
                    <p class="font-semibold text-stone-800">
                        {{ $quantity }}
                    </p>
                </div>

                {{-- RENTAL --}}
                @if($type === 'rental')
                <div class="mb-4">
                    <p class="text-xs text-stone-500">Duration</p>
                    <p class="font-semibold text-stone-800">
                        {{ $days }} day(s)
                    </p>
                </div>
                @endif

                {{-- UNIT PRICE --}}
                <div class="mb-4">
                    <p class="text-xs text-stone-500">Unit Price</p>
                    <p class="font-semibold text-stone-800">
                        {{ $unitPrice }} DH
                    </p>
                </div>

                {{-- TOTAL --}}
                <div class="border-t border-amber-100 pt-4 mt-4">
                    <p class="text-xs text-stone-500">Total</p>
                    <p class="text-2xl font-semibold text-amber-700">
                        {{ $total }} DH
                    </p>
                </div>

            </div>

            {{-- ACTIONS --}}
            <div class="mt-6 flex gap-3">

                <a href="{{ route('books.show', $book->id) }}"
                   class="w-1/2 text-center bg-stone-200 text-stone-700 py-2 rounded-lg hover:bg-stone-300 text-sm">
                    Cancel
                </a>

                <form method="POST" action="{{ route('transactions.checkout') }}" class="w-1/2">
                    @csrf

                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="quantity" value="{{ $quantity }}">
                    <input type="hidden" name="days" value="{{ $days }}">
                    <input type="hidden" name="type" value="{{ $type }}">

                    <button class="w-full bg-amber-700 text-white py-2 rounded-lg hover:bg-amber-800 text-sm font-medium">
                        Confirm & Pay
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

@endsection