<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - University of Rizal System Binangonan</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/urs_logo.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/auth_login.css', 'resources/css/auth_reset-password.css', 'resources/js/auth_login.js', 'resources/js/auth_reset-password.js'])
</head>
<body class="gradient-bg">
    <div class="login-container">
        <div class="title">
            <h1>University of Rizal System Binangonan</h1>
            <p>Performance Commitment and Review Module</p>
        </div>

        <div class="login-box">
            <div class="login-header">
                <h2>Create New Password</h2>
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

                <div class="verified-badge">
                    <i class="fas fa-check-circle"></i>
                    Email verified: {{ $email ?? session('verified_email') }}
                </div>

                <div class="password-requirements">
                    <p>Password Requirements:</p>
                    <ul>
                        <li>At least 8 characters long</li>
                        <li>Use a mix of letters, numbers, and symbols for better security</li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email ?? session('verified_email') }}">
                    <input type="hidden" name="reset_token" value="{{ $reset_token ?? session('reset_token') }}">

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <div class="password-toggle">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter new password"
                                required
                                autofocus
                            >
                            <button type="button" class="toggle-btn" onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <div class="password-toggle">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Confirm new password"
                                required
                            >
                            <button type="button" class="toggle-btn" onclick="toggleConfirmPasswordVisibility()">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="login-btn">Reset Password</button>
                </form>

                <div class="back-link">
                    <a href="{{ route('password.request') }}">← Start Over</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
