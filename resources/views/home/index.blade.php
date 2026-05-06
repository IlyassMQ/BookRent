@extends('layouts.app')

@section('title', 'BookRent - Your Digital Library')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HERO SECTION --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-amber-50 via-amber-100/50 to-amber-50 rounded-2xl shadow-lg border border-amber-200 mb-10">
        
        {{-- Decorative book icons background --}}
        <div class="absolute top-0 left-0 opacity-10 transform -translate-x-8 -translate-y-8">
            <svg class="w-48 h-48 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <div class="absolute bottom-0 right-0 opacity-10 transform translate-x-8 translate-y-8">
            <svg class="w-48 h-48 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
            </svg>
        </div>

        <div class="relative z-10 p-8 md:p-12 text-center">
            <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm rounded-full px-4 py-2 mb-4 shadow-sm">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <span class="text-sm font-semibold text-amber-700">Welcome to BookRent</span>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold serif-font text-[#2C1810] mb-4">
                Discover Your Next<br>Great Read
            </h1>
            <p class="text-stone-600 text-lg max-w-2xl mx-auto mb-6">
                Rent or buy thousands of books from libraries across the country. Start your literary journey today.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white px-6 py-3 rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Join BookRent
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 border-2 border-amber-600 text-amber-700 hover:bg-amber-50 px-6 py-3 rounded-lg transition font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Sign In
                    </a>
                @else
                    <div class="text-center">
                        <p class="text-stone-600">Welcome back, <span class="font-semibold text-amber-700">{{ auth()->user()->name }}</span></p>
                        @if(auth()->user()->library && auth()->user()->library->status === 'pending')
                            <p class="text-xs text-yellow-600 mt-1">Your library is pending approval</p>
                        @endif
                    </div>
                @endguest
            </div>
        </div>
    </div>

    {{-- SEARCH SECTION --}}
    <div class="mb-10">
        <div class="flex items-center gap-2 mb-3">
            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <h2 class="text-lg font-semibold serif-font text-[#2C1810]">Find Your Next Book</h2>
        </div>
        <form method="GET" action="{{ route('home') }}">
            <div class="flex gap-2">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search by title, author"
                           class="w-full pl-10 pr-3 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all">
                </div>
                <button type="submit" class="bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white px-6 rounded-lg transition shadow-md hover:shadow-lg font-medium">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('home') }}" class="bg-stone-200 hover:bg-stone-300 text-stone-700 px-4 rounded-lg transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Clear
                    </a>
                @endif
            </div>
        </form>
        @if(request('search'))
            <p class="text-sm text-stone-500 mt-2">
                Found {{ $books->total() }} result(s) for "<span class="font-medium text-amber-700">{{ request('search') }}</span>"
            </p>
        @endif
    </div>

    {{-- QUICK ACTION BUTTONS (Recommendations & Nearby) --}}
    @auth
        @if(!auth()->user()->library)
            <div class="mb-8">
                <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                    <a href="{{ route('recommendations') }}" 
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white px-5 py-2.5 rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Personalized Recommendations
                    </a>
                    <a href="{{ route('nearby') }}" 
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2.5 rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Books Near You
                    </a>
                    <a href="{{ route('libraries') }}" 
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2.5 rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Browse Libraries
                    </a>
                </div>
                <div class="mt-3 text-xs text-stone-400 text-center md:text-left">
                    Discover books tailored to your taste or find libraries close to your location
                </div>
            </div>
        @endif
    @endauth

    {{-- FEATURED SECTION TITLE --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-2">
            <div class="w-1 h-6 bg-gradient-to-b from-amber-600 to-amber-800 rounded-full"></div>
            <h2 class="text-xl font-bold serif-font text-[#2C1810]">
                @if(request('search')) Search Results @else Featured Books @endif
            </h2>
        </div>
    </div>

    {{-- BOOKS GRID --}}
    @if($books->isEmpty())
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 p-16 text-center">
            <div class="flex flex-col items-center gap-4">
                <div class="w-24 h-24 rounded-full bg-amber-50 flex items-center justify-center">
                    <svg class="w-12 h-12 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-stone-700">No books found</h3>
                <p class="text-stone-400">Try adjusting your search or browse our collection</p>
                <a href="{{ route('home') }}" class="mt-2 inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#8B4513] to-[#6B3410] text-white rounded-lg hover:shadow-lg transition">
                    Browse All Books
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-amber-100 hover:border-amber-300 transform hover:-translate-y-1 flex flex-col">
                    
                    {{-- BOOK COVER --}}
                    <a href="{{ route('books.show', $book->id) }}" class="relative h-56 block overflow-hidden bg-gradient-to-br from-amber-50 to-stone-100">
                        <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                             alt="{{ $book->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        
                        {{-- Stock Badge --}}
                        <div class="absolute top-3 right-3">
                            @if($book->totalStock > 5)
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold bg-emerald-500 text-white rounded-lg shadow-md">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Available
                                </span>
                            @elseif($book->totalStock > 0)
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold bg-yellow-500 text-white rounded-lg shadow-md">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Limited
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold bg-red-500 text-white rounded-lg shadow-md">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Out of Stock
                                </span>
                            @endif
                        </div>
                    </a>

                    {{-- BOOK INFO --}}
                    <div class="p-4 flex flex-col flex-1">
                        <a href="{{ route('books.show', $book->id) }}" class="group/title">
                            <h3 class="text-base font-bold serif-font text-[#2C1810] group-hover/title:text-amber-700 transition-colors line-clamp-2 mb-1">
                                {{ $book->title }}
                            </h3>
                        </a>

                        <div class="flex items-center gap-1 mb-2">
                            <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <p class="text-xs text-stone-600 line-clamp-1">
                                {{ $book->author }}
                            </p>
                        </div>

                        <div class="flex items-center gap-1 mb-3">
                            <svg class="w-3 h-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                            <p class="text-xs text-stone-500">
                                {{ $book->category->name ?? 'Uncategorized' }}
                            </p>
                        </div>

                        <div class="flex items-center gap-1 mb-3">
                            <svg class="w-3 h-3 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <p class="text-xs text-stone-500 line-clamp-1">
                                {{ $book->library->name ?? 'Unknown Library' }}
                            </p>
                        </div>

                        {{-- Price Row --}}
                        <div class="grid grid-cols-2 gap-2 mb-3 pt-2 border-t border-amber-100">
                            <div class="text-center">
                                <p class="text-xs text-stone-400">Buy</p>
                                <p class="text-sm font-bold text-emerald-700">{{ number_format($book->purchase_price, 2) }} DH</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-stone-400">Rent/day</p>
                                <p class="text-sm font-bold text-blue-700">{{ number_format($book->rental_price, 2) }} DH</p>
                            </div>
                        </div>

                        {{-- ACTION BUTTON --}}
                        <div class="mt-auto">
                            @guest
                                <a href="{{ route('login') }}" class="block w-full text-center border-2 border-amber-600 text-amber-700 py-1.5 rounded-lg text-xs font-medium hover:bg-amber-50 transition">
                                    Login to Buy or Rent
                                </a>
                            @else
                                @if(auth()->user()->library && auth()->user()->library->id === $book->library_id)
                                    <p class="text-center text-xs text-stone-400 py-1.5">Your library</p>
                                @else
                                    <a href="{{ route('books.show', $book->id) }}"
                                       class="block w-full text-center bg-gradient-to-r from-amber-700 to-amber-800 hover:from-amber-800 hover:to-amber-900 text-white py-1.5 rounded-lg text-xs font-medium transition shadow-md hover:shadow-lg">
                                        View Details
                                    </a>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- PAGINATION --}}
    @if($books->hasPages())
        <div class="mt-10 flex justify-center">
            <div class="bg-white rounded-xl shadow-md border border-amber-100 px-4 py-2">
                {{ $books->links() }}
            </div>
        </div>
    @endif

</div>

@endsection