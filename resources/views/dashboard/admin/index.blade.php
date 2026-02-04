<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - IPCR/OPCR Module</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/dashboard_admin_index.css', 'resources/js/dashboard_admin_index.js'])
</head>
<body class="bg-gray-50">
    <!-- Navigation Header -->
    <nav class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 sm:py-4">
            <div class="flex justify-between items-center">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <img src="{{ asset('images/urs_logo.jpg') }}" alt="URS Logo" class="h-10 sm:h-12 w-auto object-contain flex-shrink-0">
                    <h1 class="text-base sm:text-xl font-bold text-gray-900">Admin Dashboard</h1>
                </div>
                
                <!-- Desktop Navigation Links -->
                <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 font-semibold hover:text-blue-700">Dashboard</a>
                    <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900">User Management</a>
                    
                    <!-- Profile Picture -->
                    <div class="flex items-center space-x-3">
                        @if(auth()->user()->hasProfilePhoto())
                            <img src="{{ auth()->user()->profile_photo_url }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="profile-img">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3b82f6&color=fff" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="profile-img">
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
                                 class="profile-img">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3b82f6&color=fff" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="profile-img">
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
                <a href="{{ route('admin.dashboard') }}" class="block text-blue-600 font-semibold hover:text-blue-700 py-2">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="block text-gray-600 hover:text-gray-900 py-2">User Management</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-700 font-semibold py-2">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 sm:py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
            <!-- Left Main Content (2/3 width) -->
            <div class="lg:col-span-2 space-y-4 sm:space-y-6">
                <!-- Welcome Section -->
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Welcome, {{ explode(' ', auth()->user()->name)[0] }}!</h2>
                    <p class="text-sm sm:text-base text-gray-500 mt-1">Here's a summary of your system management</p>
                </div>

                <!-- Quick Stats Cards -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                    <!-- Total Users Card -->
                    <div class="metric-card">
                        <div class="sm:block">
                            <p class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-3">Total Users</p>
                            <div class="flex items-end justify-between gap-2">
                                <span class="text-2xl sm:text-4xl font-bold text-gray-900">{{ \App\Models\User::count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Active Users Card -->
                    <div class="metric-card">
                        <div class="sm:block">
                            <p class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-3">Active Users</p>
                            <div class="flex items-end justify-between gap-2">
                                <span class="text-2xl sm:text-4xl font-bold text-gray-900">{{ \App\Models\User::where('is_active', true)->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Departments Card -->
                    <div class="metric-card">
                        <div class="sm:block">
                            <p class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-3">Departments</p>
                            <div class="flex items-end justify-between gap-2">
                                <span class="text-2xl sm:text-4xl font-bold text-gray-900">{{ \App\Models\Department::count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Management Sections -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <!-- User Management Card -->
                    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                        <div class="bg-blue-500 h-40 sm:h-48 flex flex-col items-center justify-center flex-shrink-0">
                            <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-blue-400 flex items-center justify-center">
                                <i class="fas fa-users text-white text-4xl sm:text-5xl"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">User Management</h3>
                            <p class="text-gray-600 text-sm mb-4">Create, edit, view, and manage all user accounts in the system</p>
                            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition text-sm">
                                <i class="fas fa-arrow-right"></i> Manage Users
                            </a>
                        </div>
                    </div>

                    <!-- System Overview Card -->
                    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                        <div class="bg-purple-500 h-40 sm:h-48 flex flex-col items-center justify-center flex-shrink-0">
                            <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-purple-400 flex items-center justify-center">
                                <i class="fas fa-chart-bar text-white text-4xl sm:text-5xl"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">System Overview</h3>
                            <p class="text-gray-600 text-sm mb-4">View system statistics and IPCR submissions overview</p>
                            <button class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-semibold transition text-sm">
                                <i class="fas fa-arrow-right"></i> View Stats
                            </button>
                        </div>
                    </div>
                </div>

                <!-- IPCR Submissions Section -->
                <div class="metric-card">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                        <h3 class="text-base sm:text-lg font-bold text-gray-900">IPCR Submissions</h3>
                        <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                            <label for="departmentFilter" class="text-xs sm:text-sm text-gray-600">Filter</label>
                            <select id="departmentFilter" name="department_id" class="border border-gray-300 rounded-lg px-2 sm:px-3 py-2 text-xs sm:text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" onchange="this.form.submit()">
                                <option value="">All Departments</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ (string) $selectedDepartmentId === (string) $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-xs sm:text-sm">
                            <thead>
                                <tr class="text-left text-gray-600 border-b">
                                    <th class="py-2 pr-2 sm:pr-4">Name</th>
                                    <th class="py-2 pr-2 sm:pr-4">Department</th>
                                    <th class="py-2 pr-2 sm:pr-4">School Year</th>
                                    <th class="py-2 pr-2 sm:pr-4">Semester</th>
                                    <th class="py-2 pr-2 sm:pr-4">Submitted</th>
                                    <th class="py-2 pr-2 sm:pr-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($submissions as $submission)
                                    <tr class="border-b last:border-b-0 hover:bg-gray-50">
                                        <td class="py-2 pr-2 sm:pr-4 text-gray-900 font-medium">{{ $submission->user->name ?? 'N/A' }}</td>
                                        <td class="py-2 pr-2 sm:pr-4 text-gray-700">{{ $submission->user->department->name ?? 'N/A' }}</td>
                                        <td class="py-2 pr-2 sm:pr-4 text-gray-700">{{ $submission->school_year }}</td>
                                        <td class="py-2 pr-2 sm:pr-4 text-gray-700">{{ $submission->semester }}</td>
                                        <td class="py-2 pr-2 sm:pr-4 text-gray-700">{{ $submission->submitted_at ? $submission->submitted_at->format('M d, Y') : 'N/A' }}</td>
                                        <td class="py-2 pr-2 sm:pr-4">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">
                                                {{ ucfirst($submission->status ?? 'submitted') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-6 text-center text-gray-500 text-sm">No IPCR submissions found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar (1/3 width) -->
            <div class="space-y-4 sm:space-y-6">
                <!-- System Status Card -->
                <div class="metric-card">
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">System Status</h3>
                    <div class="space-y-3 sm:space-y-4">
                        <!-- Status Item 1 -->
                        <div class="flex items-start space-x-2 sm:space-x-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full mt-1.5 flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-semibold text-gray-900">System Health</p>
                                <p class="text-xs text-gray-600">All systems operational</p>
                            </div>
                        </div>

                        <!-- Status Item 2 -->
                        <div class="flex items-start space-x-2 sm:space-x-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full mt-1.5 flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-semibold text-gray-900">Database</p>
                                <p class="text-xs text-gray-600">Connected and synced</p>
                            </div>
                        </div>

                        <!-- Status Item 3 -->
                        <div class="flex items-start space-x-2 sm:space-x-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full mt-1.5 flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-semibold text-gray-900">API Services</p>
                                <p class="text-xs text-gray-600">All endpoints active</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="metric-card">
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Recent Activities</h3>
                    <div class="space-y-2 sm:space-y-3">
                        <!-- Activity Item 1 -->
                        <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                            <p class="text-xs sm:text-sm font-semibold text-gray-900">User Created</p>
                            <p class="text-xs text-gray-600">New user account added to the system</p>
                        </div>

                        <!-- Activity Item 2 -->
                        <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                            <p class="text-xs sm:text-sm font-semibold text-gray-900">IPCR Submitted</p>
                            <p class="text-xs text-gray-600">Faculty member submitted IPCR for review</p>
                        </div>

                        <!-- Activity Item 3 -->
                        <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                            <p class="text-xs sm:text-sm font-semibold text-gray-900">Report Generated</p>
                            <p class="text-xs text-gray-600">Department performance report ready</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="metric-card">
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Quick Actions</h3>
                    <div class="space-y-2">
                        <a href="{{ route('admin.users.index') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-xs sm:text-sm font-semibold transition">Add New User</a>
                        <button class="block w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-900 px-3 py-2 rounded-lg text-xs sm:text-sm font-semibold transition">View Reports</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>