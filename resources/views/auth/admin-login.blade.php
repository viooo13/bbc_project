<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;600;700;800&family=Montserrat:wght@700;800&family=Pinyon+Script&display=swap&family=Poppins:wght@300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        sans: ['Poppins', 'sans-serif'], 
                        display: ['Outfit', 'sans-serif'], 
                        montserrat: ['Montserrat', 'sans-serif'] 
                    },
                    colors: {
                        brand: { DEFAULT: '#8B0000', dark: '#6B0000', light: '#fef2f2' },
                    },
                    keyframes: {
                        cardEntry: { from: { opacity: '0', transform: 'translateY(16px)' }, to: { opacity: '1', transform: 'translateY(0)' } },
                        alertSlide: { from: { opacity: '0', transform: 'translateY(-8px) scale(0.98)' }, to: { opacity: '1', transform: 'translateY(0) scale(1)' } },
                        fadeIn: { from: { opacity: '0', transform: 'translateY(8px)' }, to: { opacity: '1', transform: 'translateY(0)' } },
                    },
                    animation: {
                        cardEntry: 'cardEntry 0.6s cubic-bezier(0.16,1,0.3,1) forwards',
                        alertSlide: 'alertSlide 0.4s cubic-bezier(0.16,1,0.3,1)',
                        fadeIn: 'fadeIn 0.4s cubic-bezier(0.16,1,0.3,1) forwards',
                    },
                },
            },
        }
    </script>
    <style>
        .field-input:focus { outline: none !important; box-shadow: none !important; ring: 0; }
        .btn-submit { 
            background: linear-gradient(to right, #700000 50%, #8B0000 50%) !important;
            background-size: 200% 100% !important;
            background-position: right bottom !important;
            transition: all 0.4s ease-out !important;
        }
        .btn-submit:hover { background-position: left bottom !important; }
    </style>
</head>
<body class="font-sans min-h-screen flex items-center justify-center bg-stone-50 p-5 overflow-x-hidden">
    <div class="w-full max-w-[440px] relative z-10">
        <div class="auth-card bg-white/[0.92] rounded-[28px] p-11 px-9 shadow-lg backdrop-blur-xl border border-white/70 animate-cardEntry opacity-0">

            <!-- Logo -->
            <div class="text-center mb-6">
                <div class="auth-logo w-[180px] mx-auto mb-3">
                    <img src="{{ asset('logo.jpeg') }}" alt="BBC Logo" class="w-full h-auto object-contain">
                </div>
                <div class="auth-tagline text-[22px] font-bold text-brand tracking-tight">
                    Bakso Bunderan Ciomas
                </div>
            </div>

            <!-- Tabs -->
            <div id="tabsContainer" class="auth-tabs flex bg-stone-100 rounded-2xl p-1 mb-6 relative">
                <div id="tabIndicator" class="absolute top-1 bottom-1 left-1 w-[calc(50%-4px)] bg-white rounded-xl shadow-sm transition-transform duration-300 ease-out z-0 translate-x-full"></div>
                <button type="button" id="userTab" class="tab flex-1 py-2.5 text-[13px] font-semibold transition-colors duration-300 z-10 text-stone-400 relative" onclick="window.location.href='{{ route('showLogin') }}'">Pelanggan</button>
                <button type="button" id="adminTab" class="tab flex-1 py-2.5 text-[13px] font-semibold transition-colors duration-300 z-10 text-brand relative">Admin</button>
            </div>

            <!-- Title -->
            <p id="authSubtitle" class="auth-subtitle text-[13.5px] text-stone-500 text-center mb-6">Akses dashboard admin</p>

            <div class="auth-divider h-px bg-gradient-to-r from-transparent via-stone-200 to-transparent mb-6"></div>

            <!-- Alerts -->
            @if(session('error'))
                <div class="auth-alert flex items-center gap-2.5 p-3 px-4 rounded-xl text-[13px] font-medium mb-5 animate-alertSlide bg-gradient-to-br from-red-50 to-red-100/20 text-brand border border-brand/10">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="auth-field mb-6">
                    <label class="auth-label block text-xs font-semibold text-stone-700 mb-1 tracking-wide uppercase">Username / Email</label>
                    <div class="relative">
                        <input type="text" name="username" class="field-input w-full py-3 pl-8 pr-0 border-0 border-b-2 border-stone-200 bg-transparent text-sm font-normal text-stone-900 transition-all duration-300 focus:outline-none focus:border-b-brand focus:shadow-none placeholder:text-stone-400" autocomplete="off" required placeholder="Masukkan username admin">
                        <i class="fas fa-user-shield absolute left-1 top-1/2 -translate-y-1/2 text-stone-400 text-[15px]"></i>
                    </div>
                </div>

                <div class="auth-field mb-8">
                    <label class="auth-label block text-xs font-semibold text-stone-700 mb-1 tracking-wide uppercase">Password</label>
                    <div class="relative">
                        <input id="adminPassword" type="password" name="password" class="field-input w-full py-3 pr-8 border-0 border-b-2 border-stone-200 bg-transparent text-sm font-normal text-stone-900 transition-all duration-300 focus:outline-none focus:border-b-brand focus:shadow-none placeholder:text-stone-400" required placeholder="Masukkan password">
                        <button type="button" class="absolute right-1 top-1/2 -translate-y-1/2 text-stone-400 p-1 hover:text-stone-600" onclick="togglePassword('adminPassword', this)">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit w-full py-3.5 bg-brand text-white border-none rounded-xl text-sm font-semibold cursor-pointer tracking-wide shadow-md">Masuk sebagai Admin</button>
                
                <div class="mt-6 text-center">
                    <a href="{{ route('showLogin') }}" class="text-[13px] text-stone-500 hover:text-brand transition-colors font-medium">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login Utama
                    </a>
                </div>
            </form>

        </div>
    </div>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
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
