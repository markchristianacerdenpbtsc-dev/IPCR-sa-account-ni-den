# Dashboard Layout Structure

## Overview
A reusable dashboard layout has been created that serves as the default template for Dean, Director, and Faculty dashboards.

## File Location
- **Master Layout**: `resources/views/layouts/dashboard.blade.php`

## Structure
The layout includes:
- **Navigation Header**: Top navigation bar with logo, dashboard title, navigation links, and logout
- **Mobile Menu**: Responsive hamburger menu for mobile devices
- **Profile Section**: User profile photo and logout button
- **Main Content Area**: Max-width container for dashboard content

## Extending the Layout

Each dashboard (faculty, dean, director) extends the master layout like this:

```blade
@extends('layouts.dashboard')

@section('title', 'Dashboard Name')
@section('dashboard_title', 'Display Title')

@section('nav_links')
    <!-- Add custom navigation links here -->
@endsection

@section('mobile_nav_links')
    <!-- Add mobile navigation links here -->
@endsection

@section('content')
    <!-- Add dashboard-specific content here -->
@endsection
```

## Customization Points

### 1. Navigation Links
- `nav_links`: Desktop navigation links
- `mobile_nav_links`: Mobile menu navigation links
- `dashboard_title`: Title displayed in the header

### 2. Content
- `content`: Main dashboard content that goes inside the layout

### 3. Additional Resources
- `@push('styles')`: Add custom CSS files
- `@push('scripts')`: Add custom JavaScript files

## Usage Example

```blade
@extends('layouts.dashboard')

@section('title', 'Faculty Dashboard')
@section('dashboard_title', 'IPCR Dashboard')

@section('nav_links')
    <a href="{{ route('faculty.dashboard') }}" class="text-blue-600 font-semibold hover:text-blue-700">Dashboard</a>
    <a href="{{ route('faculty.my-ipcrs') }}" class="text-gray-600 hover:text-gray-900">My IPCRs</a>
@endsection

@section('mobile_nav_links')
    <a href="{{ route('faculty.dashboard') }}" class="block text-blue-600 font-semibold hover:text-blue-700 py-2">Dashboard</a>
    <a href="{{ route('faculty.my-ipcrs') }}" class="block text-gray-600 hover:text-gray-900 py-2">My IPCRs</a>
@endsection

@section('content')
    <!-- Your dashboard content here -->
@endsection
```

## Currently Using the Layout

1. **Faculty Dashboard** - `resources/views/dashboard/faculty/index.blade.php`
2. **Dean Dashboard** - `resources/views/dashboard/dean/index.blade.php`
3. **Director Dashboard** - `resources/views/dashboard/director/Index.blade.php`

## Features

- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Sticky navigation header
- ✅ Logo and branding
- ✅ User profile photo support
- ✅ Mobile-friendly hamburger menu
- ✅ Consistent styling with Tailwind CSS
- ✅ Support for Chart.js and Font Awesome icons
- ✅ Easy customization per role

## CSS Classes Used

The layout uses several custom CSS classes defined in `dashboard_faculty_index.css`:
- `.metric-card`: Card component for metrics
- `.notification-item`: Notification styling
- `.profile-img`: Profile image styling
- `.hamburger`: Mobile menu icon
- And more...

Ensure these CSS files are imported in your Vite configuration.
