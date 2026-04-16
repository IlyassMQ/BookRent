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




{{-- BOOKS GRID --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

@foreach($books as $book)

    <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col hover:shadow-lg transition">

        {{-- IMAGE --}}
        <div class="h-48 bg-gray-100">
            <img src="{{ $book->image ? asset('storage/'.$book->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                 class="w-full h-full object-cover">
        </div>

        <div class="p-4 flex flex-col flex-1">

            {{-- TITLE --}}
            <h3 class="text-lg font-semibold mb-1 line-clamp-1">
                {{ $book->title }}
            </h3>

            {{-- AUTHOR --}}
            <p class="text-sm text-gray-600 mb-1">
                {{ $book->author }}
            </p>

            {{-- CATEGORY --}}
            <p class="text-xs text-gray-400 mb-2">
                {{ $book->category }}
            </p>

            {{-- STOCK --}}
            <div class="mb-2">
                @if($book->totalStock > 5)
            <span class="text-green-600">Available</span>
            @elseif($book->totalStock > 0)
                <span class="text-yellow-500">Limited stock</span>
            @else
                <span class="text-red-500">Out of stock</span>
            @endif
            </div>

            {{-- ACTIONS --}}
            <div class="mt-auto">

                @guest
                    <p class="text-xs text-gray-400">
                        Login to interact
                    </p>
                @else

                    @if($book->totalStock > 0)

                        <div class="flex gap-2">
                            <button class="flex-1 bg-green-500 text-white text-sm py-1 rounded hover:bg-green-600">
                                Rent
                            </button>

                            <button class="flex-1 bg-blue-500 text-white text-sm py-1 rounded hover:bg-blue-600">
                                Buy
                            </button>
                        </div>

                    @else
                        <button disabled
                            class="w-full bg-gray-300 text-gray-500 text-sm py-1 rounded">
                            Not Available
                        </button>
                    @endif

                @endguest

            </div>

        </div>

    </div>

@endforeach

</div>


{{-- PAGINATION --}}
<div class="mt-6">
    {{ $books->links() }}
</div>

@endsection