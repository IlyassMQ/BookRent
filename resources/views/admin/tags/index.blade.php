@extends('layouts.admin')

@section('title', 'Tags')
@section('header', 'Tags Management')

@section('content')

{{-- HEADER --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-semibold text-stone-800">Tags</h2>
        <p class="text-sm text-stone-400 mt-0.5">
            {{ $tags->count() }} tags
        </p>
    </div>

    <a href="{{ route('admin.tags.create') }}"
       class="bg-amber-700 hover:bg-amber-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
        + Add Tag
    </a>
</div>

{{-- TABLE --}}
<div class="bg-white border border-amber-100 rounded-2xl shadow-sm overflow-hidden">

    <table class="w-full text-sm">

        {{-- HEADER --}}
        <thead class="bg-amber-50 text-stone-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left w-16">#</th>
                <th class="px-6 py-4 text-left">Name</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="divide-y divide-amber-50">

            @forelse($tags as $tag)
            <tr class="hover:bg-amber-50/40 transition">

                {{-- ID --}}
                <td class="px-6 py-4 text-stone-400 text-xs">
                    #{{ $tag->id }}
                </td>

                {{-- NAME --}}
                <td class="px-6 py-4 font-medium text-stone-800">
                    {{ $tag->name }}
                </td>

                {{-- ACTIONS --}}
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">

                        <a href="{{ route('admin.tags.edit', $tag) }}"
                           class="text-xs text-stone-500 hover:text-amber-700 px-2 py-1 rounded hover:bg-amber-50 transition">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}"
                              onsubmit="return confirm('Delete {{ $tag->name }}?')">
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
                <td colspan="3" class="px-6 py-16 text-center">

                    <div class="flex flex-col items-center gap-2 text-stone-400">
                        <span class="text-4xl">🏷️</span>
                        <p class="font-medium">No tags found</p>
                        <p class="text-xs">Create your first tag to get started</p>
                    </div>

                </td>
            </tr>
            @endforelse

        </tbody>

    </table>

</div>

@endsection