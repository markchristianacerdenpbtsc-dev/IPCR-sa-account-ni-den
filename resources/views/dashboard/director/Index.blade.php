@extends('layouts.dashboard')

@section('title', 'Director Dashboard')
@section('dashboard_title', 'Director Dashboard')

@section('nav_links')
    <a href="{{ route('director.dashboard') }}" class="text-blue-600 font-semibold hover:text-blue-700">Dashboard</a>
    <a href="#" class="text-gray-600 hover:text-gray-900">Department Reviews</a>
    <a href="#" class="text-gray-600 hover:text-gray-900">Reports</a>
@endsection

@section('mobile_nav_links')
    <a href="{{ route('director.dashboard') }}" class="block text-blue-600 font-semibold hover:text-blue-700 py-2">Dashboard</a>
    <a href="#" class="block text-gray-600 hover:text-gray-900 py-2">Department Reviews</a>
    <a href="#" class="block text-gray-600 hover:text-gray-900 py-2">Reports</a>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
        <!-- Left Main Content (2/3 width) -->
        <div class="lg:col-span-2 space-y-4 sm:space-y-6">
            <!-- Welcome Section -->
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Welcome, {{ explode(' ', auth()->user()->name)[0] }}!</h2>
                <p class="text-sm sm:text-base text-gray-500 mt-1">Overview of institutional IPCR performance</p>
            </div>

            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                <!-- Departments Card -->
                <div class="metric-card">
                    <div class="sm:block">
                        <p class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-3">Departments</p>
                        <div class="flex items-end justify-between gap-2">
                            <span class="text-2xl sm:text-4xl font-bold text-gray-900">8</span>
                        </div>
                    </div>
                </div>

                <!-- Total IPCRs Card -->
                <div class="metric-card">
                    <div class="sm:block">
                        <p class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-3">Total IPCRs</p>
                        <div class="flex items-end justify-between gap-2">
                            <span class="text-2xl sm:text-4xl font-bold text-gray-900">156</span>
                        </div>
                    </div>
                </div>

                <!-- Completion Rate Card -->
                <div class="metric-card">
                    <div class="sm:block">
                        <p class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-3">Completion Rate</p>
                        <div class="flex items-end justify-between gap-2">
                            <span class="text-2xl sm:text-4xl font-bold text-green-600">82%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Department Performance Section -->
            <div class="metric-card">
                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Department Performance</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-xs sm:text-sm">
                        <thead>
                            <tr class="text-left text-gray-600 border-b">
                                <th class="py-2 pr-2 sm:pr-4">Department</th>
                                <th class="py-2 pr-2 sm:pr-4">Submitted</th>
                                <th class="py-2 pr-2 sm:pr-4">Completion</th>
                                <th class="py-2 pr-2 sm:pr-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b last:border-b-0 hover:bg-gray-50">
                                <td class="py-2 pr-2 sm:pr-4 text-gray-900 font-medium">School of Engineering</td>
                                <td class="py-2 pr-2 sm:pr-4 text-gray-700">28/35</td>
                                <td class="py-2 pr-2 sm:pr-4 text-gray-700">80%</td>
                                <td class="py-2 pr-2 sm:pr-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700">In Progress</span>
                                </td>
                            </tr>
                            <tr class="border-b last:border-b-0 hover:bg-gray-50">
                                <td class="py-2 pr-2 sm:pr-4 text-gray-900 font-medium">College of Education</td>
                                <td class="py-2 pr-2 sm:pr-4 text-gray-700">18/18</td>
                                <td class="py-2 pr-2 sm:pr-4 text-gray-700">100%</td>
                                <td class="py-2 pr-2 sm:pr-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">Complete</span>
                                </td>
                            </tr>
                            <tr class="border-b last:border-b-0 hover:bg-gray-50">
                                <td class="py-2 pr-2 sm:pr-4 text-gray-900 font-medium">School of Business</td>
                                <td class="py-2 pr-2 sm:pr-4 text-gray-700">24/30</td>
                                <td class="py-2 pr-2 sm:pr-4 text-gray-700">80%</td>
                                <td class="py-2 pr-2 sm:pr-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700">In Progress</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Sidebar (1/3 width) -->
        <div class="space-y-4 sm:space-y-6">
            <!-- Timeline -->
            <div class="metric-card">
                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Key Milestones</h3>
                <div class="space-y-3 sm:space-y-4">
                    <!-- Milestone Item 1 -->
                    <div class="flex items-start space-x-2 sm:space-x-3">
                        <div class="deadline-badge bg-green-100 text-green-600 flex-shrink-0">
                            <div class="text-xs">JAN</div>
                            <div class="text-base sm:text-lg font-bold">31</div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-semibold text-gray-900">Submission Begins</p>
                            <p class="text-xs text-gray-500">All departments started</p>
                        </div>
                    </div>

                    <!-- Milestone Item 2 -->
                    <div class="flex items-start space-x-2 sm:space-x-3">
                        <div class="deadline-badge bg-orange-100 text-orange-600 flex-shrink-0">
                            <div class="text-xs">FEB</div>
                            <div class="text-base sm:text-lg font-bold">28</div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-semibold text-gray-900">Mid-Point Check</p>
                            <p class="text-xs text-gray-500">Progress assessment</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Overall Progress -->
            <div class="metric-card">
                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Overall Progress</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs sm:text-sm text-gray-600">IPCR Completion</span>
                            <span class="text-sm sm:text-base font-bold text-gray-900">128/156</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 82%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="metric-card">
                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">System Status</h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs sm:text-sm text-gray-600">System</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">Operational</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs sm:text-sm text-gray-600">Database</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">Healthy</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection