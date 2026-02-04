// Toggle sidebar visibility
window.toggleSidebar = function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (!sidebar || !overlay) return;
    
    // Toggle classes for mobile sidebar
    sidebar.classList.toggle('sidebar-hidden');
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
    overlay.classList.toggle('opacity-0');
    overlay.classList.toggle('pointer-events-none');
};

// Close sidebar when clicking overlay
document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('sidebarOverlay');
    if (overlay) {
        overlay.addEventListener('click', toggleSidebar);
    }
});

// Close sidebar when clicking a link
document.querySelectorAll('#sidebar a, #sidebar button').forEach(element => {
    element.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar) {
                sidebar.classList.add('sidebar-hidden');
                sidebar.classList.add('-translate-x-full');
            }
            if (overlay) {
                overlay.classList.add('hidden');
                overlay.classList.add('opacity-0');
                overlay.classList.add('pointer-events-none');
            }
        }
    });
});

// Handle window resize
window.addEventListener('resize', () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (!sidebar || !overlay) return;
    
    if (window.innerWidth >= 1024) {
        // Desktop size - show sidebar
        sidebar.classList.remove('sidebar-hidden');
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.add('hidden');
        overlay.classList.add('opacity-0');
        overlay.classList.add('pointer-events-none');
    } else {
        // Mobile size - hide sidebar
        sidebar.classList.add('sidebar-hidden');
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        overlay.classList.add('opacity-0');
        overlay.classList.add('pointer-events-none');
    }
});

// Initialize on page load
window.addEventListener('load', () => {
    const sidebar = document.getElementById('sidebar');
    
    if (sidebar && window.innerWidth < 1024) {
        sidebar.classList.add('sidebar-hidden');
        sidebar.classList.add('-translate-x-full');
    }
});
