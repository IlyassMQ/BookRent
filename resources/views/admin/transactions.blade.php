@extends('layouts.admin')

@section('title', 'Transactions')
@section('header', 'Transactions Management')

@section('content')

<div class="mb-6">
    <h2 class="text-xl font-semibold text-stone-800">All Transactions</h2>
    <p class="text-sm text-stone-400">{{ $transactions->count() }} transactions</p>
</div>

<div class="bg-white border border-amber-100 rounded-2xl shadow-sm overflow-hidden">

    <table class="w-full text-sm">

        {{-- HEADER --}}
        <thead class="bg-amber-50 text-stone-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">#</th>
                <th class="px-6 py-4 text-left">User</th>
                <th class="px-6 py-4 text-left">Book</th>
                <th class="px-6 py-4 text-left">Library</th>
                <th class="px-6 py-4 text-left">Type</th>
                <th class="px-6 py-4 text-left">Status</th>
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="divide-y divide-amber-50">

            @forelse($transactions as $transaction)
            <tr class="hover:bg-amber-50/40 transition">

                {{-- ID --}}
                <td class="px-6 py-4 text-stone-400 text-xs">
                    #{{ $transaction->id }}
                </td>

                {{-- USER --}}
                <td class="px-6 py-4 font-medium text-stone-800">
                    {{ $transaction->user->name }}
                </td>

                {{-- BOOK --}}
                <td class="px-6 py-4 text-stone-600">
                    {{ $transaction->book->title }}
                </td>

                {{-- LIBRARY --}}
                <td class="px-6 py-4 text-stone-500">
                    {{ $transaction->library->name }}
                </td>

                {{-- TYPE --}}
                <td class="px-6 py-4">
                    <span class="px-2.5 py-1 text-xs rounded-full font-medium
                        {{ $transaction->type === 'purchase'
                            ? 'bg-green-50 text-green-700'
                            : 'bg-blue-50 text-blue-700' }}">
                        {{ ucfirst($transaction->type) }}
                    </span>
                </td>

                {{-- STATUS --}}
                <td class="px-6 py-4">
                    <span class="px-2.5 py-1 text-xs rounded-full font-medium

                        @if($transaction->status === 'completed')
                            bg-green-50 text-green-700
                        @elseif($transaction->status === 'paid')
                            bg-blue-50 text-blue-700
                        @elseif($transaction->status === 'pending')
                            bg-yellow-50 text-yellow-700
                        @else
                            bg-red-50 text-red-600
                        @endif

                    ">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="6" class="text-center py-12 text-stone-400">

                    <div class="flex flex-col items-center gap-2">
                        <span class="text-2xl">📚</span>
                        <p>No transactions yet</p>
                    </div>

                </td>
            </tr>
            @endforelse

        </tbody>

    </table>

</div>

@endsection