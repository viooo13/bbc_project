<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#8B0000',
                        'secondary': '#DAA520',
                        'accent': '#FF6B6B',
                        'neutral': '#2D3748',
                        'cream': '#F5E9D8',
                    }
                }
            }
        }
    </script>
    <style>
        .register-bg {
            background: linear-gradient(135deg, #FF6B6B 0%, #8B0000 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="min-h-screen register-bg flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-xl mb-4">
                <i class="fas fa-utensils text-3xl text-primary"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">BBC User</h1>
            <p class="text-white/80">Bakso Bunderan Ciomas</p>
        </div>

        <!-- Register Form -->
        <div class="glass-effect rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Daftar Akun Baru</h2>
                <p class="text-gray-600">Bergabung dan nikmati menu favorit Anda</p>
            </div>

            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form action="{{ route('user.register.submit') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-user mr-2"></i>Nama Lengkap
                    </label>
                    <input type="text" 
                           name="name" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                           placeholder="John Doe">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <input type="email" 
                           name="email" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                           placeholder="nama@email.com">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-phone mr-2"></i>No. Telepon
                    </label>
                    <input type="tel" 
                           name="phone" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                           placeholder="08123456789">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               required
                               minlength="6"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                               placeholder="Minimal 6 karakter">
                        <button type="button" 
                                onclick="togglePassword('password')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-lock mr-2"></i>Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password_confirmation" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                               placeholder="Ulangi password">
                        <button type="button" 
                                onclick="togglePassword('password_confirmation')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye" id="toggleConfirmIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" name="terms" required class="mr-2 mt-1 rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Saya setuju dengan <a href="#" class="text-primary hover:underline">syarat dan ketentuan</a> yang berlaku</span>
                    </label>
                </div>

                <button type="submit" 
                        class="w-full bg-primary text-white py-3 px-4 rounded-lg font-semibold hover:bg-primary-dark transition duration-300 flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('user.login') }}" class="text-primary hover:text-primary-dark text-sm">
                    <i class="fas fa-sign-in-alt mr-1"></i>
                    Sudah punya akun? Login disini
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-white/60 text-sm">© 2024 Bakso Bunderan Ciomas. All rights reserved.</p>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.querySelector(`input[name="${fieldId}"]`);
            const toggleIcon = fieldId === 'password' ? 'togglePasswordIcon' : 'toggleConfirmIcon';
            const icon = document.getElementById(toggleIcon);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
