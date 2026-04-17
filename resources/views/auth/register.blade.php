<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-main: #e9decf;
            --bg-card: #f6f4f1;
            --text-main: #1f1f1f;
            --text-soft: #666;
            --line: #7f7f7f;
            --line-focus: #e5382d;
            --brand: #ef1f1f;
            --brand-dark: #d91515;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(circle at 10% 15%, rgba(255, 255, 255, 0.32), transparent 28%),
                radial-gradient(circle at 88% 82%, rgba(229, 56, 45, 0.14), transparent 34%),
                var(--bg-main);
            display: grid;
            place-items: center;
            padding: 30px 20px;
            color: var(--text-main);
        }

        .auth-card {
            width: 100%;
            max-width: 392px;
            background: var(--bg-card);
            border: 1px solid #ece7e2;
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(101, 67, 33, 0.13), 8px 10px 0 rgba(227, 92, 78, 0.25);
            padding: 20px 24px 22px;
        }

        .brand {
            text-align: center;
            margin-bottom: 12px;
        }

        .brand img {
            width: 74px;
            height: 74px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            filter: drop-shadow(0 4px 7px rgba(0, 0, 0, 0.14));
        }

        .title {
            text-align: center;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            line-height: 1.15;
            letter-spacing: 0.2px;
        }

        .subtitle {
            text-align: center;
            margin: 4px 0 16px;
            font-size: 12px;
            color: var(--text-soft);
        }

        .alert {
            border-radius: 10px;
            padding: 9px 11px;
            font-size: 12px;
            margin-bottom: 12px;
        }

        .alert.error { background: #fee2e2; color: #991b1b; }

        .field {
            position: relative;
            margin-bottom: 12px;
        }

        .field label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #2d2d2d;
        }

        .field input {
            width: 100%;
            border: none;
            border-bottom: 1px solid var(--line);
            background: transparent;
            padding: 8px 32px 8px 30px;
            font-size: 12px;
            color: #111;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .field input::placeholder { color: #9d9d9d; }

        .field input:focus {
            border-bottom-color: var(--line-focus);
        }

        .icon {
            position: absolute;
            left: 5px;
            bottom: 11px;
            font-size: 13px;
            color: #111;
        }

        .toggle {
            position: absolute;
            right: 2px;
            bottom: 6px;
            border: none;
            background: transparent;
            font-size: 13px;
            color: #383838;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
        }

        .terms {
            margin: 8px 0 14px;
            display: flex;
            align-items: flex-start;
            gap: 7px;
            font-size: 11px;
            color: #444;
        }

        .terms a {
            color: var(--brand);
            text-decoration: none;
            font-weight: 700;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
        }

        .btn {
            border: none;
            border-radius: 999px;
            background: linear-gradient(180deg, var(--brand), var(--brand-dark));
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: 0.3px;
            padding: 9px 20px;
            cursor: pointer;
            box-shadow: 0 6px 12px rgba(217, 21, 21, 0.3);
            transition: transform 0.15s ease, box-shadow 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 9px 16px rgba(217, 21, 21, 0.34);
        }

        .switch-link {
            margin-top: 12px;
            text-align: center;
            font-size: 10px;
            font-weight: 600;
            color: #111;
        }

        .switch-link a {
            color: var(--brand);
            text-decoration: none;
            font-weight: 800;
        }

        @media (max-width: 420px) {
            body {
                padding: 18px 14px;
            }

            .auth-card {
                border-radius: 14px;
                padding: 16px 16px 18px;
            }

            .title {
                font-size: 21px;
            }

            .btn {
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    <section class="auth-card">
        <div class="brand">
            <img src="{{ asset('logo.jpeg') }}" alt="Logo BBC" onerror="this.onerror=null;this.style.display='none';" />
        </div>

        <h1 class="title">Daftar Akun Baru</h1>
        <p class="subtitle">Bergabung dan nikmati menu favorit Anda</p>

            @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
            @endif

            @if($errors->any())
            <div class="alert error">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('user.register.submit') }}" method="POST">
                @csrf

                <div class="field">
                    <label>Nama Lengkap</label>
                    <i class="fas fa-user icon"></i>
                    <input type="text" 
                           name="name" 
                           required
                           class=""
                           placeholder="John Doe">
                </div>

                <div class="field">
                    <label>Email</label>
                    <i class="fas fa-envelope icon"></i>
                    <input type="email" 
                           name="email" 
                           required
                           class=""
                           placeholder="nama@email.com">
                </div>

                <div class="field">
                    <label>No. Telepon</label>
                    <i class="fas fa-phone icon"></i>
                    <input type="tel" 
                           name="phone" 
                           required
                           class=""
                           placeholder="08123456789">
                </div>

                <div class="field">
                    <label>Password</label>
                    <i class="fas fa-lock icon"></i>
                        <input type="password" 
                               name="password" 
                               required
                               minlength="6"
                               class=""
                               placeholder="Minimal 6 karakter">
                        <button type="button" 
                                onclick="togglePassword('password', this)"
                                class="toggle">
                            <i class="far fa-eye-slash"></i>
                        </button>
                </div>

                <div class="field">
                    <label>Konfirmasi Password</label>
                    <i class="fas fa-lock icon"></i>
                        <input type="password" 
                               name="password_confirmation" 
                               required
                               class=""
                               placeholder="Ulangi password">
                        <button type="button" 
                                onclick="togglePassword('password_confirmation', this)"
                                class="toggle">
                            <i class="far fa-eye-slash"></i>
                        </button>
                </div>

                <label class="terms">
                    <input type="checkbox" name="agree" value="1" required>
                    <span>Saya setuju dengan <a href="#">syarat dan ketentuan</a> yang berlaku</span>
                </label>

                <div class="actions">
                    <button type="submit" class="btn">DAFTAR</button>
                </div>
            </form>

            <p class="switch-link">Sudah punya akun? <a href="{{ route('user.login') }}">Login disini</a></p>
    </section>

    <script>
        function togglePassword(fieldId, button) {
            const passwordInput = document.querySelector(`input[name="${fieldId}"]`);
            if (!passwordInput) return;

            const icon = button.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.className = 'far fa-eye';
                return;
            }

            passwordInput.type = 'password';
            icon.className = 'far fa-eye-slash';
        }
    </script>
</body>
</html>
