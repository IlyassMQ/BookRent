<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookRent — Your Digital Library')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        .serif-font,
        .book-title {
            font-family: 'Cormorant Garamond', serif;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #FBF7F0;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #8B6914, #6B4F12);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #6B4F12, #4A370C);
        }

        /* Smooth transitions */
        .nav-link {
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #D4A574, #8B4513);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Book card animation */
        .book-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -12px rgba(92, 46, 11, 0.15);
        }

        /* Input focus effects */
        .book-input:focus {
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
            border-color: #8B4513;
            transform: translateY(-1px);
        }

        /* Button hover effects */
        .book-btn {
            transition: all 0.2s ease;
        }

        .book-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(92, 46, 11, 0.2);
        }

        /* Dropdown menu animation */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-menu {
            animation: fadeInDown 0.2s ease-out;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#FDF8F0] via-[#F9F2E6] to-[#F5E9DD] text-[#2C1810]">

    {{-- NAVBAR --}}
    <nav class="bg-white/90 backdrop-blur-md border-b border-amber-200/50 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 lg:px-6">

            {{-- DESKTOP NAVIGATION --}}
            <div class="flex items-center justify-between gap-4">

                {{-- BRAND with book animation --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div class="relative">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-[#8B4513] to-[#5C2E0B] text-white flex items-center justify-center rounded-lg shadow-md transition-transform group-hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-amber-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>
                    </div>
                    <span
                        class="text-2xl font-bold serif-font bg-gradient-to-r from-[#5C2E0B] to-[#8B4513] bg-clip-text text-transparent">
                        BookRent
                    </span>
                </a>
                {{-- RIGHT MENU --}}
                <div class="flex items-center gap-3 text-sm">

                    @auth
                        {{-- Show My Profile only for regular users (not library accounts) --}}
                        @if(!auth()->user()->library && auth()->user()->role !== 'library')
                            <a href="{{ route('user.dashboard') }}"
                                class="flex items-center gap-3 px-4 py-2.5 text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                My Profile
                            </a>
                        @endif

                        {{-- USER MENU DROPDOWN --}}
                        <div class="relative group">
                            <button
                                class="flex items-center gap-1 text-stone-600 hover:text-amber-700 transition px-3 py-2 rounded-lg hover:bg-amber-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                <span>Menu</span>
                            </button>

                            <div
                                class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-amber-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 dropdown-menu z-50">
                                <div class="py-2">
                                    
                                    @if (!auth()->user()->library && auth()->user()->role !== 'library')
                                        <a href="{{ route('transactions.index') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                </path>
                                            </svg>
                                            My Orders
                                        </a>
                                        
                                        <a href="{{ route('recommendations') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                </path>
                                            </svg>
                                            Recommendations
                                        </a>

                                        <a href="{{ route('library.create') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                                                </path>
                                            </svg>
                                            Create Library
                                        </a>
                                        <div class="border-t border-amber-100 my-1"></div>
                                    @endif

                                    {{-- Library Dashboard for library accounts --}}
                                    @if(auth()->user()->library)
                                        <a href="{{ route('library.dashboard') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                                </path>
                                            </svg>
                                            Library Dashboard
                                        </a>

                                        <a href="{{ route('library.books.create') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Add Book
                                        </a>

                                        <a href="{{ route('library.stock.index') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg>
                                            Manage Stock
                                        </a>

                                        <a href="{{ route('library.withdraw.index') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Validate Pickup
                                        </a>
                                        <div class="border-t border-amber-100 my-1"></div>
                                    @endif

                                    {{-- Admin Panel --}}
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 bg-amber-700 text-white hover:bg-amber-800 transition mx-2 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Admin Panel
                                        </a>
                                        <div class="border-t border-amber-100 my-1"></div>
                                    @endif

                                    {{-- Logout Button --}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-3 w-full px-4 py-2.5 text-red-600 hover:bg-red-50 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @else
                        <a href="{{ route('login') }}"
                            class="text-stone-600 hover:text-amber-700 transition px-3 py-2 rounded-lg hover:bg-amber-50">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                            class="bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white px-5 py-2 rounded-lg transition-all book-btn shadow-md">
                            Get Started
                        </a>
                    @endauth

                </div>
            </div>

            {{-- MOBILE SEARCH --}}
            <div class="md:hidden mt-3">
                <form action="{{ route('books.category', 1) }}" method="GET">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search books..."
                            class="w-full border border-amber-200 rounded-lg pl-10 pr-3 py-2.5 text-sm
                                      focus:ring-2 focus:ring-amber-500 focus:border-amber-500 focus:outline-none
                                      bg-white/80 book-input">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-amber-600"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    {{-- FLASH MESSAGES with better styling --}}
    <div class="max-w-7xl mx-auto px-4 mt-6">
        @if(session('success'))
            <div
                class="bg-emerald-50 border-l-4 border-emerald-600 text-emerald-800 px-4 py-3 rounded-lg mb-4 text-sm shadow-md flex items-center gap-3 animate-slide-down">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div
                class="bg-red-50 border-l-4 border-red-600 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm shadow-md flex items-center gap-3 animate-slide-down">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    {{-- MAIN CONTENT --}}
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white/80 backdrop-blur-sm border-t border-amber-200/50 mt-16 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex items-center justify-center gap-2 mb-3">
                <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
                <span class="text-sm text-stone-600 serif-font italic">"A room without books is like a body without a
                    soul"</span>
            </div>
            <p class="text-xs text-stone-500">© {{ date('Y') }} BookRent. All rights reserved. 📖</p>
        </div>
    </footer>

    <style>
        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-slide-down {
            animation: slide-down 0.4s ease-out;
        }
    </style>

    @yield('scripts')
</body>

</html>