@extends('layouts.admin')

@section('title', 'Categories')
@section('header', 'Categories Management')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-stone-800">Categories</h2>
            <p class="text-sm text-stone-400 mt-0.5">
                {{ $categories->count() }} categories
            </p>
        </div>

        <a href="{{ route('admin.categories.create') }}"
           class="bg-amber-700 hover:bg-amber-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
            + Add Category
        </a>
    </div>

    {{-- TABLE --}}
    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm overflow-hidden">

        <table class="w-full text-sm">

            {{-- HEADER --}}
            <thead class="bg-amber-50 text-stone-500 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="divide-y divide-amber-50">

                @forelse($categories as $category)
                <tr class="hover:bg-amber-50/40 transition">

                    {{-- NAME --}}
                    <td class="px-6 py-4 font-medium text-stone-800">
                        {{ $category->name }}
                    </td>

                    {{-- ACTIONS --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">

                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="text-xs text-stone-500 hover:text-amber-700 px-2 py-1 rounded hover:bg-amber-50 transition">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.categories.destroy', $category) }}"
                                  onsubmit="return confirm('Delete {{ $category->name }}?')">
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
                    <td colspan="2" class="px-6 py-16 text-center">

                        <div class="flex flex-col items-center gap-2 text-stone-400">
                            <span class="text-4xl">📂</span>
                            <p class="font-medium">No categories found</p>
                            <p class="text-xs">Start by creating your first category</p>
                        </div>

                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection