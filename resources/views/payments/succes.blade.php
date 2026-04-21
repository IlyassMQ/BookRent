@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow text-center">
    <h2 class="text-xl font-bold text-green-600 mb-3">Payment processing</h2>
    <p class="text-gray-600 mb-4">
        Your payment is being confirmed. You will see it in your transactions shortly.
    </p>

    <a href="{{ route('transactions.index') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded">
        Go to My Transactions
    </a>
</div>
@endsection