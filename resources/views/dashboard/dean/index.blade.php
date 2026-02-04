@extends('layouts.dashboard')

@section('title', 'Dean Dashboard')
@section('dashboard_title', 'Dean Dashboard')

@section('nav_links')
    <a href="{{ route('dean.dashboard') }}" class="text-blue-600 font-semibold hover:text-blue-700">Dashboard</a>
    <a href="#" class="text-gray-600 hover:text-gray-900">Faculty Reviews</a>
    <a href="#" class="text-gray-600 hover:text-gray-900">Reports</a>
@endsection

@section('mobile_nav_links')
    <a href="{{ route('dean.dashboard') }}" class="block text-blue-600 font-semibold hover:text-blue-700 py-2">Dashboard</a>
    <a href="#" class="block text-gray-600 hover:text-gray-900 py-2">Faculty Reviews</a>
    <a href="#" class="block text-gray-600 hover:text-gray-900 py-2">Reports</a>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
        <!-- Left Main Content (2/3 width) -->
        <div class="lg:col-span-2 space-y-4 sm:space-y-6">
            <!-- Welcome Section -->
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Welcome, {{ explode(' ', auth()->user()->name)[0] }}!</h2>
                <p class="text-sm sm:text-base text-gray-500 mt-1">Here's a summary of faculty performance in your department</p>
            </div>

            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                <!-- Faculty Count Card -->
                <div class="metric-card">
                    <div class="sm:block">
                        <p class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-3">Faculty Members</p>
                        <div class="flex items-end justify-between gap-2">
                            <span class="text-2xl sm:text-4xl font-bold text-gray-900">24</span>
                        </div>
                    </div>
                </div>

                <!-- Submitted IPCRs Card -->
                <div class="metric-card">
                    <div class="sm:block">
                        <p class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-3">Submitted IPCRs</p>
                        <div class="flex items-end justify-between gap-2">
                            <span class="text-2xl sm:text-4xl font-bold text-gray-900">18</span>
                        </div>
                    </div>
                </div>

                <!-- Pending Review Card -->
                <div class="metric-card">
                    <div class="sm:block">
                        <p class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-3">Pending Review</p>
                        <div class="flex items-end justify-between gap-2">
                            <span class="text-2xl sm:text-4xl font-bold text-orange-600">6</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Faculty Performance Section -->
            <div class="metric-card">
                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Faculty Performance Overview</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-xs sm:text-sm">
                        <thead>
                            <tr class="text-left text-gray-600 border-b">
                                <th class="py-2 pr-2 sm:pr-4">Faculty Name</th>
                                <th class="py-2 pr-2 sm:pr-4">Status</th>
                                <th class="py-2 pr-2 sm:pr-4">Rating</th>
                                <th class="py-2 pr-2 sm:pr-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b last:border-b-0 hover:bg-gray-50">
                                <td class="py-2 pr-2 sm:pr-4 text-gray-900 font-medium">Dr. Maria Santos</td>
                                <td class="py-2 pr-2 sm:pr-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">Submitted</span>
                                </td>
                                <td class="py-2 pr-2 sm:pr-4 text-gray-700">4.5/5.0</td>
                                <td class="py-2 pr-2 sm:pr-4"><a href="#" class="text-blue-600 hover:text-blue-700 text-xs sm:text-sm">Review</a></td>
                            </tr>
                            <tr class="border-b last:border-b-0 hover:bg-gray-50">
                                <td class="py-2 pr-2 sm:pr-4 text-gray-900 font-medium">Prof. John Cruz</td>
                                <td class="py-2 pr-2 sm:pr-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700">Pending</span>
                                </td>
                                <td class="py-2 pr-2 sm:pr-4 text-gray-700">-</td>
                                <td class="py-2 pr-2 sm:pr-4"><a href="#" class="text-gray-400 text-xs sm:text-sm cursor-not-allowed">N/A</a></td>
                            </tr>
                            <tr class="border-b last:border-b-0 hover:bg-gray-50">
                                <td class="py-2 pr-2 sm:pr-4 text-gray-900 font-medium">Ms. Ana De Guzman</td>
                                <td class="py-2 pr-2 sm:pr-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">Submitted</span>
                                </td>
                                <td class="py-2 pr-2 sm:pr-4 text-gray-700">4.2/5.0</td>
                                <td class="py-2 pr-2 sm:pr-4"><a href="#" class="text-blue-600 hover:text-blue-700 text-xs sm:text-sm">Review</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Sidebar (1/3 width) -->
        <div class="space-y-4 sm:space-y-6">
            <!-- Deadline Reminder -->
            <div class="metric-card">
                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Important Dates</h3>
                <div class="space-y-3 sm:space-y-4">
                    <!-- Deadline Item 1 -->
                    <div class="flex items-start space-x-2 sm:space-x-3">
                        <div class="deadline-badge bg-red-100 text-red-600 flex-shrink-0">
                            <div class="text-xs">FEB</div>
                            <div class="text-base sm:text-lg font-bold">28</div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-semibold text-gray-900">Review Deadline</p>
                            <p class="text-xs text-gray-500">Complete all faculty reviews</p>
                        </div>
                    </div>

                    <!-- Deadline Item 2 -->
                    <div class="flex items-start space-x-2 sm:space-x-3">
                        <div class="deadline-badge bg-orange-100 text-orange-600 flex-shrink-0">
                            <div class="text-xs">MAR</div>
                            <div class="text-base sm:text-lg font-bold">15</div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-semibold text-gray-900">Report Submission</p>
                            <p class="text-xs text-gray-500">Submit consolidated report</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="metric-card">
                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Review Status</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2">
                        <span class="text-xs sm:text-sm text-gray-600">Completed</span>
                        <span class="text-sm sm:text-base font-bold text-green-600">18/24</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="metric-card">
                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-3 sm:mb-4">Recent Activities</h3>
                <div class="space-y-2 sm:space-y-3">
                    <!-- Activity Item 1 -->
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                        <p class="text-xs sm:text-sm font-semibold text-gray-900">IPCR Submitted</p>
                        <p class="text-xs text-gray-600">By Dr. Maria Santos</p>
                    </div>

                    <!-- Activity Item 2 -->
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                        <p class="text-xs sm:text-sm font-semibold text-gray-900">Review Completed</p>
                        <p class="text-xs text-gray-600">Prof. Juan Dela Cruz</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection