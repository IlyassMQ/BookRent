<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — BookRent</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-56 bg-[#0f1117] text-white flex flex-col flex-shrink-0">

        <!-- Brand -->
        <div class="px-5 py-5 border-b border-white/5">
            <div class="w-7 h-7 bg-indigo-600 rounded-lg flex items-center justify-center text-sm mb-2">📚</div>
            <p class="text-sm font-medium text-white leading-tight">BookRent</p>
            <p class="text-xs text-gray-500 mt-0.5">Admin Panel</p>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 py-3 space-y-0.5">

            <p class="text-[10px] font-semibold text-gray-600 uppercase tracking-widest px-2 pt-2 pb-1">Main</p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/dashboard') ? 'bg-indigo-900/50 text-indigo-300' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                <span class="text-sm">⊞</span> Dashboard
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/users*') ? 'bg-indigo-900/50 text-indigo-300' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                <span class="text-sm">👤</span> Users
            </a>

            <a href="{{ route('admin.libraries.index') }}"
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/libraries*') ? 'bg-indigo-900/50 text-indigo-300' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                <span class="text-sm">🏛️</span> Libraries
            </a>

            <p class="text-[10px] font-semibold text-gray-600 uppercase tracking-widest px-2 pt-3 pb-1">Catalog</p>

            <a href="{{ route('admin.books.index') }}"
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/books*') ? 'bg-indigo-900/50 text-indigo-300' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                <span class="text-sm">📚</span> Books
            </a>

            <a href="#"
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/transactions*') ? 'bg-indigo-900/50 text-indigo-300' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                <span class="text-sm">🔄</span> Transactions
            </a>

            <a href="{{ route('admin.tags.index') }}"
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/tags*') ? 'bg-indigo-900/50 text-indigo-300' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                <span class="text-sm">🏷️</span> Tags
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/categories*') ? 'bg-indigo-900/50 text-indigo-300' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                <span class="text-sm">🏷️</span> Categories
            </a>

        </nav>

        <!-- User + Logout -->
        <div class="px-3 py-4 border-t border-white/5">
            <div class="flex items-center gap-2.5 px-2 mb-3">
                <div class="w-7 h-7 rounded-full bg-indigo-900 text-indigo-300 text-xs font-medium flex items-center justify-center flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <span class="text-xs text-gray-400 truncate">{{ auth()->user()->name }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-xs text-red-400 bg-red-950/40 hover:bg-red-950/70 border border-red-900/40 py-2 rounded-lg transition">
                    ↩ Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Topbar -->
        <header class="bg-white border-b border-gray-100 px-6 py-3.5 flex items-center justify-between flex-shrink-0">
            <div class="flex items-center gap-2">
                <h1 class="text-sm font-medium text-gray-800">@yield('header')</h1>
                <span class="text-gray-300">/</span>
                <span class="text-xs text-gray-400">overview</span>
            </div>
            <div class="flex items-center gap-2">
                <button class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center text-sm hover:bg-gray-100 transition">
                    🔔
                </button>
                <span class="text-xs text-gray-500 bg-gray-50 border border-gray-100 rounded-full px-3 py-1.5">
                    Welcome, {{ auth()->user()->name }}
                </span>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-6 overflow-auto">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>