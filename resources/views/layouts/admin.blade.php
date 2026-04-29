<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — BookRent Library Management</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        h1, h2, h3, .serif-font {
            font-family: 'Cormorant Garamond', serif;
        }
        
        /* Custom scrollbar for sidebar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #1C1917;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #8B6914;
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #D4A574;
        }
        
        /* Sidebar link animations */
        .sidebar-link {
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, #D4A574, #8B4513);
            transform: translateX(-100%);
            transition: transform 0.2s ease;
        }
        
        .sidebar-link.active::before,
        .sidebar-link:hover::before {
            transform: translateX(0);
        }
        
        /* Card hover effects */
        .admin-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .admin-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
        }
        
        /* Button styles */
        .admin-btn {
            transition: all 0.2s ease;
        }
        
        .admin-btn:hover {
            transform: translateY(-1px);
            filter: brightness(105%);
        }
        
        /* Table row hover */
        .table-row-hover {
            transition: all 0.15s ease;
        }
        
        .table-row-hover:hover {
            background-color: rgba(217, 119, 6, 0.05);
            transform: scale(1.01);
        }
        
        /* Animation for dashboard */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.4s ease-out;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#FDF8F0] via-[#F9F2E6] to-[#F5E9DD] text-[#2C1810]">

<div class="flex min-h-screen">

    {{-- SIDEBAR - Premium library theme --}}
    <aside class="w-64 bg-gradient-to-b from-[#1C1917] to-[#2C2418] text-white flex flex-col shadow-2xl">
        
        {{-- BRAND with book icon --}}
        <div class="px-6 py-6 border-b border-amber-800/30">
            <div class="flex items-center gap-2 mb-2">
                <div class="relative">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#D4A574] to-[#8B4513] rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-amber-500 rounded-full"></div>
                </div>
                <div>
                    <span class="text-lg font-bold serif-font tracking-wide">BookRent</span>
                    <p class="text-[10px] text-amber-400/80 uppercase tracking-wider">Library Management</p>
                </div>
            </div>
        </div>

        {{-- NAVIGATION --}}
        <nav class="flex-1 px-4 py-6 space-y-4 overflow-y-auto">
            
            <!-- Main Section -->
            <div>
                <p class="text-[11px] font-semibold text-amber-500/60 uppercase tracking-wider px-3 pb-2">
                    Main Dashboard
                </p>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                       {{ request()->is('admin/dashboard') ? 'bg-amber-700/20 text-amber-400 active' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                       {{ request()->is('admin/users*') ? 'bg-amber-700/20 text-amber-400 active' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>Users</span>
                        <span class="ml-auto text-[10px] px-1.5 py-0.5 bg-amber-700/30 rounded-full">Management</span>
                    </a>

                    <a href="{{ route('admin.libraries.index') }}"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                       {{ request()->is('admin/libraries*') ? 'bg-amber-700/20 text-amber-400 active' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span>Libraries</span>
                    </a>
                </div>
            </div>

            <!-- Catalog Section -->
            <div>
                <p class="text-[11px] font-semibold text-amber-500/60 uppercase tracking-wider px-3 pb-2">
                    📖 Catalog Management
                </p>
                <div class="space-y-1">
                    <a href="{{ route('admin.books.index') }}"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                       {{ request()->is('admin/books*') ? 'bg-amber-700/20 text-amber-400 active' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span>Books</span>
                    </a>

                    <a href="{{ route('admin.tags.index') }}"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                       {{ request()->is('admin/tags*') ? 'bg-amber-700/20 text-amber-400 active' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span>Tags</span>
                    </a>

                    <a href="{{ route('admin.categories.index') }}"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                       {{ request()->is('admin/categories*') ? 'bg-amber-700/20 text-amber-400 active' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                        <span>Categories</span>
                    </a>
                </div>
            </div>
        </nav>

        {{-- USER PROFILE SECTION --}}
        <div class="px-4 py-6 border-t border-amber-800/30 bg-black/20">
            <div class="flex items-center gap-3 px-2 mb-4">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-600 to-amber-700 text-white text-sm font-bold flex items-center justify-center shadow-lg">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-[#1C1917]"></div>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-white truncate">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-[11px] text-amber-400/80">
                        <span class="inline-flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Administrator
                        </span>
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center justify-center gap-2 text-sm bg-red-600/20 hover:bg-red-600/30 text-red-400 border border-red-500/30 py-2.5 rounded-lg transition-all duration-200 admin-btn">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT AREA --}}
    <div class="flex-1 flex flex-col overflow-x-hidden">
        
        {{-- TOP BAR with library theme --}}
        <header class="bg-white/90 backdrop-blur-md border-b border-amber-200/50 px-8 py-4 flex items-center justify-between shadow-sm sticky top-0 z-40">
            <div class="fade-in-up">
                <h1 class="text-2xl font-bold serif-font text-[#2C1810]">
                    @yield('header', 'Library Dashboard')
                </h1>
                <div class="flex items-center gap-2 mt-1">
                    <div class="w-8 h-0.5 bg-gradient-to-r from-amber-600 to-transparent rounded-full"></div>
                    <p class="text-xs text-stone-500">
                        @yield('subheader', 'Manage your library ecosystem')
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <!-- Quick actions dropdown -->
                <div class="relative group">
                    <button class="w-10 h-10 rounded-lg bg-amber-50 hover:bg-amber-100 border border-amber-200 flex items-center justify-center transition-all admin-btn">
                        <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>

                <div class="hidden md:flex items-center gap-2 text-sm bg-gradient-to-r from-amber-50 to-amber-100 px-4 py-2 rounded-full border border-amber-200 shadow-inner">
                    <div class="w-2 h-2 bg-green-600 rounded-full animate-pulse"></div>
                    <span class="text-stone-700 font-medium">{{ auth()->user()->email }}</span>
                </div>
            </div>
        </header>

        {{-- DYNAMIC CONTENT --}}
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="fade-in-up">
                @yield('content')
            </div>
        </main>

        {{-- FOOTER --}}
        <footer class="bg-white/50 backdrop-blur-sm border-t border-amber-200/30 px-8 py-4 mt-auto">
            <div class="flex items-center justify-between text-xs text-stone-500">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span>BookRent Admin Panel v1.0</span>
                </div>
                <div class="serif-font italic text-amber-600/60">
                    &copy; {{ date('Y') }} — Knowledge is power
                </div>
            </div>
        </footer>
    </div>
</div>

</body>
</html>