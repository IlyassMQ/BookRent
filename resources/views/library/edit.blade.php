@extends('layouts.app')

@section('title', 'Edit Library')

@section('content')

<div class="max-w-3xl mx-auto px-4 py-8">

    {{-- BREADCRUMB NAVIGATION --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-stone-500">
            <a href="{{ route('library.dashboard') }}" class="hover:text-amber-700 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-amber-700 font-semibold">Edit Library</span>
        </div>
    </div>

    {{-- MAIN FORM CARD --}}
    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
        
        {{-- FORM HEADER --}}
        <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-6 py-4 border-b border-amber-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-600 to-amber-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold serif-font text-[#2C1810]">Edit Library</h3>
                    <p class="text-xs text-stone-500">Update your library information</p>
                </div>
            </div>
        </div>

        {{-- FORM BODY --}}
        <form method="POST" action="{{ route('library.update') }}" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- ERROR DISPLAY --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-600 rounded-lg p-4">
                    <div class="flex items-start gap-2 mb-2">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold text-red-700">Please fix the following errors:</span>
                    </div>
                    <ul class="space-y-1 ml-7">
                        @foreach($errors->all() as $error)
                            <li class="text-sm text-red-600 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- LIBRARY NAME --}}
            <div>
                <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                    <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Library Name *
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           name="name"
                           value="{{ old('name', $library->name) }}"
                           placeholder="Enter library name"
                           class="w-full pl-10 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('name') border-red-500 @enderror">
                </div>
            </div>

            {{-- ADDRESS --}}
            <div>
                <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                    <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Address *
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           name="address"
                           value="{{ old('address', $library->address) }}"
                           placeholder="Street, City, Postal Code"
                           class="w-full pl-10 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('address') border-red-500 @enderror">
                </div>
                {{-- City --}}
            <div>
                <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                    <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    City *
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           name="city"
                           value="{{ old('city', $library->city) }}"
                           placeholder="City"
                           class="w-full pl-10 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('city') border-red-500 @enderror">
                </div>
            </div>

            {{-- INFO BOX - Read-only stats --}}
            <div class="bg-amber-50/50 rounded-lg p-4 border border-amber-200">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-[#2C1810]">Library Information</p>
                        <div class="grid grid-cols-2 gap-3 mt-2">
                            <div>
                                <p class="text-xs text-stone-500">Status</p>
                                <p class="text-sm font-semibold capitalize">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs
                                        @if($library->status === 'approved') bg-emerald-100 text-emerald-700
                                        @elseif($library->status === 'pending') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700 @endif">
                                        {{ $library->status }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-stone-500">Total Books</p>
                                <p class="text-sm font-semibold text-amber-700">{{ $library->books->count() }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-stone-500">Created</p>
                                <p class="text-xs text-stone-600">{{ $library->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-stone-500">Last Updated</p>
                                <p class="text-xs text-stone-600">{{ $library->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM ACTIONS --}}
            <div class="flex gap-3 pt-4 border-t border-amber-200">
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white py-2.5 rounded-lg transition-all duration-300 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Update Library
                    </span>
                </button>
                
                <a href="{{ route('library.dashboard') }}" 
                   class="px-6 py-2.5 border-2 border-stone-300 text-stone-700 rounded-lg hover:bg-stone-50 transition-all duration-200 font-medium text-center">
                    Cancel
                </a>
            </div>

        </form>
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
                <p class="text-sm font-semibold text-[#2C1810]">Need Help?</p>
                <p class="text-xs text-stone-600 mt-1">Make sure your library address is accurate for customers to find you. Contact support if you need assistance with updating your library information.</p>
            </div>
        </div>
    </div>

</div>

@endsection