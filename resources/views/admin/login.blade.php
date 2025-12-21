@extends('layouts.app')
@section('title', 'Login Admin')

@push('styles')
<link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #1dbf73;
        --primary-dark: #17a567;
        --secondary-color: #2ECC71;
        --accent-color: #A3E4D7;
        --text-color: #333;
        --text-light: #666;
        --bg-color: #f9fdfc;
        --card-bg: #ffffff;
        --error-color: #e74c3c;
        --success-color: #2ecc71;
        --border-radius: 16px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [data-theme="dark"] {
        --primary-color: #1dbf73;
        --primary-dark: #17a567;
        --secondary-color: #2ECC71;
        --accent-color: #1a7a4a;
        --text-color: #f0f0f0;
        --text-light: #b0b0b0;
        --bg-color: #121212;
        --card-bg: #1e1e1e;
        --error-color: #e74c3c;
        --success-color: #2ecc71;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body, html {
        height: 100%;
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-color);
        color: var(--text-color);
        transition: var(--transition);
        overflow-x: hidden;
    }

    /* Background animation */
    .bg-animation {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;
        overflow: hidden;
    }

    .bg-animation::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        top: -50%;
        left: -50%;
        background: linear-gradient(45deg, 
            rgba(29, 191, 115, 0.05) 0%, 
            rgba(163, 228, 215, 0.05) 50%, 
            rgba(46, 204, 113, 0.05) 100%);
        animation: bgRotate 20s linear infinite;
    }

    @keyframes bgRotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Floating shapes */
    .shape {
        position: absolute;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0.4;
        animation: float 15s infinite ease-in-out;
    }

    .shape-1 {
        width: 300px;
        height: 300px;
        background: var(--primary-color);
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 200px;
        height: 200px;
        background: var(--accent-color);
        bottom: 10%;
        right: 10%;
        animation-delay: 2s;
    }

    .shape-3 {
        width: 150px;
        height: 150px;
        background: var(--secondary-color);
        top: 50%;
        right: 20%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(10deg); }
    }

    /* Theme toggle */
    .theme-toggle {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        background: var(--card-bg);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: var(--transition);
    }

    .theme-toggle:hover {
        transform: scale(1.1);
    }

    .theme-toggle i {
        font-size: 1.2rem;
        color: var(--primary-color);
    }

    /* Login container */
    .login-container {
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
        padding: 20px;
        position: relative;
        z-index: 1;
    }

    .login-wrapper {
        display: flex;
        width: 100%;
        max-width: 1000px;
        min-height: 600px;
        border-radius: var(--border-radius);
        overflow: hidden;
        background: var(--card-bg);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        position: relative;
    }

    /* Login image section */
    .login-image {
        flex: 1;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px;
        position: relative;
        overflow: hidden;
    }

    .login-image::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: url('/images/pattern.svg') repeat;
        opacity: 0.1;
    }

    .login-image img {
        width: 80%;
        max-height: 200px;
        object-fit: contain;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));
        margin-bottom: 30px;
        z-index: 2;
        animation: float 6s ease-in-out infinite;
    }

    .login-image h2 {
        color: white;
        font-weight: 700;
        font-size: 2rem;
        text-align: center;
        margin-bottom: 15px;
        z-index: 2;
    }

    .login-image p {
        color: rgba(255, 255, 255, 0.9);
        text-align: center;
        max-width: 80%;
        z-index: 2;
    }

    /* Login form section */
    .login-form-container {
        flex: 1;
        padding: 50px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        background: var(--card-bg);
    }

    .login-form-container h2 {
        margin-bottom: 10px;
        color: var(--text-color);
        font-weight: 700;
        font-size: 2rem;
    }

    .login-form-container p {
        color: var(--text-light);
        margin-bottom: 30px;
    }

    /* Form styling */
    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-color);
        font-size: 0.9rem;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        transition: var(--transition);
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 14px 18px 14px 45px;
        border: 2px solid transparent;
        border-radius: 12px;
        background: rgba(0, 0, 0, 0.05);
        font-size: 1rem;
        transition: var(--transition);
        color: var(--text-color);
    }

    [data-theme="dark"] input[type="text"],
    [data-theme="dark"] input[type="password"] {
        background: rgba(255, 255, 255, 0.05);
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        outline: none;
        border-color: var(--primary-color);
        background: var(--card-bg);
    }

    input[type="text"]:focus + i,
    input[type="password"]:focus + i {
        color: var(--primary-color);
    }

    /* Password visibility toggle */
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        cursor: pointer;
        transition: var(--transition);
    }

    .password-toggle:hover {
        color: var(--primary-color);
    }

    /* Remember me and forgot password */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .remember-me {
        display: flex;
        align-items: center;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        accent-color: var(--primary-color);
    }

    .remember-me label {
        margin: 0;
        font-weight: 400;
        font-size: 0.9rem;
        color: var(--text-color);
    }

    .forgot-password {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: var(--transition);
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    /* Button styling */
    .btn-login {
        width: 100%;
        background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 14px 0;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .btn-login:hover::before {
        left: 100%;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(29, 191, 115, 0.3);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .btn-login.loading {
        pointer-events: none;
        opacity: 0.8;
    }

    .btn-login.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Error and success messages */
    .message {
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }

    .message.error {
        background-color: rgba(231, 76, 60, 0.1);
        color: var(--error-color);
        border-left: 4px solid var(--error-color);
    }

    .message.success {
        background-color: rgba(46, 204, 113, 0.1);
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    .message.info {
        background-color: rgba(52, 152, 219, 0.1);
        color: #3498db;
        border-left: 4px solid #3498db;
    }

    .message i {
        margin-right: 10px;
        font-size: 1.2rem;
    }

    /* Responsive design */
    @media (max-width: 992px) {
        .login-wrapper {
            flex-direction: column;
            max-width: 500px;
            min-height: auto;
        }

        .login-image {
            min-height: 200px;
            padding: 30px;
        }

        .login-image img {
            max-height: 100px;
        }

        .login-image h2 {
            font-size: 1.5rem;
        }

        .login-form-container {
            padding: 40px 30px;
        }
    }

    @media (max-width: 576px) {
        .login-form-container {
            padding: 30px 20px;
        }

        .login-form-container h2 {
            font-size: 1.5rem;
        }

        .theme-toggle {
            width: 40px;
            height: 40px;
        }
    }
</style>
@endpush

@section('content')
<!-- Background animation -->
<div class="bg-animation">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
</div>

<!-- Theme toggle -->
<div class="theme-toggle" id="themeToggle">
    <i class="fas fa-sun" id="themeIcon"></i>
</div>

<div class="login-container">
    <div class="login-wrapper">
        <div class="login-image">
            <img src="{{ asset('images/logo.png') }}" alt="Markaz Dimsum Logo">
            <h2>Markaz Dimsum</h2>
            <p>Halal, Murah, dan Enak</p>
        </div>
        <div class="login-form-container">
            <h2>Masuk Admin</h2>
            <p>Selamat datang kembali! Silakan masuk ke akun Anda.</p>
            
            @if ($errors->any())
                <div class="message error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="message success">
                    <i class="fas fa-check-circle"></i>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="message error">
                    <i class="fas fa-exclamation-circle"></i>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="username">Nama Pengguna</label>
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" required autofocus placeholder="Masukkan nama pengguna">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" required placeholder="Masukkan kata sandi">
                        <i class="fas fa-lock"></i>
                        <span class="password-toggle" id="passwordToggle">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                    <a href="#" class="forgot-password">Lupa kata sandi?</a>
                </div>
                <button type="submit" class="btn-login" id="loginBtn">
                    <span>Masuk</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize theme
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
            document.documentElement.setAttribute('data-theme', 'dark');
            updateThemeIcon(true);
        }

        // Theme toggle functionality
        document.getElementById('themeToggle').addEventListener('click', function() {
            const isDarkMode = document.documentElement.getAttribute('data-theme') === 'dark';
            
            if (isDarkMode) {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
                updateThemeIcon(false);
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                updateThemeIcon(true);
            }
        });

        // Update theme icon
        function updateThemeIcon(isDarkMode) {
            const icon = document.getElementById('themeIcon');
            if (isDarkMode) {
                icon.className = 'fas fa-moon';
            } else {
                icon.className = 'fas fa-sun';
            }
        }

        // Password visibility toggle
        const passwordToggle = document.getElementById('passwordToggle');
        const passwordInput = document.getElementById('password');
        
        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });

        // Form submission with loading state
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        
        loginForm.addEventListener('submit', function(e) {
            // Add loading state to button
            loginBtn.classList.add('loading');
            loginBtn.querySelector('span').textContent = 'Memproses...';
        });

        // Forgot password handler
        document.querySelector('.forgot-password').addEventListener('click', function(e) {
            e.preventDefault();
            // Here you would implement forgot password logic
            showMessage('Fitur lupa kata sandi akan segera hadir', 'info');
        });

        // Add input animations
        const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });

        // Function to show messages
        function showMessage(text, type) {
            // Remove existing messages
            const existingMessages = document.querySelectorAll('.message');
            existingMessages.forEach(msg => msg.remove());
            
            // Create new message element
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}`;
            
            let iconClass = '';
            if (type === 'error') iconClass = 'fas fa-exclamation-circle';
            else if (type === 'success') iconClass = 'fas fa-check-circle';
            else iconClass = 'fas fa-info-circle';
            
            messageDiv.innerHTML = `
                <i class="${iconClass}"></i>
                <p>${text}</p>
            `;
            
            // Insert before the form
            loginForm.parentNode.insertBefore(messageDiv, loginForm);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                messageDiv.remove();
            }, 5000);
        }
    });
</script>
@endpush