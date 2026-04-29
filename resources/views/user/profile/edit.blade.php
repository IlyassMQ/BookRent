@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')

<div class="max-w-3xl mx-auto px-4 py-8">

    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
            <p class="text-sm font-semibold text-amber-700 uppercase tracking-wider">Account Settings</p>
        </div>
        <h1 class="text-3xl font-bold serif-font text-[#2C1810] mb-2">Profile Settings</h1>
        <p class="text-stone-600">Manage your personal information</p>
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

    {{-- Success Message --}}
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

    {{-- Profile Information Form --}}
    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
        <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-6 py-4 border-b border-amber-200">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <h2 class="text-lg font-bold serif-font text-[#2C1810]">Personal Information</h2>
            </div>
        </div>
        
        <form method="POST" action="{{ route('user.profile.update') }}" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-[#5C2E0B] mb-2">Full Name *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                       class="w-full px-4 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C2E0B] mb-2">Email</label>
                <input type="email" value="{{ $user->email }}" disabled
                       class="w-full px-4 py-2.5 rounded-lg border-2 border-stone-200 bg-stone-50 text-stone-500 cursor-not-allowed">
                <p class="text-xs text-stone-400 mt-1">Email cannot be changed</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C2E0B] mb-2">City</label>
                <input type="text" name="city" value="{{ old('city', $user->city) }}" 
                       placeholder="Casablanca, Rabat, Marrakech..."
                       class="w-full px-4 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C2E0B] mb-2">Address</label>
                <textarea name="address" rows="3" 
                          placeholder="Your street address..."
                          class="w-full px-4 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">{{ old('address', $user->address) }}</textarea>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white py-2.5 rounded-lg transition font-medium">
                    Save Changes
                </button>
                
                <a href="{{ route('user.dashboard') }}" class="flex-1 text-center border-2 border-stone-300 text-stone-700 py-2.5 rounded-lg hover:bg-stone-50 transition font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>

@endsection