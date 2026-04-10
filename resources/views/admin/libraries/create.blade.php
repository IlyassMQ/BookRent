@extends('layouts.admin')

@section('content')

<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">

<h2 class="text-lg font-semibold mb-4">Create Library</h2>

<form method="POST" action="{{ route('admin.libraries.store') }}">
@csrf

<input name="name" placeholder="Library Name" class="w-full mb-3 p-2 border rounded">

<input name="address" placeholder="Address" class="w-full mb-3 p-2 border rounded">

<input name="geo_lat" placeholder="Latitude" class="w-full mb-3 p-2 border rounded">
<input name="geo_lng" placeholder="Longitude" class="w-full mb-3 p-2 border rounded">

<select name="user_id" class="w-full mb-3 p-2 border rounded">
@foreach($users as $user)
    <option value="{{ $user->id }}">{{ $user->name }}</option>
@endforeach
</select>

<button class="w-full bg-indigo-600 text-white p-2 rounded">
Create
</button>

</form>

</div>

@endsection