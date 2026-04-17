@extends('layouts.admin')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-lg font-bold mb-4">Create Category</h2>

    @if($errors->any())
        <div class="text-red-500 mb-3">
            @foreach($errors->all() as $error)
                <div>- {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <input type="text" name="name"
               value="{{ old('name') }}"
               placeholder="Category name"
               class="w-full p-2 border rounded mb-3">

        <button class="w-full bg-indigo-600 text-white p-2 rounded">
            Create
        </button>
    </form>

</div>

@endsection