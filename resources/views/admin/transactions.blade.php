@extends('layouts.admin')

@section('title', 'Transactions')
@section('header', 'Transactions Management')

@section('content')

<div style="font-family: 'Geist', sans-serif;">

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">All Transactions</h2>
        <p class="text-sm text-gray-400">{{ $transactions->count() }} transactions</p>
    </div>

    <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-xs text-gray-400">#</th>
                    <th class="px-6 py-4 text-xs text-gray-400">User</th>
                    <th class="px-6 py-4 text-xs text-gray-400">Book</th>
                    <th class="px-6 py-4 text-xs text-gray-400">Library</th>
                    <th class="px-6 py-4 text-xs text-gray-400">Type</th>
                    <th class="px-6 py-4 text-xs text-gray-400">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50">
                @forelse($transactions as $transaction)
                <tr class="hover:bg-gray-50">

                    <td class="px-6 py-4 text-gray-300 text-xs">
                        {{ $transaction->id }}
                    </td>

                    <td class="px-6 py-4 text-gray-800">
                        {{ $transaction->user->name }}
                    </td>

                    <td class="px-6 py-4 text-gray-500">
                        {{ $transaction->book->title }}
                    </td>

                    <td class="px-6 py-4 text-gray-500">
                        {{ $transaction->library->name }}
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $transaction->type === 'purchase'
                                ? 'bg-green-50 text-green-700'
                                : 'bg-blue-50 text-blue-700' }}">
                            {{ ucfirst($transaction->type) }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $transaction->status === 'completed'
                                ? 'bg-green-50 text-green-700'
                                : 'bg-yellow-50 text-yellow-700' }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-400">
                        No transactions found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection