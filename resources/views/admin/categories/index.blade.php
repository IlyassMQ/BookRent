@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Categories</h2>

        <a href="{{ route('admin.categories.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded">
            Add Category
        </a>
    </div>

    <div class="bg-white shadow rounded">

        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $category)
                    <tr class="border-t">
                        <td class="p-3">{{ $category->name }}</td>

                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="text-blue-500">Edit</a>

                            <form method="POST"
                                  action="{{ route('admin.categories.destroy', $category) }}">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

@endsection