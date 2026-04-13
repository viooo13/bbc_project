<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .menu-shell {
            max-width: 980px;
            margin: 0 auto;
            position: relative;
        }

        .menu-shell::before,
        .menu-shell::after {
            content: '';
            position: absolute;
            top: -26px;
            width: 150px;
            height: 92px;
            opacity: 0.17;
            background-repeat: no-repeat;
            background-size: contain;
            pointer-events: none;
        }

        .menu-shell::before {
            left: -120px;
            background-image: radial-gradient(circle at 38% 52%, #6a4a34 5px, transparent 6px), radial-gradient(circle at 58% 46%, #6a4a34 5px, transparent 6px), radial-gradient(circle at 50% 60%, #6a4a34 5px, transparent 6px), linear-gradient(140deg, transparent 26%, #6a4a34 27%, #6a4a34 29%, transparent 30%), linear-gradient(30deg, transparent 42%, #6a4a34 43%, #6a4a34 45%, transparent 46%);
        }

        .menu-shell::after {
            right: -120px;
            transform: scaleX(-1);
            background-image: radial-gradient(circle at 38% 52%, #6a4a34 5px, transparent 6px), radial-gradient(circle at 58% 46%, #6a4a34 5px, transparent 6px), radial-gradient(circle at 50% 60%, #6a4a34 5px, transparent 6px), linear-gradient(140deg, transparent 26%, #6a4a34 27%, #6a4a34 29%, transparent 30%), linear-gradient(30deg, transparent 42%, #6a4a34 43%, #6a4a34 45%, transparent 46%);
        }

        .filter-btn {
            border-radius: 0.55rem;
            padding: 0.44rem 0.92rem;
            font-size: 0.84rem;
            font-weight: 700;
            line-height: 1;
            transition: transform 0.22s ease, background-color 0.22s ease, box-shadow 0.22s ease;
        }

        .filter-btn.filter-active {
            background: #ef2f24;
            color: #fff;
            box-shadow: 0 8px 18px rgba(239, 47, 36, 0.28);
        }

        .filter-btn.filter-inactive {
            background: #3a2018;
            color: #fff;
        }

        .filter-btn:hover {
            transform: translateY(-1px);
        }

        .pager-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.75rem;
            margin-top: 1.2rem;
        }

        .pager-btn {
            width: 2.1rem;
            height: 2.1rem;
            border-radius: 999px;
            border: 1px solid rgba(58, 32, 24, 0.2);
            background: #fff7ee;
            color: #3a2018;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .pager-btn:hover:not(:disabled) {
            background: #ef2f24;
            border-color: #ef2f24;
            color: #fff;
            transform: translateY(-1px);
        }

        .pager-btn:disabled {
            opacity: 0.42;
            cursor: not-allowed;
        }

        .pager-info {
            min-width: 130px;
            text-align: center;
            font-size: 0.82rem;
            font-weight: 600;
            color: #4a2d21;
        }

        @media (max-width: 1280px) {
            .menu-shell::before,
            .menu-shell::after {
                display: none;
            }
        }
    </style>
</head>
<body class="font-poppins bg-[#EFE1D1] text-[#3a2a1a] overflow-x-hidden" style="font-family: 'Poppins', sans-serif;">
    @include('partials.navbar')

    <section class="py-24 bg-[#EFE1D1]">
        <div class="menu-shell px-4 sm:px-6">
            <h3 class="text-3xl md:text-4xl font-bold text-center mb-3">Menu Bakso Bunderan Ciomas</h3>
            <p class="text-center mb-9 text-base md:text-lg text-gray-700 max-w-2xl mx-auto">Nikmati berbagai menu bakso kami yang gurih dan lezat</p>

            <div class="flex flex-wrap justify-center gap-3 mb-10">
                <button class="filter-btn filter-active" data-filter="all">Semua</button>
                @foreach(['bakso', 'mie', 'paket', 'minuman'] as $category)
                <button class="filter-btn filter-inactive" data-filter="{{ $category }}">{{ $category == 'mie' ? 'Mie Ayam' : ucfirst($category) }}</button>
                @endforeach
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-5" id="menuContainer">
                @include('partials.menu-items')
            </div>

            <div id="menuPagination" class="pager-wrap">
                <button id="menuPrevPage" type="button" class="pager-btn" aria-label="Halaman sebelumnya">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div id="menuPageInfo" class="pager-info">Halaman 1 dari 1</div>
                <button id="menuNextPage" type="button" class="pager-btn" aria-label="Halaman berikutnya">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script>
        const PAGE_SIZE = 6;
        let currentPage = 1;

        const menuContainer = document.getElementById('menuContainer');
        const paginationWrap = document.getElementById('menuPagination');
        const prevPageBtn = document.getElementById('menuPrevPage');
        const nextPageBtn = document.getElementById('menuNextPage');
        const pageInfo = document.getElementById('menuPageInfo');

        function getMenuItems() {
            if (!menuContainer) return [];
            return Array.from(menuContainer.querySelectorAll('.menu-item'));
        }

        function applyMenuPagination() {
            const items = getMenuItems();
            const totalPages = Math.max(1, Math.ceil(items.length / PAGE_SIZE));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * PAGE_SIZE;
            const end = start + PAGE_SIZE;

            items.forEach((item, index) => {
                item.style.display = index >= start && index < end ? '' : 'none';
            });

            if (pageInfo) {
                pageInfo.textContent = `Halaman ${currentPage} dari ${totalPages}`;
            }

            if (prevPageBtn) {
                prevPageBtn.disabled = currentPage === 1;
            }

            if (nextPageBtn) {
                nextPageBtn.disabled = currentPage === totalPages;
            }

            if (paginationWrap) {
                paginationWrap.classList.toggle('hidden', items.length <= PAGE_SIZE);
            }
        }

        function animateVisibleItems() {
            const items = getMenuItems().filter(item => item.style.display !== 'none');
            items.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(16px)';
                setTimeout(() => {
                    item.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 55);
            });
        }

        if (prevPageBtn) {
            prevPageBtn.addEventListener('click', () => {
                if (currentPage <= 1) return;
                currentPage -= 1;
                applyMenuPagination();
                animateVisibleItems();
            });
        }

        if (nextPageBtn) {
            nextPageBtn.addEventListener('click', () => {
                const totalItems = getMenuItems().length;
                const totalPages = Math.max(1, Math.ceil(totalItems / PAGE_SIZE));
                if (currentPage >= totalPages) return;
                currentPage += 1;
                applyMenuPagination();
                animateVisibleItems();
            });
        }

        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.dataset.filter;

                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('filter-active');
                    btn.classList.add('filter-inactive');
                });
                this.classList.add('filter-active');
                this.classList.remove('filter-inactive');

                if (!menuContainer) return;

                menuContainer.innerHTML = '<div class="col-span-full text-center py-8"><i class="fas fa-spinner fa-spin text-3xl text-red-600"></i><p class="mt-4 text-gray-600">Memuat menu...</p></div>';
                if (paginationWrap) {
                    paginationWrap.classList.add('hidden');
                }
                currentPage = 1;

                fetch(`/filter-menu?category=${filter}`)
                    .then(response => response.json())
                    .then(data => {
                        menuContainer.innerHTML = data.html;
                        applyMenuPagination();
                        animateVisibleItems();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        menuContainer.innerHTML = '<div class="col-span-full text-center py-8 text-red-600"><i class="fas fa-exclamation-triangle text-3xl"></i><p class="mt-4">Terjadi kesalahan saat memuat menu</p></div>';
                    });
            });
        });

        applyMenuPagination();
        animateVisibleItems();
    </script>
</body>
</html>
