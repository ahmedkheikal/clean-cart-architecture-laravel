<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Material Tailwind  not found, fix it--> 
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/react@latest/styles/material-tailwind.css">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <header class="sticky top-0 z-50">
        <nav class="bg-white border-b border-gray-200 px-4 lg:px-6 py-2.5">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="{{ url('/') }}" class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <!-- Navigation Links - Desktop -->
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="{{ route('home') }}" class="block py-2 pr-4 pl-3 text-gray-700 hover:text-primary-700 lg:p-0">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products') }}" class="block py-2 pr-4 pl-3 text-gray-700 hover:text-primary-700 lg:p-0">
                                Products
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Right Side Navigation -->
                <div class="flex items-center lg:order-2">
                    <!-- Shopping Cart -->
                    <button type="button" class="relative p-2 text-gray-700 hover:text-primary-700 focus:outline-none">
                        <span class="sr-only">Cart</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-primary-700 rounded-full">0</span>
                    </button>

                    @auth
                        <!-- User Dropdown -->
                        <button type="button" class="flex items-center p-2 ml-4 text-gray-700 hover:text-primary-700 focus:outline-none">
                            <span class="sr-only">User menu</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </button>
                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="p-2 ml-2 text-gray-700 hover:text-primary-700 focus:outline-none">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-700 focus:outline-none px-4 py-2 font-medium">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-white bg-primary-700 hover:bg-primary-800 focus:outline-none font-medium rounded-lg text-sm px-4 py-2 text-center ml-2">
                                Register
                            </a>
                        @endif
                    @endauth

                    <!-- Mobile menu button -->
                    <button type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div class="hidden lg:hidden" id="mobile-menu">
                <ul class="flex flex-col mt-4 font-medium">
                    <li>
                        <a href="{{ route('home') }}" class="block py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('products') }}" class="block py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50">Products</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Page Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200">
        <div class="max-w-screen-xl mx-auto px-4 py-8 lg:px-6">
            <div class="text-center">
                <span class="text-sm text-gray-500">© {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.</span>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('[aria-controls="mobile-menu"]');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html> 