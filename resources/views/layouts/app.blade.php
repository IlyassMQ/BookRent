<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookRent')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    @yield('styles') {{-- optional --}}
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- NAVBAR (optional but recommended) --}}
    <nav class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between">

            <a href="{{ route('home') }}" class="font-bold text-lg">BookRent</a>

        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <div class="max-w-5xl mx-auto px-4">
        @yield('content')
    </div>

    {{-- SCRIPTS (VERY IMPORTANT FOR MAP) --}}
    @yield('scripts')

</body>
</html>