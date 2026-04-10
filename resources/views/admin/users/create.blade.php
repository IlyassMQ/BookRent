@extends('layouts.admin')

@section('content')

<form method="POST" action="{{ route('admin.users.store') }}" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
@csrf

<input name="name" placeholder="Name" class="w-full mb-3 p-2 border rounded">
<input name="email" placeholder="Email" class="w-full mb-3 p-2 border rounded">
<input name="password" type="password" placeholder="Password" class="w-full mb-3 p-2 border rounded">

<select name="role_id" class="w-full mb-3 p-2 border rounded">
@foreach($roles as $role)
<option value="{{ $role->id }}">{{ $role->name }}</option>
@endforeach
</select>

<button class="w-full bg-indigo-600 text-white p-2 rounded">
Create
</button>

</form>

@endsection