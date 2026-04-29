@extends('layouts.admin')

@section('title', 'Library Directory')
@section('header', 'Libraries Management')
@section('subheader', 'Manage partner libraries and their status')

@section('content')

<div class="space-y-6">

    {{-- HEADER WITH STATS --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-8 h-0.5 bg-gradient-to-r from-amber-600 to-transparent rounded-full"></div>
                <p class="text-xs font-semibold text-amber-700 uppercase tracking-wider">Library Network</p>
            </div>
            <h2 class="text-2xl font-bold serif-font text-[#2C1810]">Partner Libraries</h2>
            <p class="text-sm text-stone-500 mt-1">Manage all registered libraries in your network</p>
        </div>

        <div class="flex gap-3">
            {{-- Stats Badges --}}
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/30 rounded-xl px-4 py-2 border border-emerald-200">
                <p class="text-xs text-emerald-700 font-semibold">Approved</p>
                <p class="text-2xl font-bold text-emerald-800">{{ $libraries->where('status', 'approved')->count() }}</p>
            </div>
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100/30 rounded-xl px-4 py-2 border border-yellow-200">
                <p class="text-xs text-yellow-700 font-semibold">Pending</p>
                <p class="text-2xl font-bold text-yellow-800">{{ $libraries->where('status', 'pending')->count() }}</p>
            </div>
            <div class="bg-gradient-to-br from-red-50 to-red-100/30 rounded-xl px-4 py-2 border border-red-200">
                <p class="text-xs text-red-700 font-semibold">Blocked</p>
                <p class="text-2xl font-bold text-red-800">{{ $libraries->where('status', 'blocked')->count() }}</p>
            </div>
            <a href="{{ route('admin.libraries.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white text-sm font-medium px-5 py-2 rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Register Library
            </a>
        </div>
    </div>

    {{-- SEARCH BAR (UI only, no JS) --}}
    <div class="bg-white rounded-xl shadow-md border border-amber-100 p-4">
        <form method="GET" action="{{ route('admin.libraries.index') }}" class="flex flex-col md:flex-row gap-3 md:items-center">
            <div class="relative flex-1 max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" 
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search libraries by name or owner..." 
                       class="w-full pl-10 pr-4 py-2 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
            </div>
            <div class="flex gap-2">
                <select name="status" class="px-4 py-2 rounded-lg border-2 border-amber-200 bg-white text-stone-700 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all text-sm">
                    <option value="">All Status</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>Blocked</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition font-medium text-sm">
                    Filter
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.libraries.index') }}" class="px-4 py-2 border-2 border-stone-300 text-stone-700 rounded-lg hover:bg-stone-50 transition text-sm">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- LIBRARIES TABLE --}}
    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                
                {{-- TABLE HEADER --}}
                <thead>
                    <tr class="bg-gradient-to-r from-amber-50 to-amber-100/50 border-b-2 border-amber-200">
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Library
                            </span>
                        </th>
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Owner
                            </span>
                        </th>
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Location
                            </span>
                        </th>
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Status
                            </span>
                        </th>
                        <th class="text-right px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider">Actions</span>
                        </th>
                    </tr>
                </thead>

                {{-- TABLE BODY --}}
                <tbody class="divide-y divide-amber-50">
                    @forelse($libraries as $library)
                        <tr class="hover:bg-amber-50/40 transition-all duration-200 group">
                            
                            {{-- LIBRARY NAME with icon --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-stone-800 group-hover:text-amber-700 transition-colors">
                                            {{ $library->name }}
                                        </p>
                                        <p class="text-xs text-stone-400">ID: #{{ str_pad($library->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- OWNER with avatar --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center text-xs font-bold text-amber-700">
                                        {{ strtoupper(substr($library->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-stone-700">{{ $library->user->name }}</p>
                                        <p class="text-xs text-stone-400">{{ $library->user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- LOCATION (Address preview) --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-sm text-stone-600">{{ Str::limit($library->address, 40) }}</span>
                                </div>
                                @if($library->geo_lat && $library->geo_lng)
                                    <p class="text-xs text-stone-400 mt-1 font-mono">
                                        {{ $library->geo_lat }}, {{ $library->geo_lng }}
                                    </p>
                                @endif
                            </td>

                            {{-- STATUS with icon --}}
                            <td class="px-6 py-4">
                                @if($library->status === 'approved')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Approved
                                    </span>
                                @elseif($library->status === 'blocked')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-red-50 text-red-700 border border-red-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                        </svg>
                                        Blocked
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-yellow-50 text-yellow-700 border border-yellow-200">
                                        <svg class="w-3 h-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Pending
                                    </span>
                                @endif
                            </td>

                            {{-- ACTION BUTTONS --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-1">
                                    
                                    {{-- APPROVE BUTTON --}}
                                    @if($library->status !== 'approved')
                                        <form method="POST" action="{{ route('admin.libraries.approve', $library) }}" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="p-2 text-stone-500 hover:text-emerald-700 transition rounded-lg hover:bg-emerald-50"
                                                    title="Approve Library">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- BLOCK BUTTON --}}
                                    @if($library->status !== 'blocked')
                                        <form method="POST" action="{{ route('admin.libraries.block', $library) }}" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="p-2 text-stone-500 hover:text-yellow-700 transition rounded-lg hover:bg-yellow-50"
                                                    title="Block Library"
                                                    onclick="return confirm('Block {{ $library->name }}? This will suspend all library operations.')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- DELETE BUTTON --}}
                                    <form method="POST" action="{{ route('admin.libraries.destroy', $library) }}" class="inline"
                                          onsubmit="return confirm('Delete {{ $library->name }}? This action cannot be undone. All books and data will be permanently removed.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 text-stone-500 hover:text-red-700 transition rounded-lg hover:bg-red-50"
                                                title="Delete Library">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-20 h-20 rounded-full bg-amber-50 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-stone-700">No Libraries Found</h3>
                                    <p class="text-sm text-stone-400">Get started by registering your first partner library</p>
                                    <a href="{{ route('admin.libraries.create') }}" class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-amber-700 text-white rounded-lg hover:bg-amber-800 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Register Library
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($libraries, 'links') && $libraries->hasPages())
            <div class="px-6 py-4 border-t border-amber-100 bg-amber-50/30">
                {{ $libraries->links() }}
            </div>
        @endif
    </div>

    {{-- QUICK STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-4 border border-amber-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-amber-700 font-semibold">Total Libraries</p>
                    <p class="text-2xl font-bold text-amber-800">{{ $libraries->count() }}</p>
                </div>
                <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-emerald-50 to-transparent rounded-xl p-4 border border-emerald-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-emerald-700 font-semibold">Approval Rate</p>
                    <p class="text-2xl font-bold text-emerald-800">
                        {{ $libraries->count() > 0 ? round(($libraries->where('status', 'approved')->count() / $libraries->count()) * 100) : 0 }}%
                    </p>
                </div>
                <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-50 to-transparent rounded-xl p-4 border border-blue-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-blue-700 font-semibold">Active Libraries</p>
                    <p class="text-2xl font-bold text-blue-800">{{ $libraries->where('status', 'approved')->count() }}</p>
                </div>
                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-50 to-transparent rounded-xl p-4 border border-purple-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-purple-700 font-semibold">Need Review</p>
                    <p class="text-2xl font-bold text-purple-800">{{ $libraries->where('status', 'pending')->count() }}</p>
                </div>
                <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

</div>

@endsection