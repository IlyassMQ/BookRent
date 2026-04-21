@extends('layouts.app')

@section('title', 'My Transactions')

@section('content')

<div class="max-w-6xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">My Transactions</h1>

    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-3 text-left">Book</th>
                    <th class="p-3 text-left">Type</th>
                    <th class="p-3 text-left">Quantity</th>
                    <th class="p-3 text-left">Rental</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Code</th>
                </tr>
            </thead>

            <tbody>

                @forelse($transactions as $t)
                <tr class="border-t hover:bg-gray-50">

                    {{-- BOOK --}}
                    <td class="p-3 font-medium">
                        {{ $t->book->title }}
                    </td>

                    {{-- TYPE --}}
                    <td class="p-3 capitalize">
                        {{ $t->type }}
                    </td>

                    {{-- QUANTITY --}}
                    <td class="p-3">
                        {{ $t->quantity }}
                    </td>

                    {{-- RENTAL --}}
                    <td class="p-3">
                        @if($t->type === 'rental')
                            {{ $t->rental_start }} → {{ $t->rental_end }}
                        @else
                            -
                        @endif
                    </td>

                    {{-- TOTAL --}}
                    <td class="p-3 font-semibold">
                        {{ $t->payment->amount ?? 0 }} DH
                    </td>

                    {{-- STATUS --}}
                    <td class="p-3">
                        @if($t->status === 'pending')
                            <span class="text-yellow-500">Pending</span>
                        @elseif($t->status === 'paid')
                            <span class="text-green-600">Paid</span>
                        @else
                            <span class="text-red-500">Cancelled</span>
                        @endif
                    </td>

                    {{-- CODE --}}
                    <td class="p-3">
                        @if($t->status === 'paid')
                            <span class="bg-gray-200 px-2 py-1 rounded text-xs">
                                {{ $t->code_retrait }}
                            </span>
                        @else
                            -
                        @endif
                    </td>

                </tr>
                @empty

                <tr>
                    <td colspan="7" class="text-center p-4 text-gray-500">
                        No transactions yet
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection