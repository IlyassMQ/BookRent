@extends('layouts.admin')

@section('title', 'Create Tag')
@section('header', 'Create Tag')

@section('content')

<div class="max-w-md mx-auto bg-white border border-amber-100 rounded-2xl shadow-sm p-6">

    <h2 class="text-lg font-semibold text-stone-800 mb-5">
        Add New Tag
    </h2>

    {{-- ERRORS --}}
    @if($errors->any())
        <div class="bg-red-50 text-red-600 px-3 py-2 rounded-lg mb-4 text-sm space-y-1">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.tags.store') }}" class="space-y-4">
        @csrf

        {{-- NAME --}}
        <div>
            <label class="text-sm text-stone-600">Tag Name</label>
            <input name="name"
                   value="{{ old('name') }}"
                   placeholder="e.g. Programming, History..."
                   class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
        </div>

        {{-- SUBMIT --}}
        <button class="w-full bg-amber-700 hover:bg-amber-800 text-white py-2.5 rounded-lg font-medium transition">
            Create Tag
        </button>

    </form>

</div>

@endsection