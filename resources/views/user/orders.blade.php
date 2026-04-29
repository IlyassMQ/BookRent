@extends('layouts.app')

@section('title', 'My Orders')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
            <p class="text-sm font-semibold text-amber-700 uppercase tracking-wider">Order History</p>
        </div>
        <h1 class="text-3xl font-bold serif-font text-[#2C1810] mb-2">My Orders</h1>
        <p class="text-stone-600">View all your purchases and rentals</p>
    </div>
    
     {{-- Back to Dashboard Link --}}
    <div class="mb-4">
        <a href="{{ route('user.dashboard') }}" class="text-sm text-amber-600 hover:text-amber-700 inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
    

    @if($transactions->isEmpty())
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 p-12 text-center">
            <div class="flex flex-col items-center gap-3">
                <div class="w-20 h-20 rounded-full bg-amber-50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-stone-700">No Orders Yet</h3>
                <p class="text-sm text-stone-400">You haven't made any purchases or rentals yet.</p>
                <a href="{{ route('home') }}" class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-amber-700 text-white rounded-lg hover:bg-amber-800 transition">
                    Browse Books
                </a>
            </div>
        </div>
    @else
        <div class="space-y-4">
            @foreach($transactions as $transaction)
            <div class="bg-white rounded-2xl shadow-lg border border-amber-100 overflow-hidden hover:shadow-xl transition">
                <div class="p-5">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-12 rounded bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-stone-800">{{ $transaction->book->title }}</h3>
                                    <p class="text-xs text-stone-500">by {{ $transaction->book->author }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                                <div>
                                    <p class="text-xs text-stone-400">Type</p>
                                    <p class="font-medium capitalize">{{ $transaction->type }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-stone-400">Quantity</p>
                                    <p class="font-medium">{{ $transaction->quantity }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-stone-400">Total</p>
                                    <p class="font-semibold text-amber-700">{{ number_format($transaction->payment->amount ?? 0, 2) }} DH</p>
                                </div>
                                <div>
                                    <p class="text-xs text-stone-400">Status</p>
                                    <span class="inline-flex px-2 py-0.5 text-xs rounded-full 
                                        @if($transaction->status === 'completed') bg-emerald-100 text-emerald-700
                                        @elseif($transaction->status === 'paid') bg-blue-100 text-blue-700
                                        @else bg-yellow-100 text-yellow-700 @endif">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </div>
                            </div>
                            @if($transaction->type === 'rental' && $transaction->rental_start)
                            <div class="mt-2 text-xs text-stone-500">
                                Rental period: {{ \Carbon\Carbon::parse($transaction->rental_start)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($transaction->rental_end)->format('M d, Y') }}
                            </div>
                            @endif
                            @if($transaction->status === 'paid' && $transaction->code_retrait)
                            <div class="mt-2">
                                <span class="text-xs text-stone-500">Pickup Code:</span>
                                <span class="font-mono text-sm font-bold text-amber-700 ml-2">{{ $transaction->code_retrait }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('user.orders.show', $transaction) }}" 
                               class="px-4 py-2 text-sm bg-stone-100 text-stone-700 rounded-lg hover:bg-stone-200 transition">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $transactions->links() }}
        </div>
    @endif

</div>

@endsection