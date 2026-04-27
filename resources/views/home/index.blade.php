@extends('layouts.app')

@section('title', 'BookRent Home')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">

        <div>
            <h1 class="text-3xl font-bold text-stone-800">📚 BookRent</h1>
            <p class="text-stone-500 text-sm">Discover, rent and buy books easily</p>
        </div>

        <div class="flex items-center gap-3 flex-wrap text-sm">

            @guest
                <a href="{{ route('login') }}" class="text-amber-700 hover:underline">Login</a>
                <a href="{{ route('register') }}" class="bg-amber-700 text-white px-3 py-1.5 rounded-lg hover:bg-amber-800">
                    Register
                </a>
            @else

                <a href="{{ route('transactions.index') }}" class="text-stone-600 hover:text-amber-700">
                    My Orders
                </a>

                <a href="{{ route('recommendations') }}" class="text-stone-600 hover:text-amber-700">
                    Recommendations
                </a>

                @if(auth()->user()->library)

                    @if(auth()->user()->library->status === 'pending')
                        <span class="text-yellow-600 text-xs">
                            Library Pending Approval
                        </span>
                    @else
                        <a href="{{ route('library.dashboard') }}"
                           class="bg-amber-700 text-white px-3 py-1.5 rounded-lg hover:bg-amber-800">
                            My Library
                        </a>
                    @endif

                @else
                    <a href="{{ route('library.create') }}"
                       class="bg-stone-800 text-white px-3 py-1.5 rounded-lg hover:bg-black">
                        Create Library
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:underline">
                        Logout
                    </button>
                </form>

            @endguest

        </div>
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('home') }}" class="mb-10">
        <div class="flex gap-2">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search books, authors..."
                class="w-full border border-stone-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none"
            >

            <button class="bg-amber-700 text-white px-5 rounded-lg hover:bg-amber-800">
                Search
            </button>

            @if(request('search'))
                <a href="{{ route('home') }}"
                   class="bg-red-600 text-white px-4 rounded-lg flex items-center hover:bg-red-700">
                    Clear
                </a>
            @endif

        </div>
    </form>

    {{-- BOOKS GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($books as $book)
        <div class="bg-white border border-amber-100 rounded-2xl shadow-sm hover:shadow-lg transition duration-300 flex flex-col overflow-hidden">

            {{-- IMAGE --}}
            <a href="{{ route('books.show', $book->id) }}" class="h-52 overflow-hidden block bg-stone-100">
                <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                     class="w-full h-full object-cover hover:scale-105 transition">
            </a>

            <div class="p-4 flex flex-col flex-1">

                {{-- TITLE --}}
                <h3 class="text-lg font-semibold text-stone-800 line-clamp-1">
                    {{ $book->title }}
                </h3>

                {{-- AUTHOR --}}
                <p class="text-sm text-stone-500">
                    {{ $book->author }}
                </p>

                {{-- CATEGORY --}}
                <p class="text-xs text-stone-400 mb-2">
                    {{ $book->category->name ?? 'No Category' }}
                </p>

                {{-- STOCK --}}
                <div class="mb-3 text-xs font-medium">
                    @if($book->totalStock > 5)
                        <span class="text-green-600">Available</span>
                    @elseif($book->totalStock > 0)
                        <span class="text-yellow-600">Limited stock</span>
                    @else
                        <span class="text-red-600">Out of stock</span>
                    @endif
                </div>

                {{-- LIBRARY --}}
                <p class="text-xs text-stone-500 mb-4">
                    {{ $book->library->name ?? 'Unknown Library' }}
                </p>

                {{-- ACTION --}}
                <div class="mt-auto">

                    @guest
                        <p class="text-xs text-stone-400">
                            Login to interact
                        </p>
                    @else

                        @if(auth()->user()->library && auth()->user()->library->id === $book->library_id)
                            <p class="text-xs text-stone-400">Library account</p>
                        @else
                            <a href="{{ route('books.show', $book->id) }}"
                               class="inline-block w-full text-center bg-amber-700 text-white py-2 rounded-lg text-sm font-medium hover:bg-amber-800">
                                View Details
                            </a>
                        @endif

                    @endguest

                </div>

            </div>

        </div>
        @endforeach

    </div>

    {{-- PAGINATION --}}
    <div class="mt-10 flex justify-center">
        {{ $books->links() }}
    </div>

</div>

@endsection