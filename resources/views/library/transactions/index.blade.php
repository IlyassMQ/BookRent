@extends('layouts.app')

@section('title', 'Library Orders')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER SECTION --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
            <p class="text-sm font-semibold text-amber-700 uppercase tracking-wider">Order Management</p>
        </div>
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold serif-font text-[#2C1810] mb-2">
                    Incoming Orders
                </h1>
                <p class="text-stone-600">
                    <span class="inline-flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Validate pickups and manage transactions
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- STATS OVERVIEW --}}
    @if($transactions->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
            <div class="bg-gradient-to-r from-yellow-50 to-transparent rounded-xl p-4 border border-yellow-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-yellow-700 font-semibold">Pending</p>
                        <p class="text-2xl font-bold text-yellow-800">{{ $transactions->where('status', 'pending')->count() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-blue-50 to-transparent rounded-xl p-4 border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-blue-700 font-semibold">Paid (Ready)</p>
                        <p class="text-2xl font-bold text-blue-800">{{ $transactions->where('status', 'paid')->count() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-r from-emerald-50 to-transparent rounded-xl p-4 border border-emerald-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-emerald-700 font-semibold">Completed</p>
                        <p class="text-2xl font-bold text-emerald-800">{{ $transactions->where('status', 'completed')->count() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-4 border border-amber-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-amber-700 font-semibold">Total Revenue</p>
                        <p class="text-2xl font-bold text-amber-800">{{ number_format($transactions->sum(fn($t) => $t->payment->amount ?? 0), 0) }} DH</p>
                    </div>
                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                    </svg>
                </div>
            </div>
        </div>
    @endif

    {{-- EMPTY STATE --}}
    @if($transactions->isEmpty())
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 p-16 text-center">
            <div class="flex flex-col items-center gap-4">
                <div class="w-24 h-24 rounded-full bg-amber-50 flex items-center justify-center">
                    <svg class="w-12 h-12 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-stone-700">No Orders Yet</h3>
                <p class="text-stone-400 max-w-md">When customers place orders, they will appear here for you to manage and validate.</p>
            </div>
        </div>
    @else
        {{-- ORDERS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($transactions as $t)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border hover:border-amber-300 transform hover:-translate-y-1">
                    
                    {{-- Card Header with Status Color Bar --}}
                    <div class="relative">
                        <div class="absolute top-0 left-0 w-1 h-full 
                            @if($t->status === 'pending') bg-yellow-500
                            @elseif($t->status === 'paid') bg-blue-500
                            @elseif($t->status === 'completed') bg-emerald-500
                            @else bg-red-500 @endif">
                        </div>
                        
                        <div class="p-5">
                            {{-- Book Info --}}
                            <div class="mb-3">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-base font-bold serif-font text-[#2C1810] group-hover:text-amber-700 transition-colors line-clamp-1">
                                            {{ $t->book->title }}
                                        </h3>
                                        <div class="flex items-center gap-1 mt-1">
                                            <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <p class="text-xs text-stone-600">
                                                {{ $t->user->name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs font-mono text-stone-400">#{{ str_pad($t->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Order Details --}}
                            <div class="grid grid-cols-2 gap-3 mb-3 p-3 bg-amber-50/50 rounded-lg border border-amber-100">
                                <div>
                                    <p class="text-xs text-stone-500">Order Type</p>
                                    <p class="text-sm font-semibold capitalize 
                                        @if($t->type === 'purchase') text-emerald-600
                                        @else text-blue-600 @endif">
                                        {{ $t->type }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-stone-500">Quantity</p>
                                    <p class="text-sm font-semibold text-stone-700">{{ $t->quantity }}</p>
                                </div>
                            </div>

                            {{-- Rental Dates --}}
                            @if($t->type === 'rental')
                                <div class="mb-3 p-2 bg-blue-50/50 rounded-lg border border-blue-100">
                                    <div class="flex items-center justify-between text-xs">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-stone-600">Start:</span>
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($t->rental_start)->format('d M Y') }}</span>
                                        </div>
                                        <svg class="w-3 h-3 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7"></path>
                                        </svg>
                                        <div class="flex items-center gap-1">
                                            <span class="text-stone-600">End:</span>
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($t->rental_end)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Price --}}
                            <div class="mb-3 p-2 bg-emerald-50/30 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-stone-500">Total Amount</span>
                                    <span class="text-xl font-bold text-emerald-700">{{ number_format($t->payment->amount ?? 0, 2) }} DH</span>
                                </div>
                            </div>

                            {{-- Status Badge --}}
                            <div class="mb-3">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold
                                    @if($t->status === 'pending') bg-yellow-50 text-yellow-700 border border-yellow-200
                                    @elseif($t->status === 'paid') bg-blue-50 text-blue-700 border border-blue-200
                                    @elseif($t->status === 'completed') bg-emerald-50 text-emerald-700 border border-emerald-200
                                    @else bg-red-50 text-red-700 border border-red-200 @endif">
                                    @if($t->status === 'pending')
                                        <svg class="w-3 h-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @elseif($t->status === 'paid')
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @elseif($t->status === 'completed')
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    @else
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    @endif
                                    {{ ucfirst($t->status) }}
                                </span>
                            </div>

                            {{-- Pickup Code --}}
                            @if($t->status === 'paid' || $t->status === 'completed')
                                <div class="mb-4 p-2 bg-stone-100 rounded-lg border border-stone-200">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-stone-500">Pickup Code:</span>
                                        <div class="font-mono font-bold text-amber-700 bg-white px-2 py-1 rounded border border-amber-200">
                                            {{ $t->code_retrait }}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Action Button --}}
                            <div class="mt-auto pt-2">
                                @if($t->status === 'paid')
                                    <a href="{{ route('library.withdraw.index') }}"
                                       class="inline-flex items-center justify-center gap-2 w-full bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white py-2.5 rounded-lg transition-all duration-300 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                        </svg>
                                        Confirm Pickup
                                    </a>
                                @elseif($t->status === 'pending')
                                    <div class="text-center text-xs text-stone-400 py-2">
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Awaiting payment confirmation
                                        </span>
                                    </div>
                                @elseif($t->status === 'completed')
                                    <div class="text-center text-xs text-emerald-600 py-2">
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Order completed
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($transactions, 'links') && $transactions->hasPages())
            <div class="mt-10 flex justify-center">
                <div class="bg-white rounded-xl shadow-md border border-amber-100 px-4 py-2">
                    {{ $transactions->links() }}
                </div>
            </div>
        @endif
    @endif

</div>

@endsection