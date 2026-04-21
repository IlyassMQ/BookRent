@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow text-center">
    <h2 class="text-xl font-bold text-red-600 mb-3">Payment cancelled</h2>
    <p class="text-gray-600 mb-4">
        Your payment was not completed.
    </p>

    <a href="{{ url('/') }}"
       class="bg-gray-700 text-white px-4 py-2 rounded">
        Back to Home
    </a>
</div>
@endsection