@extends('layouts.admin')

@section('title', 'Create Library')
@section('header', 'Create Library')

@section('content')

<div class="max-w-2xl mx-auto bg-white border border-amber-100 rounded-2xl shadow-sm p-6">

    <h2 class="text-lg font-semibold text-stone-800 mb-6">
        Add New Library
    </h2>

    {{-- ERRORS --}}
    @if($errors->any())
        <div class="bg-red-50 text-red-600 px-3 py-2 rounded-lg mb-4 text-sm space-y-1">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.libraries.store') }}" class="space-y-5">
        @csrf

        {{-- NAME --}}
        <div>
            <label class="text-sm text-stone-600">Library Name</label>
            <input name="name" value="{{ old('name') }}"
                class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
        </div>

        {{-- ADDRESS --}}
        <div>
            <label class="text-sm text-stone-600">Address</label>
            <input name="address" value="{{ old('address') }}"
                class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
        </div>

        {{-- GEO LOCATION --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-stone-600">Latitude</label>
                <input name="geo_lat" value="{{ old('geo_lat') }}"
                    placeholder="e.g. 31.6295"
                    class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="text-sm text-stone-600">Longitude</label>
                <input name="geo_lng" value="{{ old('geo_lng') }}"
                    placeholder="e.g. -7.9811"
                    class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            </div>
        </div>

        {{-- OWNER --}}
        <div>
            <label class="text-sm text-stone-600">Owner (User)</label>
            <select name="user_id"
                class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        @selected(old('user_id') == $user->id)>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- SUBMIT --}}
        <div class="pt-2">
            <button class="w-full bg-amber-700 hover:bg-amber-800 text-white py-2.5 rounded-lg font-medium transition">
                Create Library
            </button>
        </div>

    </form>

</div>

@endsection