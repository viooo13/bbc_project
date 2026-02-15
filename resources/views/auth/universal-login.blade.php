<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bakso Bunderan Ciomas</title>
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
        .login-bg {
            background: linear-gradient(135deg, #FF6B6B 0%, #8B0000 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .role-tab {
            transition: all 0.3s ease;
        }
        .role-tab.active {
            background: linear-gradient(135deg, #8B0000, #DAA520);
            color: white;
        }
    </style>
</head>
<body class="min-h-screen login-bg flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-xl mb-4">
                <i class="fas fa-utensils text-3xl text-primary"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Bakso Bunderan</h1>
            <p class="text-white/80">Ciomas</p>
        </div>

        <!-- Login Form -->
        <div class="glass-effect rounded-2xl shadow-2xl p-8">
            <!-- Role Selector -->
            <div class="mb-6">
                <div class="flex bg-gray-100 rounded-lg p-1">
                    <button type="button" 
                            onclick="switchRole('user')" 
                            id="userTab"
                            class="role-tab active flex-1 py-2 px-4 rounded-md text-sm font-medium transition-all duration-300">
                        <i class="fas fa-user mr-2"></i>
                        User
                    </button>
                    <button type="button" 
                            onclick="switchRole('admin')" 
                            id="adminTab"
                            class="role-tab flex-1 py-2 px-4 rounded-md text-sm font-medium transition-all duration-300">
                        <i class="fas fa-user-shield mr-2"></i>
                        Admin
                    </button>
                </div>
            </div>

            <!-- User Login Form -->
            <div id="userForm" class="login-form">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Login Pelanggan</h2>
                    <p class="text-gray-600">Masuk untuk memesan menu favorit Anda</p>
                </div>

                @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                </div>
                @endif

                @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
                @endif

                <form action="{{ route('universal.login.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="user" id="roleInput">
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            <i class="fas fa-envelope mr-2"></i>Email
                        </label>
                        <input type="email" 
                               name="email" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                               placeholder="nama@email.com">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            <i class="fas fa-lock mr-2"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                   placeholder="Masukkan password">
                            <button type="button" 
                                    onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-primary focus:ring-primary">
                            <span class="text-sm text-gray-700">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit" 
                            class="w-full bg-primary text-white py-3 px-4 rounded-lg font-semibold hover:bg-primary-dark transition duration-300 flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('user.register') }}" class="text-primary hover:text-primary-dark text-sm">
                        <i class="fas fa-user-plus mr-1"></i>
                        Belum punya akun? Daftar disini
                    </a>
                </div>
            </div>

            <!-- Admin Login Form -->
            <div id="adminForm" class="login-form hidden">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Login Administrator</h2>
                    <p class="text-gray-600">Masuk ke dashboard admin</p>
                </div>

                <form action="{{ route('universal.login.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="admin" id="adminRoleInput">
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            <i class="fas fa-user mr-2"></i>Username
                        </label>
                        <input type="text" 
                               name="username" 
                               value="bbcjaya123"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                               placeholder="Masukkan username">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            <i class="fas fa-lock mr-2"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password" 
                                   value="bbcjaya123"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                   placeholder="Masukkan password">
                            <button type="button" 
                                    onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-primary focus:ring-primary">
                            <span class="text-sm text-gray-700">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit" 
                            class="w-full bg-primary text-white py-3 px-4 rounded-lg font-semibold hover:bg-primary-dark transition duration-300 flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login Admin
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-white/60 text-sm">© 2024 Bakso Bunderan Ciomas. All rights reserved.</p>
        </div>
    </div>

    <script>
        let currentRole = 'user';

        function switchRole(role) {
            currentRole = role;
            
            // Update tabs
            const userTab = document.getElementById('userTab');
            const adminTab = document.getElementById('adminTab');
            const userForm = document.getElementById('userForm');
            const adminForm = document.getElementById('adminForm');
            
            if (role === 'user') {
                userTab.classList.add('active');
                adminTab.classList.remove('active');
                userForm.classList.remove('hidden');
                adminForm.classList.add('hidden');
                document.getElementById('roleInput').value = 'user';
            } else {
                adminTab.classList.add('active');
                userTab.classList.remove('active');
                adminForm.classList.remove('hidden');
                userForm.classList.add('hidden');
                document.getElementById('adminRoleInput').value = 'admin';
            }
        }

        function togglePassword() {
            const passwordInputs = document.querySelectorAll('input[type="password"]');
            const toggleIcons = document.querySelectorAll('#toggleIcon');
            
            passwordInputs.forEach((input, index) => {
                const icon = toggleIcons[index] || toggleIcons[0];
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        }

        // Auto-fill untuk demo admin
        document.addEventListener('DOMContentLoaded', function() {
            // Form admin sudah diisi dengan default credentials
        });
    </script>
</body>
</html> 