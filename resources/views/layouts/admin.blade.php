<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — BookRent</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-amber-50 text-stone-800">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-56 bg-stone-900 text-white flex flex-col">

        {{-- BRAND --}}
        <div class="px-5 py-5 border-b border-white/10">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-8 h-8 bg-amber-700 rounded-lg flex items-center justify-center text-sm shadow">
                    📚
                </div>
                <span class="text-sm font-semibold">BookRent</span>
            </div>
            <p class="text-xs text-stone-400">Admin Panel</p>
        </div>

        {{-- NAV --}}
        <nav class="flex-1 px-3 py-4 space-y-1">

            <p class="text-[10px] font-semibold text-stone-400 uppercase tracking-widest px-2 pb-1">
                Main
            </p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/dashboard') ? 'bg-amber-700 text-white' : 'text-stone-400 hover:bg-white/5 hover:text-white' }}">
                ⊞ Dashboard
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/users*') ? 'bg-amber-700 text-white' : 'text-stone-400 hover:bg-white/5 hover:text-white' }}">
                👤 Users
            </a>

            <a href="{{ route('admin.libraries.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/libraries*') ? 'bg-amber-700 text-white' : 'text-stone-400 hover:bg-white/5 hover:text-white' }}">
                🏛️ Libraries
            </a>

            <p class="text-[10px] font-semibold text-stone-400 uppercase tracking-widest px-2 pt-4 pb-1">
                Catalog
            </p>

            <a href="{{ route('admin.books.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/books*') ? 'bg-amber-700 text-white' : 'text-stone-400 hover:bg-white/5 hover:text-white' }}">
                📚 Books
            </a>

            <a href="{{ route('admin.tags.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/tags*') ? 'bg-amber-700 text-white' : 'text-stone-400 hover:bg-white/5 hover:text-white' }}">
                🏷️ Tags
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition
               {{ request()->is('admin/categories*') ? 'bg-amber-700 text-white' : 'text-stone-400 hover:bg-white/5 hover:text-white' }}">
                📂 Categories
            </a>

        </nav>

        {{-- USER --}}
        <div class="px-3 py-4 border-t border-white/10">

            <div class="flex items-center gap-3 px-2 mb-3">
                <div class="w-8 h-8 rounded-full bg-amber-700 text-white text-xs font-semibold flex items-center justify-center">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>

                <div class="min-w-0">
                    <p class="text-xs text-white truncate">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-[10px] text-stone-400">
                        Admin
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-xs bg-red-600/10 hover:bg-red-600/20 text-red-400 border border-red-500/20 py-2 rounded-lg transition">
                    Logout
                </button>
            </form>

        </div>

    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col">

        {{-- TOPBAR --}}
        <header class="bg-white border-b border-amber-100 px-6 py-3 flex items-center justify-between">

            <div>
                <h1 class="text-sm font-semibold text-stone-800">
                    @yield('header')
                </h1>
                <p class="text-xs text-stone-400">
                    Admin overview
                </p>
            </div>

            <div class="flex items-center gap-3">

                <button class="w-9 h-9 rounded-lg border border-stone-200 bg-white hover:bg-amber-50 flex items-center justify-center transition">
                    🔔
                </button>

                <div class="text-xs text-stone-600 bg-amber-50 px-3 py-1.5 rounded-full border border-amber-100">
                    {{ auth()->user()->name }}
                </div>

            </div>

        </header>

        {{-- CONTENT --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>