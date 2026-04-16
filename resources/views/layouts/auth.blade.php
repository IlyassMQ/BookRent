{{-- resources/views/layouts/auth.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auth')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">

        {{-- LOGO / TITLE --}}
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-indigo-600">
                BookRent
            </h1>
        </div>

        {{-- CARD --}}
        <div class="bg-white shadow-md rounded-lg p-6">

            {{-- FLASH MESSAGE --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERRORS --}}
            @if($errors->any())
                <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
                    @foreach($errors->all() as $error)
                        <div>- {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- CONTENT --}}
            @yield('content')

        </div>

        {{-- FOOTER LINKS --}}
        <div class="text-center mt-4 text-sm text-gray-500">
            @yield('footer')
        </div>

    </div>

</body>
</html>