<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookRent')</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 min-h-screen">

    
    <nav class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between">

            <a href="{{ route('home') }}" class="font-bold text-lg">BookRent</a>

            <a href="{{ route('transactions.index') }}" class="text-blue-500">
            My Orders
            </a>

            @if (auth()->check() && auth()->user()->library)
                <a href="{{ route('library.transactions') }}" class="text-green-500">
                    Library Orders
                </a>
            
            @endif

        </div>

        
    </nav>

    
    <div class="max-w-7xl mx-auto px-4">
        @yield('content')
    </div>

    
    @yield('scripts')

</body>
</html>