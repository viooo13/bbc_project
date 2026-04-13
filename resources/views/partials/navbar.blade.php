<!-- NAVBAR -->
<header id="mainNavbar" class="fixed inset-x-0 top-4 z-50 px-3">
    <div class="navbar-shell max-w-[1180px] mx-auto flex items-center justify-between gap-2.5 rounded-[36px] border border-white/20 bg-white/10 pl-4 pr-4 sm:pl-5 sm:pr-5 py-2 shadow-2xl shadow-black/15 backdrop-blur-3xl transition-all duration-500">
        <div class="flex items-center justify-start md:min-w-[146px] h-10">
            <img src="/logo.jpeg" alt="logo" class="navbar-logo h-12 w-auto object-contain" />
        </div>

        <div class="hidden md:flex relative items-center justify-center flex-1 px-3">
            <div class="nav-items-group relative z-10 inline-flex max-w-[720px] items-center justify-center gap-2.5 px-1 py-1 rounded-full">
                <button type="button" data-url="{{ route('home') }}" data-active="{{ request()->routeIs('home') ? 'true' : 'false' }}" class="nav-item-button relative z-10 px-3.5 py-0.5 rounded-full text-[13px] font-semibold transition-colors duration-300 text-[#3a2a1a] hover:text-[#1f1410]">HOME</button>
                <button type="button" data-url="{{ route('pages.tentang') }}" data-active="{{ request()->routeIs('pages.tentang') ? 'true' : 'false' }}" class="nav-item-button relative z-10 px-3.5 py-0.5 rounded-full text-[13px] font-semibold transition-colors duration-300 text-[#3a2a1a] hover:text-[#1f1410]">TENTANG BBC</button>
                <button type="button" data-url="{{ route('menu.public') }}" data-active="{{ request()->routeIs('menu.public') ? 'true' : 'false' }}" class="nav-item-button relative z-10 px-3.5 py-0.5 rounded-full text-[13px] font-semibold transition-colors duration-300 text-[#3a2a1a] hover:text-[#1f1410]">MENU</button>
                <button type="button" data-url="{{ route('pages.lokasi_kontak') }}" data-active="{{ request()->routeIs('pages.lokasi_kontak') ? 'true' : 'false' }}" class="nav-item-button relative z-10 px-3.5 py-0.5 rounded-full text-[13px] font-semibold transition-colors duration-300 text-[#3a2a1a] hover:text-[#1f1410]">LOKASI DAN KONTAK</button>
                <span class="nav-active-bg absolute left-0 top-0 rounded-full bg-red-600/90 shadow-[0_20px_80px_-55px_rgba(139,0,0,0.85)] transition-all duration-500 z-0"></span>
            </div>
        </div>

        <button id="mobileNavToggle" type="button" aria-label="Toggle mobile menu" aria-controls="mobileNavbarMenu" aria-expanded="false" class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/35 bg-white/20 text-[#3a2a1a]">
            <i id="mobileNavIconOpen" class="fas fa-bars text-sm"></i>
            <i id="mobileNavIconClose" class="fas fa-times text-sm hidden"></i>
        </button>

        <div class="hidden md:flex items-center justify-end md:min-w-[112px]">
            @auth
            <button type="button" class="nav-action-btn relative bg-white/10 text-[#3a2a1a] px-4 py-0.5 rounded-full text-[13px] font-semibold hover:bg-white/20 transition-all duration-300" onclick="window.location.href='{{ route('cart.index') }}'">
                <i class="fas fa-shopping-cart"></i>
                <span class="hidden sm:inline ml-2">Keranjang</span>
                <span id="cartCount" class="absolute -top-2 -right-2 bg-yellow-400 text-red-600 text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-bold">0</span>
            </button>
            @else
            <button type="button" class="nav-action-btn bg-red-600 text-white px-[18px] py-0.5 rounded-full text-[13px] font-semibold hover:bg-red-700 transition-all duration-300" onclick="window.location.href='{{ route('login') }}'">MASUK</button>
            @endauth
        </div>
    </div>

    <div id="mobileNavbarMenu" class="md:hidden rounded-2xl border border-white/30 bg-white/15 px-3 py-3 backdrop-blur-2xl shadow-xl shadow-black/15">
        <div class="flex flex-col gap-2">
            <a href="{{ route('home') }}" class="rounded-xl px-3 py-2 text-sm font-semibold {{ request()->routeIs('home') ? 'bg-red-600 text-white' : 'text-[#2f2218] bg-white/40' }}">HOME</a>
            <a href="{{ route('pages.tentang') }}" class="rounded-xl px-3 py-2 text-sm font-semibold {{ request()->routeIs('pages.tentang') ? 'bg-red-600 text-white' : 'text-[#2f2218] bg-white/40' }}">TENTANG BBC</a>
            <a href="{{ route('menu.public') }}" class="rounded-xl px-3 py-2 text-sm font-semibold {{ request()->routeIs('menu.public') ? 'bg-red-600 text-white' : 'text-[#2f2218] bg-white/40' }}">MENU</a>
            <a href="{{ route('pages.lokasi_kontak') }}" class="rounded-xl px-3 py-2 text-sm font-semibold {{ request()->routeIs('pages.lokasi_kontak') ? 'bg-red-600 text-white' : 'text-[#2f2218] bg-white/40' }}">LOKASI DAN KONTAK</a>

            @auth
            <a href="{{ route('cart.index') }}" class="rounded-xl px-3 py-2 text-sm font-semibold text-[#2f2218] bg-white/40">KERANJANG</a>
            @else
            <a href="{{ route('login') }}" class="rounded-xl px-3 py-2 text-sm font-semibold bg-red-600 text-white text-center">MASUK</a>
            @endauth
        </div>
    </div>
</header>
@unless(request()->routeIs('home'))
<div class="h-24 sm:h-28"></div>
@endunless
<style>
    #mainNavbar {
        transition: none;
    }

    #mainNavbar .navbar-shell {
        transition: transform 0.35s ease, background-color 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
        transform-origin: center top;
    }

    #mainNavbar .navbar-logo {
        transition: transform 0.35s ease;
        transform-origin: left center;
    }

    #mainNavbar .nav-item-button,
    #mainNavbar .nav-action-btn {
        transition: padding 0.35s ease, color 0.3s ease, background-color 0.3s ease;
    }

    #mobileNavbarMenu {
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        margin-top: 0;
        transform: translateY(-8px);
        pointer-events: none;
        border-color: transparent;
        transition: max-height 0.35s ease, opacity 0.25s ease, transform 0.35s ease, margin-top 0.35s ease, border-color 0.35s ease;
    }

    #mobileNavbarMenu.mobile-open {
        max-height: 420px;
        opacity: 1;
        margin-top: 0.5rem;
        transform: translateY(0);
        pointer-events: auto;
        border-color: rgba(255, 255, 255, 0.3);
    }

    #mainNavbar.navbar-scrolled .navbar-shell {
        transform: scale(0.92);
        background-color: rgba(255, 255, 255, 0.16);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.14);
    }

    #mainNavbar.navbar-scrolled .navbar-logo {
        transform: scale(0.94);
    }

</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (window.__bbcNavbarInit) return;
    window.__bbcNavbarInit = true;

    const navGroup = document.querySelector('.nav-items-group');
    const activeBg = document.querySelector('.nav-active-bg');
    const navBtns = document.querySelectorAll('.nav-item-button');
    const navbar = document.getElementById('mainNavbar');
    const mobileToggle = document.getElementById('mobileNavToggle');
    const mobileMenu = document.getElementById('mobileNavbarMenu');
    const mobileIconOpen = document.getElementById('mobileNavIconOpen');
    const mobileIconClose = document.getElementById('mobileNavIconClose');
    let activeBtn = null;

    function syncNavbarOnScroll() {
        if (!navbar) return;
        if (window.scrollY > 24) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    }

    function moveActiveBtn(button) {
        if (!navGroup || !activeBg || !button) return;
        const btnRect = button.getBoundingClientRect();
        const groupRect = navGroup.getBoundingClientRect();
        activeBg.style.width = `${btnRect.width}px`;
        activeBg.style.height = `${btnRect.height}px`;
        activeBg.style.transform = `translate(${btnRect.left - groupRect.left}px, ${btnRect.top - groupRect.top}px)`;
    }

    if (navGroup && activeBg && navBtns.length > 0) {
        activeBtn = Array.from(navBtns).find(btn => btn.dataset.active === 'true');
        if (!activeBtn) activeBtn = navBtns[0];

        navBtns.forEach(btn => {
            btn.style.transition = 'none';
            btn.classList.remove('text-white');
        });
        activeBg.style.transition = 'none';
        moveActiveBtn(activeBtn);
        activeBtn.classList.add('text-white');

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                navBtns.forEach(btn => {
                    btn.style.transition = '';
                });
                activeBg.style.transition = 'all 500ms ease';
            });
        });

        navBtns.forEach(btn => {
            btn.addEventListener('click', function(event) {
                const url = this.dataset.url;
                if (!url || this === activeBtn) return;
                event.preventDefault();
                activeBtn = this;
                moveActiveBtn(this);
                navBtns.forEach(b => b.classList.remove('text-white'));
                this.classList.add('text-white');
                setTimeout(() => window.location.href = url, 150);
            });
        });
    }

    function setMobileMenu(open) {
        if (!mobileMenu || !mobileToggle) return;
        mobileMenu.classList.toggle('mobile-open', open);
        mobileToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (mobileIconOpen && mobileIconClose) {
            mobileIconOpen.classList.toggle('hidden', open);
            mobileIconClose.classList.toggle('hidden', !open);
        }
    }

    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function() {
            const isOpen = mobileMenu.classList.contains('mobile-open');
            setMobileMenu(!isOpen);
        });

        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => setMobileMenu(false));
        });

        setMobileMenu(false);
    }

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            setMobileMenu(false);
        }
        if (activeBtn) {
            moveActiveBtn(activeBtn);
        }
    });

    window.addEventListener('scroll', syncNavbarOnScroll, { passive: true });
    syncNavbarOnScroll();
});
</script>