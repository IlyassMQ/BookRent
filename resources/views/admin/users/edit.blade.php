@extends('layouts.admin')

@section('content')

<form method="POST" action="{{ route('admin.users.update', $user) }}" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
@csrf
@method('PUT')

<input name="name" value="{{ $user->name }}" class="w-full mb-3 p-2 border rounded">
<input name="email" value="{{ $user->email }}" class="w-full mb-3 p-2 border rounded">

<select name="role_id" class="w-full mb-3 p-2 border rounded">
@foreach($roles as $role)
<option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
    {{ $role->name }}
</option>
@endforeach
</select>

<button class="w-full bg-indigo-600 text-white p-2 rounded">
Update
</button>

</form>

@endsection