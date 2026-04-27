@extends('layouts.admin')

@section('title', 'Libraries')
@section('header', 'Libraries Management')

@section('content')

{{-- HEADER --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-semibold text-stone-800">Libraries</h2>
        <p class="text-sm text-stone-400 mt-0.5">
            {{ $libraries->count() }} libraries
        </p>
    </div>

    <a href="{{ route('admin.libraries.create') }}"
       class="bg-amber-700 hover:bg-amber-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
        + Add Library
    </a>
</div>

{{-- TABLE --}}
<div class="bg-white border border-amber-100 rounded-2xl shadow-sm overflow-hidden">

    <table class="w-full text-sm">

        {{-- HEADER --}}
        <thead class="bg-amber-50 text-stone-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">Name</th>
                <th class="px-6 py-4 text-left">Owner</th>
                <th class="px-6 py-4 text-left">Status</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="divide-y divide-amber-50">

            @forelse($libraries as $library)
            <tr class="hover:bg-amber-50/40 transition">

                {{-- NAME --}}
                <td class="px-6 py-4 font-medium text-stone-800">
                    {{ $library->name }}
                </td>

                {{-- OWNER --}}
                <td class="px-6 py-4 text-stone-600">
                    {{ $library->user->name }}
                </td>

                {{-- STATUS --}}
                <td class="px-6 py-4">
                    <span class="px-2.5 py-1 text-xs rounded-full font-medium

                        @if($library->status === 'approved')
                            bg-green-50 text-green-700
                        @elseif($library->status === 'blocked')
                            bg-red-50 text-red-600
                        @else
                            bg-yellow-50 text-yellow-700
                        @endif

                    ">
                        {{ ucfirst($library->status) }}
                    </span>
                </td>

                {{-- ACTIONS --}}
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">

                        {{-- APPROVE --}}
                        <form method="POST" action="{{ route('admin.libraries.approve', $library) }}">
                            @csrf
                            <button class="text-xs text-stone-500 hover:text-green-600 px-2 py-1 rounded hover:bg-green-50 transition">
                                Approve
                            </button>
                        </form>

                        {{-- BLOCK --}}
                        <form method="POST" action="{{ route('admin.libraries.block', $library) }}">
                            @csrf
                            <button class="text-xs text-stone-500 hover:text-yellow-600 px-2 py-1 rounded hover:bg-yellow-50 transition">
                                Block
                            </button>
                        </form>

                        {{-- DELETE --}}
                        <form method="POST" action="{{ route('admin.libraries.destroy', $library) }}"
                              onsubmit="return confirm('Delete {{ $library->name }}?')">
                            @csrf
                            @method('DELETE')

                            <button class="text-xs text-stone-500 hover:text-red-600 px-2 py-1 rounded hover:bg-red-50 transition">
                                Delete
                            </button>
                        </form>

                    </div>
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="4" class="px-6 py-16 text-center">

                    <div class="flex flex-col items-center gap-2 text-stone-400">
                        <span class="text-4xl">🏛️</span>
                        <p class="font-medium">No libraries found</p>
                        <p class="text-xs">Create your first library</p>
                    </div>

                </td>
            </tr>
            @endforelse

        </tbody>

    </table>

</div>

@endsection