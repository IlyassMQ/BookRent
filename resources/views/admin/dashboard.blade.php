@extends('layouts.admin')

@section('title', 'Library Management Dashboard')
@section('header', 'Admin Dashboard')
@section('subheader', 'Library System Overview')

@section('content')

<div class="space-y-8">

    {{-- Welcome Message --}}
    <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 rounded-2xl p-6 border border-amber-200/50 shadow-sm">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span class="text-xs font-semibold text-amber-700 uppercase tracking-wider">Library Analytics</span>
                </div>
                <h2 class="text-2xl font-bold serif-font text-[#2C1810]">
                    Welcome back, {{ auth()->user()->name }}
                </h2>
                <p class="text-sm text-stone-600 mt-1 italic">
                    Here's your library ecosystem at a glance
                </p>
            </div>
            <div class="text-right">
                <div class="text-xs text-stone-500">Today's Date</div>
                <div class="text-lg font-semibold serif-font text-amber-800">{{ date('F j, Y') }}</div>
            </div>
        </div>
    </div>

    {{-- Statistics Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        {{-- Users Card --}}
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-amber-100 hover:border-amber-300 admin-card">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="relative">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-medium text-stone-400 bg-stone-100 px-2 py-1 rounded-full">Total</span>
                    </div>
                </div>
                <p class="text-xs font-semibold text-stone-500 uppercase tracking-wider mb-2">
                    Registered Users
                </p>
                <p class="text-4xl font-bold text-[#2C1810] leading-none">
                    {{ number_format($usersCount) }}
                </p>
                <div class="mt-3 pt-3 border-t border-amber-100">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-stone-500">Active readers</span>
                        <span class="text-emerald-600 font-semibold">+12% this month</span>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-amber-50 to-transparent px-6 py-2 border-t border-amber-100">
                <a href="{{ route('admin.users.index') }}" class="text-xs text-amber-700 hover:text-amber-800 font-medium flex items-center gap-1 group">
                    Manage users
                    <svg class="w-3 h-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Libraries Card --}}
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-amber-100 hover:border-amber-300 admin-card">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="relative">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-200 to-amber-300 text-amber-800 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-medium text-stone-400 bg-stone-100 px-2 py-1 rounded-full">Total</span>
                    </div>
                </div>
                <p class="text-xs font-semibold text-stone-500 uppercase tracking-wider mb-2">
                    Partner Libraries
                </p>
                <p class="text-4xl font-bold text-[#2C1810] leading-none">
                    {{ number_format($librariesCount) }}
                </p>
                <div class="mt-3 pt-3 border-t border-amber-100">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-stone-500">Pending approval</span>
                        <span class="text-amber-600 font-semibold">3 pending</span>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-amber-50 to-transparent px-6 py-2 border-t border-amber-100">
                <a href="{{ route('admin.libraries.index') }}" class="text-xs text-amber-700 hover:text-amber-800 font-medium flex items-center gap-1 group">
                    Manage libraries
                    <svg class="w-3 h-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Books Card --}}
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-amber-100 hover:border-amber-300 admin-card">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="relative">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-50 to-amber-100 text-amber-700 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-medium text-stone-400 bg-stone-100 px-2 py-1 rounded-full">Catalog</span>
                    </div>
                </div>
                <p class="text-xs font-semibold text-stone-500 uppercase tracking-wider mb-2">
                    Books in System
                </p>
                <p class="text-4xl font-bold text-[#2C1810] leading-none">
                    {{ number_format($booksCount) }}
                </p>
                <div class="mt-3 pt-3 border-t border-amber-100">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-stone-500">Available for rent</span>
                        <span class="text-emerald-600 font-semibold">78% available</span>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-amber-50 to-transparent px-6 py-2 border-t border-amber-100">
                <a href="{{ route('admin.books.index') }}" class="text-xs text-amber-700 hover:text-amber-800 font-medium flex items-center gap-1 group">
                    Manage books
                    <svg class="w-3 h-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Transactions Card --}}
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-amber-100 hover:border-amber-300 admin-card">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="relative">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-300 to-amber-400 text-amber-900 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-medium text-stone-400 bg-stone-100 px-2 py-1 rounded-full">Activity</span>
                    </div>
                </div>
                <p class="text-xs font-semibold text-stone-500 uppercase tracking-wider mb-2">
                    Total Transactions
                </p>
                <p class="text-4xl font-bold text-[#2C1810] leading-none">
                    {{ number_format($transactionsCount) }}
                </p>
                <div class="mt-3 pt-3 border-t border-amber-100">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-stone-500">This month</span>
                        <span class="text-amber-600 font-semibold">+8% growth</span>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-amber-50 to-transparent px-6 py-2 border-t border-amber-100">
                <a href="#" class="text-xs text-amber-700 hover:text-amber-800 font-medium flex items-center gap-1 group">
                    View transactions
                    <svg class="w-3 h-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Quick Actions Section --}}
    <div class="mt-8">
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <h3 class="text-lg font-semibold serif-font text-[#2C1810]">Quick Actions</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.books.create') }}" class="flex items-center gap-3 p-4 bg-white rounded-xl border border-amber-100 hover:border-amber-300 hover:shadow-md transition-all group">
                <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-stone-800">Add New Book</p>
                    <p class="text-xs text-stone-500">Expand your library catalog</p>
                </div>
            </a>

            <a href="{{ route('admin.libraries.index') }}" class="flex items-center gap-3 p-4 bg-white rounded-xl border border-amber-100 hover:border-amber-300 hover:shadow-md transition-all group">
                <div class="w-10 h-10 rounded-lg bg-amber-200 text-amber-800 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-stone-800">Review Libraries</p>
                    <p class="text-xs text-stone-500">Approve pending registrations</p>
                </div>
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-4 bg-white rounded-xl border border-amber-100 hover:border-amber-300 hover:shadow-md transition-all group">
                <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-stone-800">Manage Users</p>
                    <p class="text-xs text-stone-500">Review accounts & permissions</p>
                </div>
            </a>
        </div>
    </div>

</div>

@endsection