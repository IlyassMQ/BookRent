<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookRent')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-amber-50 text-stone-800">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-amber-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between gap-4">

            {{-- BRAND --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-lg font-semibold text-amber-800">
                <span class="w-8 h-8 bg-amber-700 text-white flex items-center justify-center rounded-lg shadow text-sm">
                    📚
                </span>
                BookRent
            </a>

            {{-- SEARCH --}}
            <form action="{{ route('books.category', 1) }}" method="GET"
                  class="hidden md:flex items-center gap-2">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search books..."
                       class="border border-stone-300 rounded-lg px-3 py-1.5 w-64
                              focus:ring-2 focus:ring-amber-500 focus:outline-none">

                <button class="bg-amber-700 hover:bg-amber-800 text-white px-3 py-1.5 rounded-lg transition">
                    🔍
                </button>
            </form>

            {{-- RIGHT --}}
            <div class="flex items-center gap-4 text-sm">

                @auth

                    <span class="text-stone-600 hidden sm:block">
                        {{ auth()->user()->name }}
                    </span>

                    {{-- USER --}}
                    @if(!auth()->user()->library)
                        <a href="{{ route('transactions.index') }}"
                           class="text-stone-600 hover:text-amber-700 transition">
                            My Orders
                        </a>

                        <a href="{{ route('library.create') }}"
                           class="text-stone-600 hover:text-amber-700 transition">
                            Create Library
                        </a>
                    @endif

                    {{-- LIBRARY --}}
                    @if(auth()->user()->library)
                        <a href="{{ route('library.dashboard') }}"
                           class="text-stone-600 hover:text-amber-700 transition">
                            Dashboard
                        </a>

                        <a href="{{ route('library.transactions') }}"
                           class="text-stone-600 hover:text-amber-700 transition">
                            Orders
                        </a>

                        <a href="{{ route('library.withdraw.index') }}"
                           class="text-stone-600 hover:text-amber-700 transition">
                            Validate
                        </a>
                    @endif

                    {{-- ADMIN --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="bg-amber-700 text-white px-3 py-1.5 rounded-lg hover:bg-amber-800 transition">
                            Admin
                        </a>
                    @endif

                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-500 hover:text-red-600 transition">
                            Logout
                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}"
                       class="text-stone-600 hover:text-amber-700 transition">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-amber-700 text-white px-3 py-1.5 rounded-lg hover:bg-amber-800 transition">
                        Register
                    </a>

                @endauth

            </div>

        </div>

        {{-- MOBILE SEARCH --}}
        <div class="md:hidden px-4 pb-3">
            <form action="{{ route('books.category', 1) }}" method="GET">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search..."
                       class="w-full border border-stone-300 rounded-lg px-3 py-2
                              focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </form>
        </div>
    </nav>

    {{-- FLASH --}}
    <div class="max-w-7xl mx-auto px-4 mt-4">

        @if(session('success'))
            <div class="bg-green-50 text-green-700 px-3 py-2 rounded-lg mb-3 text-sm flex items-center gap-2">
                ✔ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 text-red-600 px-3 py-2 rounded-lg mb-3 text-sm">
                {{ session('error') }}
            </div>
        @endif

    </div>

    {{-- CONTENT --}}
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>
@yield('scripts')
</body>
</html>