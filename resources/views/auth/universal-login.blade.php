<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #dc2626;
            --primary-dark: #b91c1c;
            --primary-light: #fef2f2;
            --gray-50: #fafafa;
            --gray-100: #f5f5f5;
            --gray-200: #e5e5e5;
            --gray-300: #d4d4d4;
            --gray-400: #a3a3a3;
            --gray-500: #737373;
            --gray-600: #525252;
            --gray-700: #404040;
            --gray-800: #262626;
            --gray-900: #171717;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 420px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: 40px 32px;
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.05),
                0 10px 15px -3px rgba(0, 0, 0, 0.05),
                0 25px 50px -12px rgba(220, 38, 38, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        /* Logo Section */
        .logo-section {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-container {
            width: 120px;
            height: 120px;
            margin: 0 auto 16px;
            background: white;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .logo-container img {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }

        .brand-name {
            font-size: 24px;
            font-weight: 700;
            color: var(--gray-900);
            letter-spacing: -0.5px;
        }

        .brand-tagline {
            font-size: 13px;
            color: var(--gray-500);
            margin-top: 4px;
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 8px;
            background: var(--gray-100);
            padding: 4px;
            border-radius: 12px;
            margin-bottom: 28px;
        }

        .tab {
            flex: 1;
            padding: 10px 16px;
            border: none;
            background: transparent;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-500);
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .tab:hover {
            color: var(--gray-700);
        }

        .tab.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Title */
        .title {
            font-size: 22px;
            font-weight: 700;
            color: var(--gray-900);
            text-align: center;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 14px;
            color: var(--gray-500);
            text-align: center;
            margin-bottom: 24px;
        }

        /* Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-error {
            background: var(--primary-light);
            color: var(--primary-dark);
            border: 1px solid rgba(220, 38, 38, 0.2);
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid rgba(22, 163, 74, 0.2);
        }

        /* Form Fields */
        .field {
            margin-bottom: 20px;
        }

        .field-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        .field-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-size: 14px;
            font-family: inherit;
            color: var(--gray-900);
            background: white;
            transition: all 0.2s ease;
        }

        .field-input.with-icon {
            padding-left: 44px;
        }

        .field-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .field-input::placeholder {
            color: var(--gray-400);
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 16px;
            transition: color 0.2s ease;
        }

        .field-input:focus + .input-icon {
            color: var(--primary);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            padding: 4px;
            font-size: 14px;
            transition: color 0.2s ease;
        }

        .toggle-password:hover {
            color: var(--gray-600);
        }

        /* Remember & Forgot */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--gray-600);
            cursor: pointer;
        }

        .remember-me input {
            width: 18px;
            height: 18px;
            border: 2px solid var(--gray-300);
            border-radius: 6px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 13px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: var(--primary-dark);
        }

        /* Button */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.35);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Switch Link */
        .switch-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: var(--gray-500);
        }

        .switch-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .switch-link a:hover {
            text-decoration: underline;
        }

        /* Hidden */
        .hidden {
            display: none !important;
        }

        /* Responsive */
        /* Remove browser default password icons */
        input::-webkit-credentials-auto-fill-button,
        input::-webkit-contacts-auto-fill-button {
            visibility: hidden;
            display: none !important;
            pointer-events: none;
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 32px 24px;
                border-radius: 20px;
            }

            .logo-container {
                width: 72px;
                height: 72px;
            }

            .logo-container i {
                font-size: 32px;
            }

            .brand-name {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="auth-card">
            <!-- Logo -->
            <div class="logo-section">
                <div class="logo-container">
                    <img src="{{ asset('logo.jpeg') }}" alt="BBC Logo">
                </div>
                <div class="brand-name">BBC</div>
                <div class="brand-tagline">Bakso Bunderan Ciomas</div>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <button type="button" id="userTab" class="tab active" onclick="switchRole('user')">Pelanggan</button>
                <button type="button" id="adminTab" class="tab" onclick="switchRole('admin')">Admin</button>
            </div>

            <!-- Title -->
            <h1 id="authTitle" class="title">Selamat Datang</h1>
            <p id="authSubtitle" class="subtitle">Masuk untuk melanjutkan</p>

            <!-- Alerts -->
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- User Form -->
            <form id="userForm" action="{{ route('universal.login.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="user" id="roleInput">

                <div class="field">
                    <label class="field-label">Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" class="field-input with-icon" autocomplete="off" required placeholder="nama@email.com">
                    </div>
                </div>

                <div class="field">
                    <label class="field-label">Password</label>
                    <div class="input-wrapper">
                        <input id="userPassword" type="password" name="password" class="field-input" autocomplete="new-password" required placeholder="Masukkan password">
                        <button type="button" class="toggle-password" onclick="togglePassword('userPassword', this)">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                </div>

                <button type="submit" class="btn-submit">Masuk</button>

                <p class="switch-link">Belum punya akun? <a href="{{ route('user.register') }}">Daftar sekarang</a></p>
            </form>

            <!-- Admin Form -->
            <form id="adminForm" class="hidden" action="{{ route('universal.login.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="admin" id="adminRoleInput">

                <div class="field">
                    <label class="field-label">Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" name="username" class="field-input with-icon" autocomplete="off" required placeholder="Masukkan username">
                    </div>
                </div>

                <div class="field">
                    <label class="field-label">Password</label>
                    <div class="input-wrapper">
                        <input id="adminPassword" type="password" name="password" class="field-input" autocomplete="new-password" required placeholder="Masukkan password">
                        <button type="button" class="toggle-password" onclick="togglePassword('adminPassword', this)">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                    <a href="{{ route('admin.password.request') }}" class="forgot-link">Lupa password?</a>
                </div>

                <button type="submit" class="btn-submit">Masuk sebagai Admin</button>
            </form>
        </div>
    </div>

    <script>
        function switchRole(role) {
            const userTab = document.getElementById('userTab');
            const adminTab = document.getElementById('adminTab');
            const userForm = document.getElementById('userForm');
            const adminForm = document.getElementById('adminForm');
            const title = document.getElementById('authTitle');
            const subtitle = document.getElementById('authSubtitle');

            if (role === 'user') {
                userTab.classList.add('active');
                adminTab.classList.remove('active');
                userForm.classList.remove('hidden');
                adminForm.classList.add('hidden');
                title.textContent = 'Selamat Datang';
                subtitle.textContent = 'Masuk untuk melanjutkan';
            } else {
                adminTab.classList.add('active');
                userTab.classList.remove('active');
                adminForm.classList.remove('hidden');
                userForm.classList.add('hidden');
                title.textContent = 'Admin Portal';
                subtitle.textContent = 'Akses dashboard admin';
            }
        }

        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            if (!input) return;

            const icon = button.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'far fa-eye';
            } else {
                input.type = 'password';
                icon.className = 'far fa-eye-slash';
            }
        }
    </script>
</body>
</html>
