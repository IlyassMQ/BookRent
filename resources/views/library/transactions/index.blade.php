@extends('layouts.app')

@section('title', 'Library Orders')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-stone-800">Incoming Orders</h1>
        <p class="text-sm text-stone-500">Validate pickups and manage transactions</p>
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

            {{-- TOP --}}
            <div class="mb-3">
                <h3 class="text-sm font-semibold text-stone-800 line-clamp-1">
                    {{ $t->book->title }}
                </h3>

                <p class="text-xs text-stone-500">
                    {{ $t->user->name }}
                </p>
            </div>

            {{-- TYPE + QTY --}}
            <div class="flex justify-between text-xs text-stone-600 mb-2">
                <span class="capitalize">{{ $t->type }}</span>
                <span>Qty: {{ $t->quantity }}</span>
            </div>

            {{-- RENTAL --}}
            @if($t->type === 'rental')
            <div class="text-xs text-stone-500 mb-2">
                {{ \Carbon\Carbon::parse($t->rental_start)->format('d M') }}
                →
                {{ \Carbon\Carbon::parse($t->rental_end)->format('d M') }}
            </div>
            @endif

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

            {{-- CODE --}}
            @if($t->status === 'paid' || $t->status === 'completed')
                <div class="mb-4 text-xs">
                    <span class="text-stone-500">Pickup Code:</span>
                    <span class="font-mono bg-stone-100 px-2 py-1 rounded">
                        {{ $t->code_retrait }}
                    </span>
                </div>
            @endif

            {{-- ACTION --}}
            <div class="mt-auto">

                @if($t->status === 'paid')
                    <a href="{{ route('library.withdraw.index') }}"
                       class="block text-center bg-green-600 text-white py-2 rounded-lg text-xs font-medium hover:bg-green-700">
                        Confirm Pickup
                    </a>
                @else
                    <span class="block text-center text-xs text-stone-400">
                        No action
                    </span>
                @endif

            </div>

        </div>

        @endforeach

    </div>

    @endif

</div>

@endsection