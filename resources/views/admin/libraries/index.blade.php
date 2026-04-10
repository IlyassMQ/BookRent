@extends('layouts.admin')

@section('content')

<div class="flex justify-between mb-6">
    <h2 class="text-xl font-semibold">Libraries</h2>

    <a href="{{ route('admin.libraries.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded">
        + Add Library
    </a>
</div>

<table class="w-full bg-white rounded shadow text-sm">

<thead class="bg-gray-50">
<tr>
    <th class="p-4 text-left">Name</th>
    <th class="p-4 text-left">Owner</th>
    <th class="p-4 text-left">Status</th>
    <th class="p-4 text-right">Actions</th>
</tr>
</thead>

<tbody>
@foreach($libraries as $library)
<tr class="border-t">

    <td class="p-4">{{ $library->name }}</td>

    <td class="p-4">{{ $library->user->name }}</td>

    <td class="p-4">
        <span class="px-2 py-1 text-xs rounded
            {{ $library->status === 'approved' ? 'bg-green-100' :
               ($library->status === 'blocked' ? 'bg-red-100' : 'bg-yellow-100') }}">
            {{ $library->status }}
        </span>
    </td>

    <td class="p-4 text-right flex gap-2 justify-end">

        <form method="POST" action="{{ route('admin.libraries.approve', $library) }}">
            @csrf
            <button class="text-green-600">Approve</button>
        </form>

        <form method="POST" action="{{ route('admin.libraries.block', $library) }}">
            @csrf
            <button class="text-yellow-600">Block</button>
        </form>

        <form method="POST" action="{{ route('admin.libraries.destroy', $library) }}">
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