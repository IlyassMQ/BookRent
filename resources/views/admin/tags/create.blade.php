{{-- resources/views/admin/tags/create.blade.php --}}
@extends('layouts.admin')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">

<h2 class="text-lg font-semibold mb-4">Create Tag</h2>

<form method="POST" action="{{ route('admin.tags.store') }}">
@csrf

<input name="name"
       placeholder="Tag name"
       class="w-full mb-3 p-2 border rounded">

<button class="w-full bg-indigo-600 text-white p-2 rounded">
Create
</button>

</form>

</div>

@endsection