@extends('layouts.app')

@section('title', 'Library Orders')

@section('content')

<div class="max-w-6xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">Incoming Orders</h1>

    @if($transactions->isEmpty())
        <div class="bg-white p-6 rounded shadow text-gray-500 text-center">
            No transactions yet
        </div>
    @else

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 text-left">User</th>
                    <th class="p-4 text-left">Book</th>
                    <th class="p-4 text-left">Type</th>
                    <th class="p-4 text-left">Qty</th>
                    <th class="p-4 text-left">Rental</th>
                    <th class="p-4 text-left">Total</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Code</th>
                    <th class="p-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($transactions as $t)
                <tr class="border-t hover:bg-gray-50">

                    {{-- USER --}}
                    <td class="p-4">
                        {{ $t->user->name }}
                    </td>

                    {{-- BOOK --}}
                    <td class="p-4">
                        {{ $t->book->title }}
                    </td>

                    {{-- TYPE --}}
                    <td class="p-4 capitalize">
                        {{ $t->type }}
                    </td>

                    {{-- QUANTITY --}}
                    <td class="p-4">
                        {{ $t->quantity }}
                    </td>

                    {{-- RENTAL --}}
                    <td class="p-4 text-xs text-gray-600">
                        @if($t->type === 'rental')
                            {{ \Carbon\Carbon::parse($t->rental_start)->format('d M') }}
                            →
                            {{ \Carbon\Carbon::parse($t->rental_end)->format('d M') }}
                        @else
                            -
                        @endif
                    </td>

                    {{-- TOTAL --}}
                    <td class="p-4 font-semibold">
                        {{ $t->payment->amount ?? 0 }} DH
                    </td>

                    {{-- STATUS --}}
                    <td class="p-4">

                        @if($t->status === 'pending')
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs">
                                Pending
                            </span>

                        @elseif($t->status === 'paid')
                            <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-xs">
                                Paid
                            </span>

                        @elseif($t->status === 'completed')
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">
                                Completed
                            </span>

                        @else
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs">
                                Cancelled
                            </span>
                        @endif

                    </td>

                    {{-- CODE --}}
                    <td class="p-4">
                        @if($t->status === 'paid' || $t->status === 'completed')
                            <span class="bg-gray-200 px-2 py-1 rounded text-xs font-mono">
                                {{ $t->code_retrait }}
                            </span>
                        @else
                            -
                        @endif
                    </td>

                    {{-- ACTION --}}
                    <td class="p-4">

                        @if($t->status === 'paid')
                            <a href="{{ route('library.withdraw.index') }}"
                               class="bg-green-600 text-white px-3 py-1 rounded text-xs">
                                Confirm
                            </a>
                        @else
                            -
                        @endif

                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

    @endif

</div>

@endsection