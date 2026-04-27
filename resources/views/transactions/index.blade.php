@extends('layouts.app')

@section('title', 'My Orders')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-stone-800">
            My Orders
        </h1>
        <p class="text-sm text-stone-500">
            Track your purchases and rentals
        </p>
    </div>

    {{-- EMPTY --}}
    @if($transactions->isEmpty())
        <div class="bg-white border border-amber-100 rounded-2xl p-10 text-center text-stone-400">
            <div class="text-4xl mb-3">📦</div>
            <p class="font-medium">No transactions yet</p>
        </div>
    @else

    {{-- GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($transactions as $t)

        <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-5 flex flex-col">

            {{-- BOOK --}}
            <div class="mb-3">
                <a href="{{ route('books.show', $t->book->id) }}"
                   class="text-sm font-semibold text-stone-800 hover:underline">
                    {{ $t->book->title }}
                </a>

                <p class="text-xs text-stone-500">
                    {{ ucfirst($t->type) }}
                </p>
            </div>

            {{-- DETAILS --}}
            <div class="text-xs text-stone-600 space-y-1 mb-3">

                <p>Quantity: {{ $t->quantity }}</p>

                @if($t->type === 'rental')
                    <p>
                        {{ \Carbon\Carbon::parse($t->rental_start)->format('d M') }}
                        →
                        {{ \Carbon\Carbon::parse($t->rental_end)->format('d M') }}
                    </p>
                @endif

            </div>

            {{-- TOTAL --}}
            <div class="text-sm font-semibold text-amber-700 mb-3">
                {{ $t->payment->amount ?? 0 }} DH
            </div>

            {{-- STATUS --}}
            <div class="mb-3">
                <span class="px-2 py-1 rounded text-xs font-medium
                    @if($t->status === 'pending')
                        bg-yellow-50 text-yellow-700
                    @elseif($t->status === 'paid')
                        bg-blue-50 text-blue-700
                    @elseif($t->status === 'completed')
                        bg-green-50 text-green-700
                    @else
                        bg-red-50 text-red-700
                    @endif">
                    {{ ucfirst($t->status) }}
                </span>
            </div>

            {{-- CODE / ACTION --}}
            <div class="mt-auto text-xs">

                @if($t->status === 'paid')
                    <div class="bg-stone-100 p-2 rounded mb-2">
                        <p class="text-stone-500">Pickup Code</p>
                        <p class="font-mono text-sm text-stone-800">
                            {{ $t->code_retrait }}
                        </p>
                    </div>

                    <p class="text-green-600 font-medium">
                        Go to library to collect your book
                    </p>

                @elseif($t->status === 'completed')
                    <p class="text-green-600 font-medium">
                        Completed
                    </p>

                @elseif($t->status === 'pending')
                    <p class="text-yellow-600">
                        Waiting for payment confirmation
                    </p>

                @else
                    <p class="text-red-500">
                        Transaction cancelled
                    </p>
                @endif

            </div>

        </div>

        @endforeach

    </div>

    @endif

</div>

@endsection