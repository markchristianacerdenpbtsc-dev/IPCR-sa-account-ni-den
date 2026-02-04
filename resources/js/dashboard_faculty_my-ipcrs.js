// Mobile menu toggle
window.toggleMobileMenu = function() {
    const menu = document.querySelector('.mobile-menu');
    const overlay = document.querySelector('.mobile-menu-overlay');
    menu.classList.toggle('active');
    overlay.classList.toggle('active');
};

// Notification popup toggle for desktop
window.toggleNotificationPopup = function() {
    const popup = document.getElementById('notificationPopup');
    popup.classList.toggle('active');
};

// Notification popup toggle for mobile
window.toggleNotificationPopupMobile = function() {
    const popup = document.getElementById('notificationPopupMobile');
    popup.classList.toggle('active');
};

// Close notification popups when clicking outside
document.addEventListener('click', function(e) {
    const popup = document.getElementById('notificationPopup');
    const popupMobile = document.getElementById('notificationPopupMobile');
    const notificationBtn = e.target.closest('button[onclick*="toggleNotificationPopup"]');
    
    if (!notificationBtn) {
        if (popup && !popup.contains(e.target)) {
            popup.classList.remove('active');
        }
        if (popupMobile && !popupMobile.contains(e.target)) {
            popupMobile.classList.remove('active');
        }
    }
});

// Create IPCR modal controls
window.openCreateIpcrModal = function() {
    const modal = document.getElementById('createIpcrModal');
    if (modal) {
        modal.classList.remove('hidden');
    }
};

window.closeCreateIpcrModal = function() {
    const modal = document.getElementById('createIpcrModal');
    if (modal) {
        modal.classList.add('hidden');
    }
};
