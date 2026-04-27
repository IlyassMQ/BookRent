@extends('layouts.admin')

@section('title', 'Users')
@section('header', 'Users Management')

@section('content')

<div>

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-stone-800">Users</h2>
            <p class="text-sm text-stone-400 mt-0.5">
                {{ $users->count() }} registered users
            </p>
        </div>

        <a href="{{ route('admin.users.create') }}"
           class="bg-amber-700 hover:bg-amber-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
            + Add User
        </a>
    </div>

    {{-- TABLE --}}
    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm overflow-hidden">

        <table class="w-full text-sm">

            {{-- HEADER --}}
            <thead class="bg-amber-50 text-stone-500 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 w-16">#</th>
                    <th class="px-6 py-4 text-left">User</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Role</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="divide-y divide-amber-50">

                @forelse($users as $user)
                <tr class="hover:bg-amber-50/40 transition">

                    {{-- ID --}}
                    <td class="px-6 py-4 text-stone-400 text-xs">
                        #{{ $user->id }}
                    </td>

                    {{-- USER --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-700 font-semibold text-xs flex items-center justify-center">
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
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium
                            @if($user->role->name === 'admin')
                                bg-purple-50 text-purple-700
                            @else
                                bg-amber-50 text-amber-700
                            @endif">
                            {{ ucfirst($user->role->name) }}
                        </span>
                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium
                            {{ $user->status === 'active'
                                ? 'bg-green-50 text-green-700'
                                : 'bg-red-50 text-red-600' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>

                    {{-- ACTIONS --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2 flex-wrap">

                            {{-- EDIT --}}
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="text-xs text-stone-500 hover:text-amber-700 px-2 py-1 rounded hover:bg-amber-50 transition">
                                Edit
                            </a>

                            {{-- DELETE --}}
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                  onsubmit="return confirm('Delete {{ $user->name }}?')">
                                @csrf
                                @method('DELETE')

                                <button class="text-xs text-stone-500 hover:text-red-600 px-2 py-1 rounded hover:bg-red-50 transition">
                                    Delete
                                </button>
                            </form>

                            {{-- BAN / UNBAN --}}
                            @if($user->status === 'active')
                                <form method="POST" action="{{ route('admin.users.ban', $user) }}">
                                    @csrf
                                    <button class="text-xs text-stone-500 hover:text-yellow-600 px-2 py-1 rounded hover:bg-yellow-50 transition">
                                        Ban
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.users.unban', $user) }}">
                                    @csrf
                                    <button class="text-xs text-stone-500 hover:text-green-600 px-2 py-1 rounded hover:bg-green-50 transition">
                                        Unban
                                    </button>
                                </form>
                            @endif

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center">

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