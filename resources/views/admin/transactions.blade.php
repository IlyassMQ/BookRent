@extends('layouts.admin')

@section('title', 'Transaction History')
@section('header', 'Transaction Management')
@section('subheader', 'Track all library transactions and payments')

@section('content')

<div class="space-y-6">

    {{-- Header with Stats --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-8 h-0.5 bg-gradient-to-r from-amber-600 to-transparent rounded-full"></div>
                <p class="text-xs font-semibold text-amber-700 uppercase tracking-wider">Financial Activity</p>
            </div>
            <h2 class="text-2xl font-bold serif-font text-[#2C1810]">All Transactions</h2>
            <p class="text-sm text-stone-500 mt-1">Complete history of book rentals and purchases</p>
        </div>
        
        {{-- Stats Summary --}}
        <div class="flex gap-3">
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/30 rounded-xl px-4 py-2 border border-emerald-200">
                <p class="text-xs text-emerald-700 font-semibold">Completed</p>
                <p class="text-2xl font-bold text-emerald-800">{{ $transactions->where('status', 'completed')->count() }}</p>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-blue-100/30 rounded-xl px-4 py-2 border border-blue-200">
                <p class="text-xs text-blue-700 font-semibold">Paid</p>
                <p class="text-2xl font-bold text-blue-800">{{ $transactions->where('status', 'paid')->count() }}</p>
            </div>
            <div class="bg-gradient-to-br from-amber-50 to-amber-100/30 rounded-xl px-4 py-2 border border-amber-200">
                <p class="text-xs text-amber-700 font-semibold">Pending</p>
                <p class="text-2xl font-bold text-amber-800">{{ $transactions->where('status', 'pending')->count() }}</p>
            </div>
        </div>
    </div>

    {{-- Transactions Table --}}
    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
        
        {{-- Table Header --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-amber-50 to-amber-100/50 border-b-2 border-amber-200">
                        <th class="px-6 py-4 text-left">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                Transaction ID
                            </span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                User
                            </span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Book
                            </span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Library
                            </span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Type
                            </span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Status
                            </span>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-amber-50">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-amber-50/40 transition-all duration-200 group cursor-pointer table-row-hover">
                        
                        {{-- Transaction ID with badge --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-amber-400 group-hover:bg-amber-600 transition-colors"></div>
                                <span class="text-xs font-mono font-semibold text-amber-700">#{{ $transaction->id }}</span>
                            </div>
                        </td>

                        {{-- User with avatar --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center text-xs font-bold text-amber-700">
                                    {{ strtoupper(substr($transaction->user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-stone-800 text-sm">{{ $transaction->user->name }}</p>
                                    <p class="text-xs text-stone-400">{{ $transaction->user->email }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Book with hover effect --}}
                        <td class="px-6 py-4">
                            <div class="group/book">
                                <p class="font-medium text-stone-700 group-hover/book:text-amber-700 transition-colors">
                                    {{ $transaction->book->title }}
                                </p>
                                <p class="text-xs text-stone-400">ISBN: {{ substr($transaction->book->isbn ?? 'N/A', 0, 13) }}</p>
                            </div>
                        </td>

                        {{-- Library --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span class="text-sm text-stone-600">{{ $transaction->library->name }}</span>
                            </div>
                        </td>

                        {{-- Type with icon --}}
                        <td class="px-6 py-4">
                            @if($transaction->type === 'purchase')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 17v4"></path>
                                    </svg>
                                    Purchase
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Rental
                                </span>
                            @endif
                        </td>

                        {{-- Status with dynamic styling --}}
                        <td class="px-6 py-4">
                            @if($transaction->status === 'completed')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Completed
                                </span>
                            @elseif($transaction->status === 'paid')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Paid
                                </span>
                            @elseif($transaction->status === 'pending')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-yellow-50 text-yellow-700 border border-yellow-200">
                                    <svg class="w-3 h-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Pending
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-red-50 text-red-700 border border-red-200">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-20 h-20 rounded-full bg-amber-50 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-stone-700">No Transactions Yet</h3>
                                <p class="text-sm text-stone-400">When users make purchases or rentals, they'll appear here</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Table Footer with Pagination (if needed) --}}
        @if(method_exists($transactions, 'links') && $transactions->hasPages())
            <div class="px-6 py-4 border-t border-amber-100 bg-amber-50/30">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>

    {{-- Quick Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        <div class="bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-4 border border-amber-100">
            <div class="flex items-center gap-2 text-xs text-amber-700 mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-semibold">Info</span>
            </div>
            <p class="text-sm text-stone-600">Transactions include both book purchases and rental fees collected by libraries.</p>
        </div>
        
        <div class="bg-gradient-to-r from-blue-50 to-transparent rounded-xl p-4 border border-blue-100">
            <div class="flex items-center gap-2 text-xs text-blue-700 mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                <span class="font-semibold">Revenue</span>
            </div>
            <p class="text-sm text-stone-600">Track financial flow between users, libraries, and platform fees.</p>
        </div>

        <div class="bg-gradient-to-r from-emerald-50 to-transparent rounded-xl p-4 border border-emerald-100">
            <div class="flex items-center gap-2 text-xs text-emerald-700 mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="font-semibold">Reports</span>
            </div>
            <p class="text-sm text-stone-600">Generate detailed financial reports for accounting purposes.</p>
        </div>
    </div>

</div>

@endsection