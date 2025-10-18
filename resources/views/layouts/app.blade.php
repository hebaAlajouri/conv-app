<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Expense Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 50%;
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .min-h-screen-minus-nav {
            min-height: calc(100vh - 73px - 64px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 font-sans antialiased">
    <div id="app" class="min-h-screen flex flex-col">
        <!-- Enhanced Navbar -->
        <nav class="bg-white/80 backdrop-blur-xl shadow-lg border-b border-gray-200">
            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <!-- Logo/Brand -->
                    <a href="/" class="flex items-center gap-3 group">
                        <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-2 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            Expense Tracker
                        </span>
                    </a>

                    <!-- Navigation Links -->
                    <div class="flex items-center gap-2">
                        @auth
                            <a href="/dashboard" class="nav-link text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg font-semibold transition duration-200">
                                Dashboard
                            </a>
                            <a href="/expenses" class="nav-link text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg font-semibold transition duration-200">
                                Expenses
                            </a>
                            <a href="/summary" class="nav-link text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg font-semibold transition duration-200">
                                Summary
                            </a>
                            <div class="h-6 w-px bg-gray-300 mx-2"></div>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-5 py-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="/login" class="text-gray-700 hover:text-blue-600 px-5 py-2 rounded-xl font-semibold transition duration-200">
                                Login
                            </a>
                            <a href="/register" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-5 py-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <main class="flex-grow container mx-auto px-4 py-8">
            <!-- Enhanced Flash messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 px-5 py-4 rounded-xl shadow-sm flex items-start gap-3 animate-fade-in">
                    <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 px-5 py-4 rounded-xl shadow-sm flex items-start gap-3 animate-fade-in">
                    <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Enhanced Footer -->
        <footer class="bg-gradient-to-r from-gray-800 via-gray-900 to-gray-800 text-white py-6">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold">&copy; {{ date('Y') }} Expense Tracker</span>
                    </div>
                    <div class="text-gray-400 text-sm">
                        All rights reserved. Track your expenses smartly.
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>