<!-- NAVBAR -->
<header class="bg-[#3b1b16] text-white sticky top-0 z-50 font-poopins" style="font-family: 'Poppins', sans-serif;">
    <div class="max-w-7xl mx-auto flex items-center px-6 py-3">
        <div class="flex items-center gap-3">
            <img src="/logo.jpeg" alt="logo" class="w-12 h-12 object-contain rounded bg-transparent" />
            <span class="font-bold text-sm font-semibold leading-tight hidden sm:inline font-poopins">
                Bakso<br>
                Bunderan<br>
                Ciomas
            </span>
        </div>

        <nav class="flex-1 pr-8">
            <ul class="hidden md:flex justify-end gap-8 text-sm font-semibold">
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-red-400' : 'text-white' }} hover:text-red-300 no-underline font-poopins">HOME</a>
                </li>
                <li>
                    <a href="{{ route('pages.tentang') }}" class="{{ request()->routeIs('pages.tentang') ? 'text-red-400' : 'text-white' }} hover:text-red-300 no-underline font-poopins">TENTANG BBC</a>
                </li>
                <li>
                    <a href="{{ route('menu.public') }}" class="{{ request()->routeIs('menu.public') ? 'text-red-400' : 'text-white' }} hover:text-red-300 no-underline font-poopins">MENU</a>
                </li>
                <li>
                    <a href="{{ route('pages.lokasi_kontak') }}" class="{{ request()->routeIs('pages.lokasi_kontak') ? 'text-red-400' : 'text-white' }} hover:text-red-300 no-underline font-poopins">LOKASI DAN KONTAK</a>
                </li>
            </ul>
        </nav>

        <div class="flex items-center gap-3">
            <!-- Cart Icon -->
            @auth
            <a href="{{ route('cart.index') }}" class="relative bg-red-600 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-red-700 flex items-center gap-2">
                <i class="fas fa-shopping-cart"></i>
                <span class="hidden sm:inline">Keranjang</span>
                <span id="cartCount" class="absolute -top-2 -right-2 bg-yellow-400 text-red-600 text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold">0</span>
            </a>
            @else
            <a href="{{ route('user.login') }}" class="bg-red-600 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-red-700">
                <i class="fas fa-user mr-2"></i>
                Login
            </a>
            @endauth
        </div>
    </div>
</header>