@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold">User Dashboard</h1>

    <p class="mt-2 text-gray-600">
        Welcome {{ auth()->user()->role->name}}
    </p>
</div>

@endsection