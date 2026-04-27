@extends('layouts.admin')

@section('title', 'Users')
@section('header', 'Users Management')

@section('content')

<div>

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-stone-800">All Users</h2>
            <p class="text-sm text-stone-400 mt-0.5">{{ $users->count() }} registered users</p>
        </div>

        <a href="{{ route('admin.users.create') }}"
           class="inline-flex items-center gap-2 bg-amber-700 hover:bg-amber-800 text-white text-sm font-medium px-4 py-2 rounded-lg transition shadow-sm">
            + Add User
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">

            {{-- HEADER --}}
            <thead class="bg-amber-50 text-stone-500 text-xs uppercase tracking-wider">
                <tr>
                    <th class="text-left px-6 py-4 w-12">#</th>
                    <th class="text-left px-6 py-4">User</th>
                    <th class="text-left px-6 py-4">Email</th>
                    <th class="text-left px-6 py-4">Role</th>
                    <th class="text-right px-6 py-4">Actions</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="divide-y divide-amber-50">
                @forelse($users as $user)
                    <tr class="hover:bg-amber-50/40 transition">

                        {{-- ID --}}
                        <td class="px-6 py-4 text-stone-400 font-mono text-xs">
                            #{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}
                        </td>

                        {{-- USER --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-full bg-amber-100 text-amber-700 font-semibold text-xs flex items-center justify-center">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>

                                <span class="font-medium text-stone-800">
                                    {{ $user->name }}
                                </span>

                            </div>
                        </td>

                        {{-- EMAIL --}}
                        <td class="px-6 py-4 text-stone-500">
                            {{ $user->email }}
                        </td>

                        {{-- ROLE --}}
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-xs rounded-full font-medium

                                @if($user->role->name === 'admin')
                                    bg-amber-100 text-amber-800
                                @else
                                    bg-stone-100 text-stone-700
                                @endif
                            ">
                                {{ ucfirst($user->role->name) }}
                            </span>
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">

                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="text-xs text-stone-500 hover:text-amber-700 transition px-2 py-1 rounded hover:bg-amber-50">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                      onsubmit="return confirm('Delete {{ $user->name }}? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-xs text-stone-500 hover:text-red-600 transition px-2 py-1 rounded hover:bg-red-50">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">

                            <div class="flex flex-col items-center gap-2 text-stone-400">
                                <span class="text-4xl">👤</span>
                                <p class="font-medium">No users found</p>
                                <p class="text-xs">Add your first user to get started</p>
                            </div>

                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection