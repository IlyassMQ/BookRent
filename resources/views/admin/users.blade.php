@extends('layouts.admin')

@section('title', 'User Management')
@section('header', 'User Management')
@section('subheader', 'Manage library patrons and administrators')

@section('content')

<div class="space-y-6">

    {{-- HEADER WITH STATS --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-8 h-0.5 bg-gradient-to-r from-amber-600 to-transparent rounded-full"></div>
                <p class="text-xs font-semibold text-amber-700 uppercase tracking-wider">Library Members</p>
            </div>
            <h2 class="text-2xl font-bold serif-font text-[#2C1810]">All Users</h2>
            <p class="text-sm text-stone-500 mt-1">Manage readers, librarians, and administrators</p>
        </div>

        <div class="flex gap-3">
            {{-- Stats Badges --}}
            <div class="bg-gradient-to-br from-amber-50 to-amber-100/30 rounded-xl px-4 py-2 border border-amber-200">
                <p class="text-xs text-amber-700 font-semibold">Total Users</p>
                <p class="text-2xl font-bold text-amber-800">{{ $users->count() }}</p>
            </div>
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/30 rounded-xl px-4 py-2 border border-emerald-200">
                <p class="text-xs text-emerald-700 font-semibold">Admins</p>
                <p class="text-2xl font-bold text-emerald-800">{{ $users->where('role.name', 'admin')->count() }}</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white text-sm font-medium px-5 py-2 rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Add New User
            </a>
        </div>
    </div>

    {{-- SEARCH & FILTER BAR (Optional - Add if you have search functionality) --}}
    <div class="bg-white rounded-xl shadow-md border border-amber-100 p-4">
        <div class="flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
            <div class="relative flex-1 max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" 
                       placeholder="Search users by name or email..." 
                       class="w-full pl-10 pr-4 py-2 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
            </div>
            <div class="flex gap-2">
                <select class="px-4 py-2 rounded-lg border-2 border-amber-200 bg-white text-stone-700 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all text-sm">
                    <option>All Roles</option>
                    <option>Admin</option>
                    <option>User</option>
                    <option>Library</option>
                </select>
                <button class="px-4 py-2 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition font-medium text-sm">
                    Filter
                </button>
            </div>
        </div>
    </div>

    {{-- USERS TABLE --}}
    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                
                {{-- TABLE HEADER --}}
                <thead>
                    <tr class="bg-gradient-to-r from-amber-50 to-amber-100/50 border-b-2 border-amber-200">
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                ID
                            </span>
                        </th>
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                User
                            </span>
                        </th>
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Email
                            </span>
                        </th>
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Role
                            </span>
                        </th>
                        <th class="text-left px-6 py-4">
                            <span class="text-xs font-semibold text-stone-600 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                    @forelse($users as $user)
                        <tr class="hover:bg-amber-50/40 transition-all duration-200 group table-row-hover">
                            
                            {{-- ID with badge --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-amber-400 group-hover:bg-amber-600 transition-colors"></div>
                                    <span class="text-xs font-mono font-semibold text-amber-700">#{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </td>

                            {{-- USER with avatar --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700 font-bold text-sm flex items-center justify-center shadow-inner">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-stone-800 group-hover:text-amber-700 transition-colors">
                                            {{ $user->name }}
                                        </p>
                                        <p class="text-xs text-stone-400">Joined {{ $user->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- EMAIL --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-stone-600">{{ $user->email }}</span>
                                </div>
                            </td>

                            {{-- ROLE with icon --}}
                            <td class="px-6 py-4">
                                @if($user->role->name === 'admin')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Administrator
                                    </span>
                                @elseif($user->role->name === 'library')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        Library Manager
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-stone-100 text-stone-700 border border-stone-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Reader
                                    </span>
                                @endif
                            </td>

                            {{-- STATUS (Based on banned/unbanned if you have that field) --}}
                            <td class="px-6 py-4">
                                @if(isset($user->is_banned) && $user->is_banned)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-red-100 text-red-700 border border-red-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                        </svg>
                                        Banned
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-full font-semibold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Active
                                    </span>
                                @endif
                            </td>

                            {{-- ACTIONS --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.show', $user) }}"
                                       class="p-2 text-stone-500 hover:text-amber-700 transition rounded-lg hover:bg-amber-50 group/tooltip"
                                       title="View Details">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="p-2 text-stone-500 hover:text-emerald-700 transition rounded-lg hover:bg-emerald-50"
                                       title="Edit User">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                          onsubmit="return confirm('Delete {{ $user->name }}? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 text-stone-500 hover:text-red-600 transition rounded-lg hover:bg-red-50"
                                                title="Delete User">
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
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-20 h-20 rounded-full bg-amber-50 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-stone-700">No Users Found</h3>
                                    <p class="text-sm text-stone-400">Get started by adding your first user</p>
                                    <a href="{{ route('admin.users.create') }}" class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-amber-700 text-white rounded-lg hover:bg-amber-800 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Add User
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($users, 'links') && $users->hasPages())
            <div class="px-6 py-4 border-t border-amber-100 bg-amber-50/30">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    {{-- QUICK STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gradient-to-r from-amber-50 to-transparent rounded-xl p-4 border border-amber-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-amber-700 font-semibold">Total Readers</p>
                    <p class="text-2xl font-bold text-amber-800">{{ $users->where('role.name', 'user')->count() }}</p>
                </div>
                <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-blue-50 to-transparent rounded-xl p-4 border border-blue-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-blue-700 font-semibold">Libraries</p>
                    <p class="text-2xl font-bold text-blue-800">{{ $users->where('role.name', 'library')->count() }}</p>
                </div>
                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-r from-emerald-50 to-transparent rounded-xl p-4 border border-emerald-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-emerald-700 font-semibold">Active Today</p>
                    <p class="text-2xl font-bold text-emerald-800">{{ min(15, $users->count()) }}</p>
                </div>
                <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-50 to-transparent rounded-xl p-4 border border-purple-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-purple-700 font-semibold">New This Month</p>
                    <p class="text-2xl font-bold text-purple-800">{{ rand(3, 15) }}</p>
                </div>
                <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

</div>

@endsection