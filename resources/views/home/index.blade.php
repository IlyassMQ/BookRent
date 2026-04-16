@extends('layouts.app')

@section('title', 'BookRent Home')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Welcome to BookRent</h1>

    <div class="flex items-center gap-3">

        @guest
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
            <a href="{{ route('register') }}" class="text-green-500 hover:underline">Register</a>

        @else

            {{-- DASHBOARD --}}
            <a href="{{ route('library.dashboard') }}" class="text-blue-500 hover:underline">
                Dashboard
            </a>

            {{-- LIBRARY STATUS / BUTTON --}}
            @if(auth()->user()->library)

                @if(auth()->user()->library->status === 'pending')
                    <span class="text-yellow-500 text-sm">
                        Library Pending Approval
                    </span>
                @else
                    <a href="{{ route('library.dashboard') }}"
                       class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                        My Library
                    </a>
                @endif

            @else
                
            @endif
            <a href="{{ route('library.create') }}"
                   class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">
                    Create Library
                </a>
            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-500 hover:underline">
                    Logout
                </button>
            </form>

        @endguest

    </div>
</div>

{{-- BOOKS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

@foreach($books as $book)

    @php
        $totalStock = $book->stocks->sum('quantity');
    @endphp

    <div class="bg-white shadow-md rounded p-4 flex flex-col">

        <h3 class="text-lg font-bold mb-1">{{ $book->title }}</h3>

        <p class="text-gray-600 mb-1">Author: {{ $book->author }}</p>
        <p class="text-gray-500 mb-2">Category: {{ $book->category }}</p>

        {{-- TAGS --}}
        <div class="flex flex-wrap gap-1 mb-2">
            @foreach($book->tags as $tag)
                <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>

        {{-- STOCK --}}
        <div class="mb-3">
            @if($totalStock > 0)
                <span class="text-green-600 text-sm font-semibold">
                    Available ({{ $totalStock }} copies)
                </span>
            @else
                <span class="text-red-500 text-sm font-semibold">
                    Out of stock
                </span>
            @endif
        </div>

        {{-- LIBRARIES --}}
        @if($totalStock > 0)
            <div class="text-xs text-gray-500 mb-3">
                Available at:
                <ul class="list-disc ml-4">
                    @foreach($book->stocks as $stock)
                        @if($stock->quantity > 0)
                            <li>
                                {{ $stock->library->name }}
                                ({{ $stock->quantity }})
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ACTIONS --}}
        <div class="mt-auto">

            @guest
                <p class="text-sm text-gray-500">
                    Login to rent or purchase
                </p>
            @else

                @if($totalStock > 0)

                    <a href="#"
                       class="text-white bg-green-500 px-3 py-1 rounded hover:bg-green-600 mr-2">
                        Rent
                    </a>

                    <a href="#"
                       class="text-white bg-blue-500 px-3 py-1 rounded hover:bg-blue-600">
                        Purchase
                    </a>

                @else
                    <button disabled
                        class="bg-gray-300 text-gray-600 px-3 py-1 rounded cursor-not-allowed">
                        Not Available
                    </button>
                @endif

            @endguest

        </div>

    </div>

@endforeach

</div>

{{-- PAGINATION --}}
<div class="mt-6">
    {{ $books->links() }}
</div>

@endsection