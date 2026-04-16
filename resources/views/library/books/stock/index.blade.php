

@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <h2 class="text-xl font-semibold mb-6">Stock Management</h2>

    {{-- ADD STOCK FORM --}}
    <div class="bg-white p-4 rounded shadow mb-6">

        <form method="POST" action="/library/stock" class="flex gap-3">
            @csrf

            <select name="book_id" class="border p-2 rounded w-full">
                @foreach(auth()->user()->library->books as $book)
                    <option value="{{ $book->id }}">
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>

            <input name="quantity" placeholder="Qty"
                   class="border p-2 rounded w-32">

            <button class="bg-indigo-600 text-white px-4 rounded">
                Add
            </button>

        </form>

    </div>

    {{-- STOCK TABLE --}}
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

                <td class="p-3">{{ $stock->quantity }}</td>

                <td class="p-3 text-right flex gap-2 justify-end">

                    {{-- UPDATE --}}
                    <form method="POST" action="/library/stock/{{ $stock->id }}">
                        @csrf
                        @method('PUT')

                        <input name="quantity"
                               value="{{ $stock->quantity }}"
                               class="border w-16 p-1 rounded">

                        <button class="text-blue-600">Update</button>
                    </form>

                    {{-- DELETE --}}
                    <form method="POST" action="/library/stock/{{ $stock->id }}">
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