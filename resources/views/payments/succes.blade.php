@extends('layouts.app')

@section('title', 'Payment Processing')

@section('content')

<div class="max-w-md mx-auto px-4 py-12">

    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-8 text-center">

        {{-- ICON --}}
        <div class="text-4xl mb-4 animate-pulse">⏳</div>

        {{-- TITLE --}}
        <h2 class="text-xl font-semibold text-stone-800 mb-2">
            Payment Processing
        </h2>

        {{-- MESSAGE --}}
        <p class="text-sm text-stone-500 mb-6">
            Your payment is being confirmed. This may take a few seconds.
        </p>

        <p class="text-xs text-stone-400 mb-6">
            You’ll see the updated status in your transactions shortly.
        </p>

        {{-- ACTION --}}
        <a href="{{ route('transactions.index') }}"
           class="block bg-amber-700 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-amber-800 transition">
            Go to My Transactions
        </a>

    </div>

</div>

@endsection