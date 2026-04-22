@extends('layouts.app')

@section('title', 'Validate Pickup')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Validate Pickup</h2>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- SEARCH FORM --}}
    <form method="POST" action="{{ route('library.withdraw.search') }}" class="mb-4">
        @csrf

        <input type="text" name="code" placeholder="Enter retrait code"
               class="w-full border p-2 rounded mb-2">

        <button class="w-full bg-indigo-600 text-white py-2 rounded">
            Search
        </button>
    </form>

    {{-- RESULT --}}
    @isset($transaction)

    <div class="border-t pt-4 mt-4">

        <h3 class="font-semibold mb-3">Transaction Info</h3>

        <p><strong>User:</strong> {{ $transaction->user->name }}</p>
        <p><strong>Book:</strong> {{ $transaction->book->title }}</p>
        <p><strong>Type:</strong> {{ $transaction->type }}</p>
        <p><strong>Quantity:</strong> {{ $transaction->quantity }}</p>
        <p><strong>Total:</strong> {{ $transaction->payment->amount }} DH</p>

        @if($transaction->type === 'rental')
            <p><strong>Rental:</strong>
                {{ \Carbon\Carbon::parse($transaction->rental_start)->format('d M') }}
                →
                {{ \Carbon\Carbon::parse($transaction->rental_end)->format('d M') }}
            </p>
        @endif

        <p class="mt-2">
            <strong>Status:</strong>
            <span class="text-blue-600">{{ $transaction->status }}</span>
        </p>

        {{-- CONFIRM --}}
        @if($transaction->status === 'paid')
            <form method="POST" action="{{ route('library.withdraw.confirm') }}" class="mt-4">
                @csrf

                <input type="hidden" name="code" value="{{ $transaction->code_retrait }}">

                <button class="w-full bg-green-600 text-white py-2 rounded">
                    Confirm Pickup
                </button>
            </form>
        @endif

    </div>

    @endisset

</div>

@endsection