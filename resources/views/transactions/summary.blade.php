@extends('layouts.app')

@section('title', 'Order Summary')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    {{-- HEADER SECTION --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
            <p class="text-sm font-semibold text-amber-700 uppercase tracking-wider">Checkout</p>
        </div>
        
        <div>
            <h1 class="text-3xl font-bold serif-font text-[#2C1810] mb-2">
                Order Summary
            </h1>
            <p class="text-stone-600">
                <span class="inline-flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    Review your order before proceeding to payment
                </span>
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        {{-- BOOK DETAILS SECTION --}}
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
            
            {{-- Book Cover --}}
            <div class="relative h-80 bg-gradient-to-br from-amber-50 to-stone-100 overflow-hidden">
                <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                     alt="{{ $book->title }}"
                     class="w-full h-full object-cover">
                
                {{-- Book Type Badge --}}
                <div class="absolute top-4 right-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg shadow-md
                        @if($type === 'purchase') bg-emerald-500 text-white
                        @else bg-blue-500 text-white @endif">
                        @if($type === 'purchase')
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                            </svg>
                            Purchase
                        @else
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Rental
                        @endif
                    </span>
                </div>
            </div>

            {{-- Book Info --}}
            <div class="p-6">
                <h2 class="text-xl font-bold serif-font text-[#2C1810] mb-2">
                    {{ $book->title }}
                </h2>

                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <p class="text-sm text-stone-600">
                        by {{ $book->author }}
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                    <p class="text-xs text-stone-500">
                        {{ $book->category->name ?? 'Uncategorized' }}
                    </p>
                </div>

                @if($book->description)
                    <div class="mt-4 p-3 bg-amber-50/50 rounded-lg border border-amber-100">
                        <p class="text-xs text-stone-600 line-clamp-3">
                            {{ $book->description }}
                        </p>
                    </div>
                @endif
            </div>
        </div>

        {{-- ORDER SUMMARY SECTION --}}
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
            
            {{-- Header --}}
            <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-6 py-4 border-b border-amber-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-600 to-amber-700 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold serif-font text-[#2C1810]">Order Details</h3>
                        <p class="text-xs text-stone-500">Review your order information</p>
                    </div>
                </div>
            </div>

            {{-- Order Details Content --}}
            <div class="p-6">
                <div class="space-y-4">
                    {{-- Order Type --}}
                    <div class="flex justify-between items-center pb-3 border-b border-amber-100">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span class="text-sm text-stone-600">Order Type</span>
                        </div>
                        <span class="font-semibold capitalize text-stone-800">
                            {{ $type }}
                        </span>
                    </div>

                    {{-- Quantity --}}
                    <div class="flex justify-between items-center pb-3 border-b border-amber-100">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="text-sm text-stone-600">Quantity</span>
                        </div>
                        <span class="font-semibold text-stone-800">
                            {{ $quantity }}
                        </span>
                    </div>

                    {{-- Rental Duration (if applicable) --}}
                    @if($type === 'rental')
                        <div class="flex justify-between items-center pb-3 border-b border-amber-100">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm text-stone-600">Duration</span>
                            </div>
                            <span class="font-semibold text-stone-800">
                                {{ $days }} day(s)
                            </span>
                        </div>
                    @endif

                    {{-- Unit Price --}}
                    <div class="flex justify-between items-center pb-3 border-b border-amber-100">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                            </svg>
                            <span class="text-sm text-stone-600">Unit Price</span>
                        </div>
                        <span class="font-semibold text-stone-800">
                            {{ number_format($unitPrice, 2) }} DH
                        </span>
                    </div>

                    {{-- Total Amount --}}
                    <div class="flex justify-between items-center pt-3 mt-2">
                        <div>
                            <span class="text-base font-semibold text-stone-800">Total Amount</span>
                            <p class="text-xs text-stone-500">Including all fees</p>
                        </div>
                        <div class="text-right">
                            <span class="text-3xl font-bold text-amber-700">{{ number_format($total, 2) }} DH</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="p-6 pt-0 space-y-3">
                <form method="POST" action="{{ route('transactions.checkout') }}">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="quantity" value="{{ $quantity }}">
                    <input type="hidden" name="days" value="{{ $days }}">
                    <input type="hidden" name="type" value="{{ $type }}">

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white py-3 rounded-lg transition-all duration-300 font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Confirm & Pay
                        </span>
                    </button>
                </form>

                <a href="{{ route('books.show', $book->id) }}"
                   class="flex items-center justify-center gap-2 w-full bg-stone-100 hover:bg-stone-200 text-stone-700 py-2.5 rounded-lg transition-all duration-200 font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Cancel & Go Back
                </a>
            </div>
        </div>
    </div>

    {{-- Additional Info Card --}}
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-transparent rounded-xl p-4 border border-blue-100">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-[#2C1810]">Payment Information</p>
                <p class="text-xs text-stone-600 mt-1">You will be redirected to our secure payment gateway to complete your transaction. We accept multiple payment methods for your convenience.</p>
            </div>
        </div>
    </div>

</div>

@endsection