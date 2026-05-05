<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Bakso Bunderan Ciomas</title>
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

        /* Steps */
        .steps {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }

        .step-number {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--gray-200);
            color: var(--gray-500);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
        }

        .step-number.active {
            background: var(--primary);
            color: white;
        }

        .step-label {
            font-size: 11px;
            color: var(--gray-500);
            font-weight: 500;
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
            margin-bottom: 8px;
        }

        .email-hint {
            font-size: 13px;
            color: var(--gray-600);
            text-align: center;
            margin-bottom: 24px;
            word-break: break-all;
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
            transition: opacity 0.5s ease;
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

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid rgba(22, 163, 74, 0.2);
        }

        .alert-error {
            background: var(--primary-light);
            color: var(--primary-dark);
            border: 1px solid rgba(220, 38, 38, 0.2);
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

        .otp-input {
            text-align: center;
            letter-spacing: 8px;
            font-size: 18px;
            font-weight: 600;
            padding-left: 16px !important;
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

        /* Back Link */
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
            font-size: 13px;
            color: var(--gray-500);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--primary);
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
                <div class="brand-tagline">Admin Portal</div>
            </div>

            <!-- Steps -->
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <span class="step-label">Email</span>
                </div>
                <div class="step">
                    <div class="step-number active">2</div>
                    <span class="step-label">Verifikasi</span>
                </div>
            </div>

            <!-- Title -->
            <h1 class="title">Verifikasi Kode</h1>
            <p class="subtitle">Masukkan kode OTP yang dikirim ke</p>
            <p class="email-hint">{{ session('admin_reset_email') }}</p>

            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success" id="alertMsg">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error" id="alertMsg">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-error" id="alertMsg">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('admin.password.verify.post') }}" method="POST">
                @csrf

                <div class="field">
                    <label class="field-label">Kode OTP</label>
                    <div class="input-wrapper">
                        <i class="fas fa-key input-icon"></i>
                        <input type="text" name="otp" class="field-input with-icon otp-input" required placeholder="------" maxlength="6" autocomplete="off">
                    </div>
                </div>

                <div class="field">
                    <label class="field-label">Password Baru</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="password" class="field-input" required minlength="6" placeholder="Minimal 6 karakter" autocomplete="new-password">
                        <button type="button" class="toggle-password" onclick="togglePassword('password', this)">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="field">
                    <label class="field-label">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="field-input" required placeholder="Ulangi password" autocomplete="new-password">
                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Simpan Password Baru</button>
            </form>

            <a href="{{ route('admin.password.request') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <script>
        // Auto-hide alert after 3 seconds
        setTimeout(function() {
            const alert = document.getElementById('alertMsg');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);

        // Auto-uppercase OTP input
        document.querySelector('.otp-input').addEventListener('input', function(e) {
            this.value = this.value.toUpperCase();
        });

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
