@extends('layouts.admin')

@section('title', 'Users')
@section('header', 'Users Management')

@section('content')

<div style="font-family: 'Geist', sans-serif;">

    {{-- Header Bar --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">All Users</h2>
            <p class="text-sm text-gray-400 mt-0.5">{{ $users->count() }} registered users</p>
        </div>
        <a href="{{ route('admin.users.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Add User
        </a>
    </div>

    {{-- Table Card --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">

            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/60">
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-6 py-4 w-12">#</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-6 py-4">User</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-6 py-4">Email</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-6 py-4">Role</th>
                    <th class="text-right text-xs font-semibold text-gray-400 uppercase tracking-wider px-6 py-4">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors group">

                        {{-- ID --}}
                        <td class="px-6 py-4 text-gray-300 font-mono text-xs">
                            {{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}
                        </td>

                        {{-- User with Avatar --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 font-semibold text-xs flex items-center justify-center flex-shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <span class="font-medium text-gray-800">{{ $user->name }}</span>
                            </div>
                        </td>

                        {{-- Email --}}
                        <td class="px-6 py-4 text-gray-500">
                            {{ $user->email }}
                        </td>

                        {{-- Role Badge --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($user->role->name === 'admin')
                                    bg-purple-50 text-purple-700
                                @else
                                    bg-emerald-50 text-emerald-700
                                @endif">
                                {{ ucfirst($user->role->name) }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="text-xs text-gray-400 hover:text-indigo-600 font-medium transition px-2 py-1 rounded hover:bg-indigo-50">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                      onsubmit="return confirm('Delete {{ $user->name }}? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-xs text-gray-400 hover:text-red-600 font-medium transition px-2 py-1 rounded hover:bg-red-50">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="text-gray-300 text-4xl mb-3">👤</div>
                            <p class="text-gray-400 font-medium">No users found</p>
                            <p class="text-gray-300 text-xs mt-1">Add your first user to get started</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection