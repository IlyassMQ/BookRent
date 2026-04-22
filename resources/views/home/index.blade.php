@extends('layouts.app')

@section('title', 'BookRent Home')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">📚 BookRent</h1>
            <p class="text-gray-500 text-sm">Discover, rent and buy books easily</p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">

            @guest
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
                <a href="{{ route('register') }}" class="text-green-500 hover:underline">Register</a>

            @else

                <a href="{{ route('library.dashboard') }}" class="text-blue-500 hover:underline">
                    Dashboard
                </a>

                <a href="{{ route('recommendations') }}" class="text-green-500 hover:underline">
                    Recommendations
                </a>

                @if(auth()->user()->library)

                    @if(auth()->user()->library->status === 'pending')
                        <span class="text-yellow-500 text-sm">
                            Library Pending Approval
                        </span>
                    @else
                        <a href="{{ route('library.dashboard') }}"
                           class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700">
                            My Library
                        </a>
                    @endif

                @else
                
                @endif

                <a href="{{ route('library.create') }}"
                   class="bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700">
                    Create Library
                </a>

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
                placeholder="🔍 Search books, authors..."
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >

            <button class="bg-indigo-600 text-white px-5 rounded-lg hover:bg-indigo-700">
                Search
            </button>

            @if(request('search'))
            <a href="{{ route('home') }}" class="bg-red-600 text-white px-4 rounded-lg hover:bg-red-700 flex items-center">
                Clear
            </a>
            @endif
        </div>
    </form>

    {{-- BOOKS GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    @foreach($books as $book)
        <div class="bg-white shadow-sm rounded-xl overflow-hidden flex flex-col hover:shadow-xl transition duration-300 group h-full">

            {{-- IMAGE --}}
            <a href="{{ route('books.show', $book->id) }}" class="h-52 bg-gray-100 overflow-hidden block">
                <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                     alt="{{ $book->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
            </a>

            <div class="p-4 flex flex-col flex-1">

                {{-- TITLE --}}
                <h3 class="text-lg font-semibold text-gray-800 mb-1 line-clamp-1">
                    {{ $book->title }}
                </h3>

                {{-- AUTHOR --}}
                <p class="text-sm text-gray-500 mb-1">
                    {{ $book->author }}
                </p>

                {{-- CATEGORY --}}
                <p class="text-xs text-gray-400 mb-2">
                    {{ $book->category->name ?? 'No Category' }}
                </p>

                {{-- STOCK --}}
                <div class="mb-3 text-sm font-medium">
                    @if($book->totalStock > 5)
                        <span class="text-green-600">Available</span>
                    @elseif($book->totalStock > 0)
                        <span class="text-yellow-500">Limited stock</span>
                    @else
                        <span class="text-red-500">Out of stock</span>
                    @endif
                </div>
                <p class="text-sm text-gray-500 mb-1">
                    {{ $book->library->name ?? 'Unknown Library' }}
                </p>

                {{-- ACTIONS --}}
                <div class="mt-auto">

                    @guest
                        <p class="text-xs text-gray-400">
                            Login to interact
                        </p>
                    @else

                        @if(auth()->user()->library && auth()->user()->library->id === $book->library_id)

                            <p class="text-xs text-gray-400">
                                Library account
                            </p>

                        @else
                            <a href="{{ route('books.show', $book->id) }}"
                               class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm font-medium">
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