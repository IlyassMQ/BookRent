<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Account') - BookRent</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .serif-font { font-family: 'Cormorant Garamond', serif; }
        
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #FBF7F0; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: #8B6914; border-radius: 10px; }
        
        .sidebar-link {
            transition: all 0.2s ease;
            position: relative;
        }
        .sidebar-link:hover {
            background: rgba(139, 69, 19, 0.1);
            color: #8B4513;
        }
        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(139, 69, 19, 0.1), rgba(107, 52, 16, 0.05));
            color: #8B4513;
            border-left: 3px solid #8B4513;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#FDF8F0] via-[#F9F2E6] to-[#F5E9DD]">

    <div class="flex min-h-screen">
        {{-- SIDEBAR --}}
        <aside class="w-72 bg-white border-r border-amber-200 shadow-xl fixed h-full overflow-y-auto">
            <div class="p-6">
                {{-- User Avatar --}}
                <div class="text-center mb-6">
                    <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-amber-600 to-amber-700 flex items-center justify-center shadow-lg mb-3">
                        <span class="text-3xl font-bold text-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </span>
                    </div>
                    <h3 class="font-semibold text-[#2C1810]">{{ Auth::user()->name }}</h3>
                    <p class="text-xs text-stone-500">{{ Auth::user()->email }}</p>
                </div>

                {{-- Navigation --}}
                <nav class="space-y-1">
                    <a href="{{ route('user.dashboard') }}" class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-stone-700 hover:bg-amber-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('user.profile.edit') }}" class="sidebar-link {{ request()->routeIs('user.profile.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-stone-700 hover:bg-amber-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile Settings
                    </a>
                    
                    <a href="{{ route('user.orders') }}" class="sidebar-link {{ request()->routeIs('user.orders*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-stone-700 hover:bg-amber-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        My Orders
                    </a>
                    
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-stone-500 hover:bg-amber-50 transition mt-4 border-t border-amber-100 pt-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Browse Books
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 ml-72">
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

    @yield('scripts')
</body>
</html>