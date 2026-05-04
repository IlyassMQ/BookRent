@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- Page Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
            <p class="text-sm font-semibold text-amber-700 uppercase tracking-wider">Welcome Back</p>
        </div>
        <h1 class="text-3xl font-bold serif-font text-[#2C1810] mb-2">My Dashboard</h1>
        <p class="text-stone-600">Hello, {{ $user->name }}! Here's what's happening with your account.</p>
    </div>

    <div class="flex gap-6">
        
        {{-- MAIN CONTENT --}}
        <div class="flex-1 space-y-6">
            
            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl shadow-md border border-amber-100 p-4 text-center">
                    <p class="text-2xl font-bold text-amber-700">{{ $totalOrders }}</p>
                    <p class="text-xs text-stone-500">Total Orders</p>
                </div>
                <div class="bg-white rounded-xl shadow-md border border-amber-100 p-4 text-center">
                    <p class="text-2xl font-bold text-blue-700">{{ count($activeRentals) }}</p>
                    <p class="text-xs text-stone-500">Active Rentals</p>
                </div>
                <div class="bg-white rounded-xl shadow-md border border-amber-100 p-4 text-center">
                    <p class="text-2xl font-bold text-emerald-700">{{ $completedOrders }}</p>
                    <p class="text-xs text-stone-500">Completed</p>
                </div>
                <div class="bg-white rounded-xl shadow-md border border-amber-100 p-4 text-center">
                    <p class="text-2xl font-bold text-purple-700">{{ number_format($totalSpent, 0) }} DH</p>
                    <p class="text-xs text-stone-500">Total Spent</p>
                </div>
            </div>

            {{-- Recent Orders --}}
            <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-6 py-4 border-b border-amber-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h2 class="text-lg font-bold serif-font text-[#2C1810]">Recent Orders</h2>
                        </div>
                        <a href="{{ route('user.orders') }}" class="text-xs text-amber-600 hover:text-amber-700">View All →</a>
                    </div>
                </div>
                <div class="divide-y divide-amber-50">
                    @forelse($transactions->take(5) as $transaction)
                    <div class="p-4 hover:bg-amber-50/40 transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-stone-800">{{ $transaction->book->title }}</p>
                                <p class="text-xs text-stone-500">{{ ucfirst($transaction->type) }} • Qty: {{ $transaction->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-amber-700">{{ number_format($transaction->payment->amount ?? 0, 2) }} DH</p>
                                <span class="text-xs px-2 py-0.5 rounded-full 
                                    @if($transaction->status === 'completed') bg-emerald-100 text-emerald-700
                                    @elseif($transaction->status === 'paid') bg-blue-100 text-blue-700
                                    @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-stone-400">
                        <p>No orders yet</p>
                        <a href="{{ route('home') }}" class="text-xs text-amber-600 hover:text-amber-700 mt-1 inline-block">Start browsing →</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- SIDEBAR - Quick Links --}}
        <div class="w-64 flex-shrink-0">
            <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden sticky top-8">
                <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-4 py-3 border-b border-amber-200">
                    <h3 class="font-semibold text-[#2C1810]">Quick Links</h3>
                </div>
                <div class="p-2 space-y-1">
                    <a href="{{ route('user.profile.edit') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-stone-600 hover:bg-amber-50 hover:text-amber-700 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Edit Profile
                    </a>
                    <a href="{{ route('recommendations') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-stone-600 hover:bg-amber-50 hover:text-amber-700 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Recommendations
                    </a>
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-stone-600 hover:bg-amber-50 hover:text-amber-700 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Browse Books
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection