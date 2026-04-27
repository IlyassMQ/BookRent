@extends('layouts.admin')

@section('title', 'Edit User')
@section('header', 'Edit User')

@section('content')

<div class="max-w-lg mx-auto bg-white border border-amber-100 rounded-2xl shadow-sm p-6">

    <h2 class="text-lg font-semibold text-stone-800 mb-5">
        Edit User
    </h2>

    {{-- ERRORS --}}
    @if($errors->any())
        <div class="bg-red-50 text-red-600 px-3 py-2 rounded-lg mb-4 text-sm space-y-1">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- NAME --}}
        <div>
            <label class="text-sm text-stone-600">Full Name</label>
            <input name="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="text-sm text-stone-600">Email Address</label>
            <input name="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
        </div>
        {{-- ROLE --}}
        <div>
            <label class="text-sm text-stone-600">Role</label>
            <select name="role_id"
                class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">

                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                        @selected(old('role_id', $user->role_id) == $role->id)>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- SUBMIT --}}
        <button class="w-full bg-amber-700 hover:bg-amber-800 text-white py-2.5 rounded-lg font-medium transition">
            Update User
        </button>

    </form>

</div>

@endsection