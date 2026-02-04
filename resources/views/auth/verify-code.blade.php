<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code - University of Rizal System Binangonan</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/urs_logo.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/auth_login.css', 'resources/css/auth_verify-code.css', 'resources/js/auth_verify-code.js'])
</head>
<body class="gradient-bg">
    <div class="login-container">
        <div class="title">
            <h1>University of Rizal System Binangonan</h1>
            <p>Performance Commitment and Review Module</p>
        </div>

        <div class="login-box">
            <div class="login-header">
                <h2>Verify Your Email</h2>
            </div>

            <div class="login-body">
                @if (session('success'))
                    <div class="success-message" style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="error-message">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <p class="code-description">
                    We've sent a 6-digit verification code to<br>
                    <span class="email-highlight">{{ $email ?? 'your email' }}</span>
                </p>

                <form method="POST" action="{{ route('password.verify') }}" id="verifyForm">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                    <input type="hidden" name="code" id="fullCode" value="">

                    <div class="code-inputs">
                        <input type="text" class="code-input" maxlength="1" data-index="0" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                        <input type="text" class="code-input" maxlength="1" data-index="1" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                        <input type="text" class="code-input" maxlength="1" data-index="2" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                        <input type="text" class="code-input" maxlength="1" data-index="3" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                        <input type="text" class="code-input" maxlength="1" data-index="4" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                        <input type="text" class="code-input" maxlength="1" data-index="5" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                    </div>
                </form>

                <div class="resend-section">
                    <p>Didn't receive the code?</p>
                    <form method="POST" action="{{ route('password.email') }}" id="resendForm">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                        <a href="#" id="resendLink" onclick="document.getElementById('resendForm').submit(); return false;">Resend Code</a>
                    </form>
                    <div class="timer" id="timer" style="display: none;">
                        Resend available in <span id="countdown">60</span>s
                    </div>
                </div>

                <div class="back-link">
                    <a href="{{ route('password.request') }}">← Change Email</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle form submission errors - show shake animation
        @if ($errors->has('code'))
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof showCodeError === 'function') {
                    showCodeError();
                }
            });
        @endif

        // Resend timer functionality
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof startResendTimer === 'function') {
                    startResendTimer();
                }
            });
        @endif
    </script>
</body>
</html>
