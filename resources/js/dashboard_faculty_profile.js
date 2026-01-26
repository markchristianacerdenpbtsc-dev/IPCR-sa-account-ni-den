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

// Toggle password visibility
window.togglePasswordVisibility = function(fieldId) {
    const input = document.getElementById(fieldId);
    const eyeOpen = document.getElementById(fieldId + '_eye_open');
    const eyeClosed = document.getElementById(fieldId + '_eye_closed');
    
    if (input.type === 'password') {
        input.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
    } else {
        input.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
    }
};

// Change Password Modal Functions
window.openChangePasswordModal = function() {
    document.getElementById('changePasswordModal').classList.remove('hidden');
    // Reset form
    document.getElementById('changePasswordForm').reset();
    // Reset all password fields to hidden state
    ['current_password', 'new_password', 'new_password_confirmation'].forEach(fieldId => {
        const input = document.getElementById(fieldId);
        const eyeOpen = document.getElementById(fieldId + '_eye_open');
        const eyeClosed = document.getElementById(fieldId + '_eye_closed');
        input.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
    });
    // Clear any previous messages
    document.getElementById('passwordMessage').classList.add('hidden');
    // Clear error messages
    ['current_password_error', 'new_password_error', 'new_password_confirmation_error'].forEach(id => {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).textContent = '';
    });
};

window.closeChangePasswordModal = function() {
    document.getElementById('changePasswordModal').classList.add('hidden');
};

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('changePasswordModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                window.closeChangePasswordModal();
            }
        });
    }

    // Handle form submission
    const form = document.getElementById('changePasswordForm');
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const messageDiv = document.getElementById('passwordMessage');
            
            // Clear previous errors
            ['current_password_error', 'new_password_error', 'new_password_confirmation_error'].forEach(id => {
                document.getElementById(id).classList.add('hidden');
                document.getElementById(id).textContent = '';
            });
            
            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    // Success
                    messageDiv.className = 'rounded-lg p-3 text-sm bg-green-50 text-green-800 border border-green-200';
                    messageDiv.textContent = data.message || 'Password updated successfully!';
                    messageDiv.classList.remove('hidden');
                    
                    // Reset form and close after 2 seconds
                    setTimeout(() => {
                        window.closeChangePasswordModal();
                        this.reset();
                    }, 2000);
                } else {
                    // Error
                    if (data.errors) {
                        // Display validation errors
                        Object.keys(data.errors).forEach(key => {
                            const errorElement = document.getElementById(key + '_error');
                            if (errorElement) {
                                errorElement.textContent = data.errors[key][0];
                                errorElement.classList.remove('hidden');
                            }
                        });
                    } else {
                        messageDiv.className = 'rounded-lg p-3 text-sm bg-red-50 text-red-800 border border-red-200';
                        messageDiv.textContent = data.message || 'An error occurred. Please try again.';
                        messageDiv.classList.remove('hidden');
                    }
                }
            } catch (error) {
                messageDiv.className = 'rounded-lg p-3 text-sm bg-red-50 text-red-800 border border-red-200';
                messageDiv.textContent = 'An error occurred. Please try again.';
                messageDiv.classList.remove('hidden');
            }
        });
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        window.closeChangePasswordModal();
    }
});
