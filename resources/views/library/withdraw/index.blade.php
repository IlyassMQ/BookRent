@extends('layouts.app')

@section('title', 'Validate Pickup')

@section('content')

<div class="max-w-xl mx-auto px-4 py-8">

    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-6">

        {{-- HEADER --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-stone-800">
                Validate Pickup
            </h2>
            <p class="text-sm text-stone-500">
                Enter the customer code to confirm the pickup
            </p>
        </div>

        {{-- ALERTS --}}
        @if(session('success'))
            <div class="bg-green-50 text-green-700 px-3 py-2 rounded-lg mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 text-red-600 px-3 py-2 rounded-lg mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- SEARCH --}}
        <form method="POST"
              action="{{ route('library.withdraw.search') }}"
              class="mb-6">
            @csrf

            <div class="flex gap-2">
                <input type="text"
                       name="code"
                       placeholder="Enter pickup code"
                       class="w-full border border-stone-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-amber-500">

                <button class="bg-amber-700 text-white px-4 rounded-lg hover:bg-amber-800">
                    Search
                </button>
            </div>

        </form>

        {{-- RESULT --}}
        @isset($transaction)

        <div class="border-t border-amber-100 pt-5">

            <h3 class="text-sm font-semibold text-stone-700 mb-4">
                Transaction Details
            </h3>

            <div class="space-y-2 text-sm text-stone-600">

                <p><span class="text-stone-400">User:</span> {{ $transaction->user->name }}</p>

                <p><span class="text-stone-400">Book:</span> {{ $transaction->book->title }}</p>

                <p><span class="text-stone-400">Type:</span>
                    <span class="capitalize">{{ $transaction->type }}</span>
                </p>

                <p><span class="text-stone-400">Quantity:</span> {{ $transaction->quantity }}</p>

                <p>
                    <span class="text-stone-400">Total:</span>
                    <span class="font-semibold text-amber-700">
                        {{ $transaction->payment->amount }} DH
                    </span>
                </p>

                @if($transaction->type === 'rental')
                    <p>
                        <span class="text-stone-400">Rental:</span>
                        {{ \Carbon\Carbon::parse($transaction->rental_start)->format('d M') }}
                        →
                        {{ \Carbon\Carbon::parse($transaction->rental_end)->format('d M') }}
                    </p>
                @endif

                {{-- STATUS --}}
                <p class="mt-2">
                    <span class="text-stone-400">Status:</span>

                    <span class="px-2 py-1 rounded text-xs font-medium
                        @if($transaction->status === 'paid')
                            bg-blue-50 text-blue-700
                        @elseif($transaction->status === 'completed')
                            bg-green-50 text-green-700
                        @else
                            bg-red-50 text-red-700
                        @endif">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </p>

            </div>

            {{-- ACTION --}}
            <div class="mt-6">

                @if($transaction->status === 'paid')

                    <form method="POST"
                          action="{{ route('library.withdraw.confirm') }}">
                        @csrf

                        <input type="hidden"
                               name="code"
                               value="{{ $transaction->code_retrait }}">

                        <button class="w-full bg-green-600 text-white py-2.5 rounded-lg font-medium hover:bg-green-700">
                            Confirm Pickup
                        </button>
                    </form>

                @elseif($transaction->status === 'completed')

                    <div class="text-center text-green-600 text-sm font-medium">
                        Already completed
                    </div>

                @else

                    <div class="text-center text-red-500 text-sm">
                        Invalid transaction state
                    </div>

                @endif

            </div>

        </div>

        @endisset

    </div>

</div>

@endsection