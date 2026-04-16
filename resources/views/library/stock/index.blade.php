@extends('layouts.app')

@section('title', 'Stock Management')

@section('content')

<div class="max-w-5xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">Stock Management</h1>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- ADD STOCK --}}
    <div class="bg-white p-4 rounded shadow mb-6">

        <form method="POST" action="{{ route('library.stock.store') }}" class="flex gap-3">
            @csrf

            <select name="book_id" class="border p-2 rounded w-full">
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>

            <input name="quantity" placeholder="Qty"
                   class="border p-2 rounded w-32">

            <button class="bg-indigo-600 text-white px-4 rounded">
                Add
            </button>

        </form>

    </div>

    {{-- TABLE --}}
    <table class="w-full bg-white shadow rounded text-sm">

        <thead class="bg-gray-50">
            <tr>
                <th class="p-3 text-left">Book</th>
                <th class="p-3 text-left">Quantity</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($stocks as $stock)
            <tr class="border-t">

                <td class="p-3">{{ $stock->book->title }}</td>

                <td class="p-3">
                    <form method="POST" action="{{ route('library.stock.update', $stock->id) }}" class="flex gap-2">
                        @csrf
                        @method('PUT')

                        <input name="quantity"
                               value="{{ $stock->quantity }}"
                               class="border w-20 p-1 rounded">

                        <button class="text-blue-600">Update</button>
                    </form>
                </td>

                <td class="p-3 text-right">

                    <form method="POST" action="{{ route('library.stock.destroy', $stock->id) }}">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-600">Delete</button>
                    </form>

                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection