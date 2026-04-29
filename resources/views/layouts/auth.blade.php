<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library System')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Elegant serif for book theme -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        h1, h2, h3, h4, .serif-font {
            font-family: 'Cormorant Garamond', serif;
        }
        
        /* Custom scrollbar - like an old book edge */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #FBF7F0;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #8B6914;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #6B4F12;
        }
        
        /* Book spine animation for hover effects */
        .book-card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .book-card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
        }
        
        /* Ink animation for inputs */
        .ink-input {
            transition: all 0.2s ease;
        }
        
        .ink-input:focus {
            transform: scale(1.01);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#F5E6D3] via-[#E8D5B7] to-[#D4C4A8] relative overflow-x-hidden">
    
    <!-- Decorative book spines - left side -->
    <div class="absolute left-0 top-0 bottom-0 w-24 opacity-20 pointer-events-none hidden lg:block">
        <div class="absolute left-4 top-10 w-6 h-64 bg-[#8B4513] rounded-sm shadow-lg transform rotate-12 origin-top"></div>
        <div class="absolute left-12 top-20 w-6 h-72 bg-[#A0522D] rounded-sm shadow-lg transform -rotate-6 origin-top"></div>
        <div class="absolute left-20 top-5 w-5 h-56 bg-[#6B3A2A] rounded-sm shadow-lg transform rotate-6 origin-top"></div>
        <div class="absolute left-8 top-40 w-5 h-80 bg-[#CD853F] rounded-sm shadow-lg transform -rotate-12 origin-top"></div>
    </div>
    
    <!-- Decorative book spines - right side -->
    <div class="absolute right-0 top-0 bottom-0 w-24 opacity-20 pointer-events-none hidden lg:block">
        <div class="absolute right-4 top-10 w-6 h-64 bg-[#8B4513] rounded-sm shadow-lg transform -rotate-12 origin-top"></div>
        <div class="absolute right-12 top-20 w-6 h-72 bg-[#A0522D] rounded-sm shadow-lg transform rotate-6 origin-top"></div>
        <div class="absolute right-20 top-5 w-5 h-56 bg-[#6B3A2A] rounded-sm shadow-lg transform -rotate-6 origin-top"></div>
        <div class="absolute right-8 top-40 w-5 h-80 bg-[#CD853F] rounded-sm shadow-lg transform rotate-12 origin-top"></div>
    </div>
    
    <!-- Floating particles like dust from old books -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute w-1 h-1 bg-amber-700/20 rounded-full top-20 left-[10%] animate-pulse"></div>
        <div class="absolute w-2 h-2 bg-amber-600/20 rounded-full top-40 right-[15%] animate-pulse delay-1000"></div>
        <div class="absolute w-1 h-1 bg-amber-800/20 rounded-full bottom-20 left-[20%] animate-pulse delay-700"></div>
        <div class="absolute w-1.5 h-1.5 bg-amber-700/20 rounded-full top-60 right-[25%] animate-pulse delay-300"></div>
    </div>

    <div class="w-full max-w-md px-4 relative z-10">
        {{-- BRAND --}}
        <div class="text-center mb-8 animate-fade-in">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-4xl font-bold serif-font group">
                <div class="relative">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#8B4513] to-[#5C2E0B] text-white flex items-center justify-center rounded-lg shadow-lg transform transition-transform group-hover:scale-105">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-amber-400 rounded-full animate-ping opacity-75"></div>
                </div>
                <span class="bg-gradient-to-r from-[#5C2E0B] to-[#8B4513] bg-clip-text text-transparent">
                    BookRent
                </span>
            </a>
            <p class="text-sm text-[#6B4F12] mt-3 italic serif-font">
                "Where stories come alive"
            </p>
        </div>

        {{-- CARD --}}
        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-amber-200/50 p-8 transition-all duration-300 hover:shadow-3xl">
            {{-- Decorative line like book binding --}}
            <div class="w-16 h-0.5 bg-gradient-to-r from-[#D4A574] via-[#8B4513] to-[#D4A574] mx-auto mb-6 rounded-full"></div>

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="flex items-start gap-3 bg-emerald-50 border-l-4 border-emerald-600 text-emerald-800 px-4 py-3 rounded-lg mb-6 text-sm shadow-sm animate-slide-down">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- ERRORS --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-600 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm shadow-sm">
                    <div class="flex items-start gap-2 mb-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">Please fix the following errors:</span>
                    </div>
                    <ul class="space-y-1 ml-7">
                        @foreach($errors->all() as $error)
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- CONTENT --}}
            <div class="space-y-5">
                @yield('content')
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="text-center mt-8">
            @yield('footer')
            <div class="text-xs text-[#6B4F12]/60 mt-2 serif-font">
                © {{ date('Y') }} BookRent — Every page tells a story
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
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
        
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
        
        .animate-slide-down {
            animation: slide-down 0.4s ease-out;
        }
        
        .delay-1000 {
            animation-delay: 1000ms;
        }
        
        .delay-700 {
            animation-delay: 700ms;
        }
        
        .delay-300 {
            animation-delay: 300ms;
        }
        
        .shadow-3xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</body>
</html>