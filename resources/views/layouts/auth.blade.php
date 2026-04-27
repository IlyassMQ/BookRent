<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auth')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-50 to-amber-100">

    <div class="w-full max-w-md px-4">

        {{-- BRAND --}}
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-3xl font-bold text-amber-800">
                
                <span class="w-10 h-10 bg-amber-700 text-white flex items-center justify-center rounded-lg text-lg shadow">
                    📚
                </span>

                BookRent
            </a>

            <p class="text-sm text-stone-500 mt-2">
                Your digital library experience
            </p>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-2xl shadow-xl border border-amber-100 p-6">

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="flex items-start gap-2 bg-green-50 text-green-700 px-3 py-2 rounded-lg mb-4 text-sm">
                    <span>✔</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- ERRORS --}}
            @if($errors->any())
                <div class="bg-red-50 text-red-600 px-3 py-2 rounded-lg mb-4 text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- CONTENT --}}
            <div class="space-y-4">
                @yield('content')
            </div>

        </div>

        {{-- FOOTER --}}
        <div class="text-center mt-6 text-sm text-stone-500">
            @yield('footer')
        </div>

    </div>

</body>
</html>