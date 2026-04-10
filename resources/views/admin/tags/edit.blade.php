@extends('layouts.admin')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">

<h2 class="text-lg font-semibold mb-4">Edit Tag</h2>

<form method="POST" action="{{ route('admin.tags.update', $tag) }}">
@csrf
@method('PUT')

<input name="name"
       value="{{ $tag->name }}"
       class="w-full mb-3 p-2 border rounded">

<button class="w-full bg-indigo-600 text-white p-2 rounded">
Update
</button>

</form>

</div>

@endsection