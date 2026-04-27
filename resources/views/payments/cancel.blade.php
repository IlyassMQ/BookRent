@extends('layouts.app')

@section('title', 'Payment Cancelled')

@section('content')

<div class="max-w-md mx-auto px-4 py-12">

    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm p-8 text-center">

        {{-- ICON --}}
        <div class="text-4xl mb-4">❌</div>

        {{-- TITLE --}}
        <h2 class="text-xl font-semibold text-stone-800 mb-2">
            Payment Cancelled
        </h2>

        {{-- MESSAGE --}}
        <p class="text-sm text-stone-500 mb-6">
            Your payment was not completed. You can try again anytime.
        </p>

        {{-- ACTIONS --}}
        <div class="flex flex-col gap-3">

            <a href="{{ route('home') }}"
               class="bg-stone-800 text-white py-2 rounded-lg hover:bg-black transition text-sm">
                Back to Home
            </a>

            <a href="{{ url()->previous() }}"
               class="text-sm text-amber-700 hover:underline">
                Try Again
            </a>

        </div>

    </div>

</div>

@endsection