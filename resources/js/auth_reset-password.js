// Toggle confirm password visibility
window.toggleConfirmPasswordVisibility = function() {
    const passwordInput = document.getElementById('password_confirmation');
    if (!passwordInput) return;
    
    const toggleBtn = passwordInput.nextElementSibling;
    const icon = toggleBtn.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
};
