@extends('layouts.app')

@section('title', 'Order Details')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('user.orders') }}" class="inline-flex items-center gap-2 text-sm text-stone-600 hover:text-amber-700 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Orders
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
        <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-6 py-4 border-b border-amber-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h1 class="text-xl font-bold serif-font text-[#2C1810]">Order Details</h1>
                </div>
                <span class="text-sm text-stone-500">Order #{{ $transaction->id }}</span>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Book Info --}}
                <div class="space-y-4">
                    <h3 class="font-semibold text-stone-800 border-b border-amber-100 pb-2">Book Information</h3>
                    <div>
                        <p class="text-xs text-stone-400">Title</p>
                        <p class="font-medium">{{ $transaction->book->title }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-stone-400">Author</p>
                        <p class="font-medium">{{ $transaction->book->author }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-stone-400">Category</p>
                        <p class="font-medium">{{ $transaction->book->category->name ?? 'N/A' }}</p>
                    </div>
                </div>

                {{-- Order Info --}}
                <div class="space-y-4">
                    <h3 class="font-semibold text-stone-800 border-b border-amber-100 pb-2">Order Information</h3>
                    <div>
                        <p class="text-xs text-stone-400">Order Type</p>
                        <p class="font-medium capitalize">{{ $transaction->type }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-stone-400">Quantity</p>
                        <p class="font-medium">{{ $transaction->quantity }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-stone-400">Total Amount</p>
                        <p class="text-xl font-bold text-amber-700">{{ number_format($transaction->payment->amount ?? 0, 2) }} DH</p>
                    </div>
                    <div>
                        <p class="text-xs text-stone-400">Status</p>
                        <span class="inline-flex px-2 py-1 text-xs rounded-full 
                            @if($transaction->status === 'completed') bg-emerald-100 text-emerald-700
                            @elseif($transaction->status === 'paid') bg-blue-100 text-blue-700
                            @else bg-yellow-100 text-yellow-700 @endif">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </div>
                </div>
            </div>

            @if($transaction->type === 'rental')
            <div class="mt-6 p-4 bg-blue-50/50 rounded-lg border border-blue-100">
                <h3 class="font-semibold text-stone-800 mb-2">Rental Details</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-stone-400">Start Date</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($transaction->rental_start)->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-stone-400">End Date</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($transaction->rental_end)->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if($transaction->status === 'paid' && $transaction->code_retrait)
            <div class="mt-6 p-4 bg-amber-50/50 rounded-lg border border-amber-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-stone-400">Pickup Code</p>
                        <p class="text-2xl font-mono font-bold text-amber-700">{{ $transaction->code_retrait }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-stone-400">Library</p>
                        <p class="font-medium">{{ $transaction->library->name }}</p>
                        <p class="text-xs text-stone-500">{{ $transaction->library->address }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="mt-6 flex gap-3">
                <a href="{{ route('books.show', $transaction->book->id) }}" 
                   class="flex-1 text-center bg-stone-100 text-stone-700 py-2 rounded-lg hover:bg-stone-200 transition">
                    View Book
                </a>
                <a href="{{ route('home') }}" 
                   class="flex-1 text-center bg-amber-700 text-white py-2 rounded-lg hover:bg-amber-800 transition">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>

</div>

@endsection