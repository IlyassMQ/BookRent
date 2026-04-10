@extends('layouts.admin')

@section('content')

<div class="flex justify-between mb-6">
    <h2 class="text-xl font-semibold">Tags</h2>

    <a href="{{ route('admin.tags.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded">
        + Add Tag
    </a>
</div>

<table class="w-full bg-white rounded shadow text-sm">

<thead class="bg-gray-50">
<tr>
    <th class="p-4 text-left">#</th>
    <th class="p-4 text-left">Name</th>
    <th class="p-4 text-right">Actions</th>
</tr>
</thead>

<tbody>
@foreach($tags as $tag)
<tr class="border-t">

    <td class="p-4 text-gray-400">{{ $tag->id }}</td>

    <td class="p-4 font-medium">{{ $tag->name }}</td>

    <td class="p-4 text-right flex gap-2 justify-end">

        <a href="{{ route('admin.tags.edit', $tag) }}"
           class="text-indigo-600">Edit</a>

        <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}">
            @csrf
            @method('DELETE')
            <button class="text-red-600">Delete</button>
        </form>

    </td>

</tr>
@endforeach
</tbody>

</table>

@endsection