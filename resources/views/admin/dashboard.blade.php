@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')

<p class="text-sm text-gray-400 -mt-2 mb-6">Welcome back — here's what's happening.</p>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

    {{-- Users --}}
    <div class="relative bg-white border border-gray-100 rounded-2xl shadow-sm p-5 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-0.5 bg-blue-500 rounded-t-2xl"></div>
        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-base mb-4">👤</div>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Users</p>
        <p class="text-3xl font-semibold text-blue-600 leading-none">{{ number_format($usersCount) }}</p>
    </div>

    {{-- Libraries --}}
    <div class="relative bg-white border border-gray-100 rounded-2xl shadow-sm p-5 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-0.5 bg-emerald-500 rounded-t-2xl"></div>
        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base mb-4">🏛️</div>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Libraries</p>
        <p class="text-3xl font-semibold text-emerald-700 leading-none">{{ number_format($librariesCount) }}</p>
    </div>

    {{-- Books --}}
    <div class="relative bg-white border border-gray-100 rounded-2xl shadow-sm p-5 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-0.5 bg-indigo-500 rounded-t-2xl"></div>
        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-base mb-4">📚</div>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Books</p>
        <p class="text-3xl font-semibold text-indigo-600 leading-none">{{ number_format($booksCount) }}</p>
    </div>

    {{-- Transactions --}}
    <div class="relative bg-white border border-gray-100 rounded-2xl shadow-sm p-5 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-0.5 bg-amber-400 rounded-t-2xl"></div>
        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-base mb-4">🔄</div>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Transactions</p>
        <p class="text-3xl font-semibold text-amber-600 leading-none">{{ number_format($transactionsCount) }}</p>
    </div>

</div>

@endsection