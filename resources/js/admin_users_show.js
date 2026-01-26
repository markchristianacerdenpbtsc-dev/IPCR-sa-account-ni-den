window.toggleSidebar = function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    sidebar.classList.toggle('open');
    overlay.classList.toggle('visible');
};

// Close sidebar when clicking overlay
document.getElementById('sidebarOverlay').addEventListener('click', window.toggleSidebar);

// Close sidebar on navigation
document.querySelectorAll('#sidebar a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
            window.toggleSidebar();
        }
    });
});

// Close sidebar when resizing to desktop
window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('visible');
    }
});
