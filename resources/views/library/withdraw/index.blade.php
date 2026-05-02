@extends('layouts.app')

@section('title', 'Validate Pickup')

@section('content')

<div class="max-w-2xl mx-auto px-4 py-8">

    {{-- BREADCRUMB NAVIGATION --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-stone-500">
            <a href="{{ route('library.transactions.index') }}" class="hover:text-amber-700 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Orders
            </a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-amber-700 font-semibold">Validate Pickup</span>
        </div>
    </div>

    {{-- MAIN CARD --}}
    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
        
        {{-- CARD HEADER --}}
        <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-6 py-4 border-b border-amber-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-600 to-emerald-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold serif-font text-[#2C1810]">
                        Validate Pickup
                    </h2>
                    <p class="text-xs text-stone-500">
                        Enter the customer code to confirm the pickup
                    </p>
                </div>
            </div>
        </div>

        {{-- CARD BODY --}}
        <div class="p-6">

            {{-- ALERTS --}}
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-600 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm text-emerald-800">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-600 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm text-red-800">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            {{-- SEARCH FORM --}}
            <form method="POST" action="{{ route('library.withdraw.search') }}" class="mb-6">
                @csrf

                <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                    <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Pickup Code
                </label>
                
                <div class="flex gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </div>
                        <input type="text"
                               name="code"
                               placeholder="Enter pickup code (e.g., ABC123)"
                               class="w-full pl-10 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all font-mono">
                    </div>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white rounded-lg transition-all duration-300 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </span>
                    </button>
                </div>
                <p class="text-xs text-stone-400 mt-2">Enter the unique pickup code provided to the customer</p>
            </form>

            {{-- TRANSACTION RESULT --}}
            @isset($transaction)
                <div class="border-t-2 border-amber-200 pt-6 mt-2">
                    
                    {{-- Result Header --}}
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-1 h-6 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
                        <h3 class="text-md font-bold serif-font text-[#2C1810]">
                            Transaction Details
                        </h3>
                    </div>

                    {{-- Transaction Info Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        {{-- User --}}
                        <div class="p-3 bg-amber-50/50 rounded-lg border border-amber-100">
                            <p class="text-xs text-stone-500 mb-1">Customer</p>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-stone-800">{{ $transaction->user->name }}</span>
                            </div>
                        </div>

                        {{-- Book --}}
                        <div class="p-3 bg-amber-50/50 rounded-lg border border-amber-100">
                            <p class="text-xs text-stone-500 mb-1">Book</p>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <span class="font-medium text-stone-800">{{ $transaction->book->title }}</span>
                            </div>
                        </div>

                        {{-- Type & Quantity --}}
                        <div class="p-3 bg-amber-50/50 rounded-lg border border-amber-100">
                            <p class="text-xs text-stone-500 mb-1">Order Type</p>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs rounded-full font-medium
                                    @if($transaction->type === 'purchase') bg-emerald-100 text-emerald-700
                                    @else bg-blue-100 text-blue-700 @endif">
                                    @if($transaction->type === 'purchase')
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                                        </svg>
                                    @else
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                    {{ ucfirst($transaction->type) }}
                                </span>
                                <span class="text-stone-600">Qty: {{ $transaction->quantity }}</span>
                            </div>
                        </div>

                        {{-- Total Amount --}}
                        <div class="p-3 bg-emerald-50/50 rounded-lg border border-emerald-100">
                            <p class="text-xs text-stone-500 mb-1">Total Amount</p>
                            <p class="text-xl font-bold text-emerald-700">{{ number_format($transaction->payment->amount ?? 0, 2) }} DH</p>
                        </div>
                    </div>

                    {{-- Rental Dates (if applicable) --}}
                    @if($transaction->type === 'rental')
                        <div class="mb-4 p-3 bg-blue-50/50 rounded-lg border border-blue-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-sm text-stone-600">Rental Period:</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-stone-800">{{ \Carbon\Carbon::parse($transaction->rental_start)->format('d M Y') }}</span>
                                    <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7"></path>
                                    </svg>
                                    <span class="font-medium text-stone-800">{{ \Carbon\Carbon::parse($transaction->rental_end)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Current Status --}}
                    <div class="mb-6 p-3 rounded-lg border-2
                        @if($transaction->status === 'paid') bg-blue-50 border-blue-200
                        @elseif($transaction->status === 'completed') bg-emerald-50 border-emerald-200
                        @else bg-red-50 border-red-200 @endif">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-stone-600">Current Status:</span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold
                                @if($transaction->status === 'paid') bg-blue-100 text-blue-700
                                @elseif($transaction->status === 'completed') bg-emerald-100 text-emerald-700
                                @else bg-red-100 text-red-700 @endif">
                                @if($transaction->status === 'paid')
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @elseif($transaction->status === 'completed')
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                @endif
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <div class="mt-6">
                        @if($transaction->status === 'paid')
                            <form method="POST" action="{{ route('library.withdraw.confirm') }}">
                                @csrf
                                <input type="hidden" name="code" value="{{ $transaction->code_retrait }}">
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white py-3 rounded-lg transition-all duration-300 font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                        </svg>
                                        Confirm Pickup & Complete Order
                                    </span>
                                </button>
                            </form>
                        @elseif($transaction->status === 'completed')
                            <div class="text-center p-4 bg-emerald-50 rounded-lg border border-emerald-200">
                                <div class="flex items-center justify-center gap-2 text-emerald-700">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">Order already completed</span>
                                </div>
                            </div>
                        @else
                            <div class="text-center p-4 bg-red-50 rounded-lg border border-red-200">
                                <div class="flex items-center justify-center gap-2 text-red-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <span class="font-medium">Invalid transaction state - Cannot process pickup</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endisset
        </div>
    </div>

    {{-- HELPER INFO CARD --}}
    <div class="mt-6 bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-4 border border-amber-100">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-[#2C1810]">How to Validate a Pickup</p>
                <p class="text-xs text-stone-600 mt-1">1. Ask the customer for their unique pickup code<br>2. Enter the code in the search field above<br>3. Verify the transaction details match<br>4. Click "Confirm Pickup" to complete the order<br>5. The customer can then take their book(s)</p>
            </div>
        </div>
    </div>

</div>

@endsection