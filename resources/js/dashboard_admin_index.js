// Toggle sidebar visibility
window.toggleSidebar = function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    sidebar.classList.toggle('sidebar-hidden');
    overlay.classList.toggle('hidden');
};

// Close sidebar when clicking a link
document.querySelectorAll('#sidebar a, #sidebar button').forEach(element => {
    element.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
            document.getElementById('sidebar').classList.add('sidebar-hidden');
            document.getElementById('sidebarOverlay').classList.add('hidden');
        }
    });
});

// Handle window resize
window.addEventListener('resize', () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (window.innerWidth >= 1024) {
        // Desktop size - show sidebar
        sidebar.classList.remove('sidebar-hidden');
        overlay.classList.add('hidden');
    } else {
        // Mobile size - hide sidebar
        sidebar.classList.add('sidebar-hidden');
        overlay.classList.add('hidden');
    }
});

// Initialize on page load
window.addEventListener('load', () => {
    const sidebar = document.getElementById('sidebar');
    
    if (window.innerWidth < 1024) {
        sidebar.classList.add('sidebar-hidden');
    }
});
