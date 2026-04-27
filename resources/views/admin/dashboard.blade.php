@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')

<p class="text-sm text-stone-400 -mt-2 mb-6">
    Welcome back — here's what's happening.
</p>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

    {{-- Users --}}
    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-5">
        <div class="flex items-center justify-between mb-4">

            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-base">
                👤
            </div>

            <span class="text-xs text-stone-400">Total</span>

        </div>

        <p class="text-xs font-semibold text-stone-400 uppercase tracking-widest mb-1">
            Users
        </p>

        <p class="text-3xl font-semibold text-stone-800 leading-none">
            {{ number_format($usersCount) }}
        </p>
    </div>

    {{-- Libraries --}}
    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-5">
        <div class="flex items-center justify-between mb-4">

            <div class="w-10 h-10 rounded-xl bg-amber-200 text-amber-800 flex items-center justify-center text-base">
                🏛️
            </div>

            <span class="text-xs text-stone-400">Total</span>

        </div>

        <p class="text-xs font-semibold text-stone-400 uppercase tracking-widest mb-1">
            Libraries
        </p>

        <p class="text-3xl font-semibold text-stone-800 leading-none">
            {{ number_format($librariesCount) }}
        </p>
    </div>

    {{-- Books --}}
    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-5">
        <div class="flex items-center justify-between mb-4">

            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-base">
                📚
            </div>

            <span class="text-xs text-stone-400">Total</span>

        </div>

        <p class="text-xs font-semibold text-stone-400 uppercase tracking-widest mb-1">
            Books
        </p>

        <p class="text-3xl font-semibold text-stone-800 leading-none">
            {{ number_format($booksCount) }}
        </p>
    </div>

    {{-- Transactions --}}
    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-5">
        <div class="flex items-center justify-between mb-4">

            <div class="w-10 h-10 rounded-xl bg-amber-300 text-amber-900 flex items-center justify-center text-base">
                🔄
            </div>

            <span class="text-xs text-stone-400">Total</span>

        </div>

        <p class="text-xs font-semibold text-stone-400 uppercase tracking-widest mb-1">
            Transactions
        </p>

        <p class="text-3xl font-semibold text-stone-800 leading-none">
            {{ number_format($transactionsCount) }}
        </p>
    </div>

</div>

@endsection