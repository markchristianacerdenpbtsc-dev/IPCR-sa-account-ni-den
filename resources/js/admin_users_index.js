let pendingDeleteForm = null;

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
        sidebar.classList.remove('sidebar-hidden');
        overlay.classList.add('hidden');
    } else {
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

// Search and Filter Functionality
const searchInput = document.getElementById('searchInput');
const departmentFilter = document.getElementById('departmentFilter');
const userRows = document.querySelectorAll('.user-row');

function filterUsers() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedDept = departmentFilter.value;

    userRows.forEach(row => {
        const name = row.dataset.name;
        const email = row.dataset.email;
        const username = row.dataset.username;
        const department = row.dataset.department;

        const matchesSearch = name.includes(searchTerm) || 
                            email.includes(searchTerm) || 
                            username.includes(searchTerm);
        const matchesDept = !selectedDept || department === selectedDept;

        if (matchesSearch && matchesDept) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

searchInput.addEventListener('input', filterUsers);
departmentFilter.addEventListener('change', filterUsers);

// Confirmation modal functions
window.openConfirmationModal = function(userName, form) {
    document.getElementById('deleteUserName').textContent = userName;
    pendingDeleteForm = form;
    document.getElementById('confirmationModal').classList.remove('hidden');
};

window.closeConfirmationModal = function() {
    document.getElementById('confirmationModal').classList.add('hidden');
    pendingDeleteForm = null;
};

window.confirmDelete = function() {
    if (pendingDeleteForm) {
        pendingDeleteForm.submit();
    }
    window.closeConfirmationModal();
};

document.getElementById('confirmationModal').addEventListener('click', function(e) {
    if (e.target === this) {
        window.closeConfirmationModal();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        window.closeConfirmationModal();
    }
});
