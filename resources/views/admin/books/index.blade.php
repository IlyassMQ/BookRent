@extends('layouts.admin')

@section('title', 'Books')
@section('header', 'Books Management')

@section('content')

{{-- HEADER --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-semibold text-stone-800">Books</h2>
        <p class="text-sm text-stone-400 mt-0.5">
            {{ $books->count() }} books available
        </p>
    </div>

    <a href="{{ route('admin.books.create') }}"
       class="bg-amber-700 hover:bg-amber-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
        + Add Book
    </a>
</div>

{{-- TABLE --}}
<div class="bg-white border border-amber-100 rounded-2xl shadow-sm overflow-hidden">

    <table class="w-full text-sm">

        {{-- HEADER --}}
        <thead class="bg-amber-50 text-stone-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">Title</th>
                <th class="px-6 py-4 text-left">Author</th>
                <th class="px-6 py-4 text-left">Category</th>
                <th class="px-6 py-4 text-left">Prices</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="divide-y divide-amber-50">

            @forelse($books as $book)
            <tr class="hover:bg-amber-50/40 transition">

                {{-- TITLE --}}
                <td class="px-6 py-4 font-medium text-stone-800">
                    {{ $book->title }}
                </td>

                {{-- AUTHOR --}}
                <td class="px-6 py-4 text-stone-600">
                    {{ $book->author }}
                </td>

                {{-- CATEGORY --}}
                <td class="px-6 py-4 text-stone-500">
                    {{ $book->category->name ?? 'No Category' }}
                </td>

                {{-- PRICES --}}
                <td class="px-6 py-4 space-y-1 text-xs">

                    <div class="inline-block px-2 py-1 rounded bg-green-50 text-green-700">
                        Buy: {{ $book->purchase_price }} DH
                    </div>

                    <div class="inline-block px-2 py-1 rounded bg-blue-50 text-blue-700">
                        Rent: {{ $book->rental_price }} DH
                    </div>

                </td>

                {{-- ACTIONS --}}
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">

                        <a href="{{ route('admin.books.edit', $book) }}"
                           class="text-xs text-stone-500 hover:text-amber-700 px-2 py-1 rounded hover:bg-amber-50 transition">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.books.destroy', $book) }}"
                              onsubmit="return confirm('Delete {{ $book->title }}?')">
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
                <td colspan="5" class="px-6 py-16 text-center">

                    <div class="flex flex-col items-center gap-2 text-stone-400">
                        <span class="text-4xl">📚</span>
                        <p class="font-medium">No books found</p>
                        <p class="text-xs">Start by adding your first book</p>
                    </div>

                </td>
            </tr>
            @endforelse

        </tbody>

    </table>

</div>

@endsection