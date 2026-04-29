@extends('layouts.admin')

@section('title', 'Edit Tag')
@section('header', 'Edit Tag')
@section('subheader', 'Update tag information')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- BREADCRUMB NAVIGATION --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-stone-500">
            <a href="{{ route('admin.tags.index') }}" class="hover:text-amber-700 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                Tags
            </a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-amber-700 font-semibold">Edit: {{ $tag->name }}</span>
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
                    <h3 class="text-lg font-bold serif-font text-[#2C1810]">Edit Tag</h3>
                    <p class="text-xs text-stone-500">Update the tag name and information</p>
                </div>
            </div>
        </div>

        {{-- FORM BODY --}}
        <form method="POST" action="{{ route('admin.tags.update', $tag) }}" class="p-6 space-y-6">
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

            {{-- TAG NAME FIELD --}}
            <div class="group">
                <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                    <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Tag Name *
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           name="name"
                           value="{{ old('name', $tag->name) }}"
                           placeholder="e.g., Bestseller, Award-Winning, Classic..."
                           class="w-full pl-10 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('name') border-red-500 @enderror">
                </div>
                <p class="text-xs text-stone-400 mt-1">Choose a clear, descriptive keyword for this tag</p>
            </div>

            {{-- TAG INFO BOX (Read-only stats) --}}
            <div class="bg-amber-50/50 rounded-lg p-4 border border-amber-200">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-[#2C1810]">Tag Statistics</p>
                        <div class="grid grid-cols-2 gap-3 mt-2">
                            <div>
                                <p class="text-xs text-stone-500">Tag ID</p>
                                <p class="text-sm font-mono font-semibold text-amber-700">#{{ str_pad($tag->id, 3, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-stone-500">Books Using Tag</p>
                                <p class="text-sm font-semibold text-amber-700">{{ $tag->books_count ?? 0 }} books</p>
                            </div>
                            <div>
                                <p class="text-xs text-stone-500">Created</p>
                                <p class="text-xs text-stone-600">{{ $tag->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-stone-500">Last Updated</p>
                                <p class="text-xs text-stone-600">{{ $tag->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- WARNING FOR TAGS WITH BOOKS --}}
            @if(($tag->books_count ?? 0) > 0)
                <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-3">
                    <div class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <p class="text-xs text-yellow-800">
                            <strong class="font-semibold">Note:</strong> This tag is currently used by {{ $tag->books_count ?? 0 }} book(s). 
                            Changing the tag name will affect how these books are tagged.
                        </p>
                    </div>
                </div>
            @endif

            {{-- FORM ACTIONS --}}
            <div class="flex gap-3 pt-4 border-t border-amber-200">
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white py-2.5 rounded-lg transition-all duration-300 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Update Tag
                    </span>
                </button>
                
                <a href="{{ route('admin.tags.index') }}" 
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
                <p class="text-sm font-semibold text-[#2C1810]">Tag Management Tips</p>
                <p class="text-xs text-stone-600 mt-1">• Keep tag names consistent (use lowercase for uniformity)<br>• Consider merging similar tags to avoid duplication<br>• Tags help users discover books through search and filtering<br>• Changes to tags take effect immediately across the platform</p>
            </div>
        </div>
    </div>

</div>

@endsection