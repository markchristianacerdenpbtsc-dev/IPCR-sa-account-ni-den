<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - IPCR/OPCR Module</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite([
        'resources/css/dashboard_faculty_index.css',
        'resources/js/dashboard_faculty_index.js'
    ])
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navigation Header -->
    <nav class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 sm:py-4">
            <div class="flex justify-between items-center">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <img src="{{ asset('images/urs_logo.jpg') }}" alt="URS Logo" class="h-10 sm:h-12 w-auto object-contain flex-shrink-0">
                    <h1 class="text-base sm:text-xl font-bold text-gray-900">@yield('dashboard_title', 'Dashboard')</h1>
                </div>
                
                <!-- Desktop Navigation Links -->
                <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
                    @yield('nav_links')
                    
                    <!-- Profile Picture -->
                    <div class="flex items-center space-x-3">
                        @if(auth()->user()->hasProfilePhoto())
                            <img src="{{ auth()->user()->profile_photo_url }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3b82f6&color=fff" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                        @endif
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">Logout</button>
                    </form>
                </div>

                <!-- Mobile Menu Button & Profile -->
                <div class="flex lg:hidden items-center space-x-3">
                    <div class="flex items-center">
                        @if(auth()->user()->hasProfilePhoto())
                            <img src="{{ auth()->user()->profile_photo_url }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3b82f6&color=fff" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                        @endif
                    </div>
                    <div class="hamburger" onclick="toggleMobileMenu()">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Overlay -->
            <div class="mobile-menu-overlay lg:hidden" onclick="toggleMobileMenu()"></div>

            <!-- Mobile Menu -->
            <div class="mobile-menu lg:hidden flex-col space-y-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-gray-900">Menu</h2>
                    <button onclick="toggleMobileMenu()" class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                @yield('mobile_nav_links')
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-700 font-semibold py-2">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 sm:py-8">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
