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
</head>
<body class="font-poppins bg-[#EFE1D1] text-[#3a2a1a] overflow-x-hidden">
    @include('partials.navbar')

    <section class="py-32 bg-[#EFE1D1]">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-4xl font-bold text-center mb-6">Menu Bakso Bunderan Ciomas</h3>
            <p class="text-center mb-12 text-lg text-gray-700">Nikmati berbagai menu bakso lezat kami yang gurih dan menggugah selera</p>

            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button class="filter-btn active bg-red-700 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-red-800 transition" data-filter="all">Bakso</button>
                @foreach(['bakso', 'mie', 'paket', 'minuman'] as $category)
                <button class="filter-btn bg-[#3a2a1a] text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-[#2b1b14] transition" data-filter="{{ $category }}">{{ $category == 'mie' ? 'Mie Ayam' : ucfirst($category) }}</button>
                @endforeach
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6" id="menuContainer">
                @include('partials.menu-items')
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script>
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.dataset.filter;

                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('active', 'bg-red-600', 'text-white');
                    btn.classList.add('bg-gray-300', 'text-gray-700');
                });
                this.classList.add('active', 'bg-red-600', 'text-white');

                const menuContainer = document.getElementById('menuContainer');
                if (!menuContainer) return;

                menuContainer.innerHTML = '<div class="col-span-2 text-center py-8"><i class="fas fa-spinner fa-spin text-3xl text-red-600"></i><p class="mt-4 text-gray-600">Memuat menu...</p></div>';

                fetch(`/filter-menu?category=${filter}`)
                    .then(response => response.json())
                    .then(data => {
                        menuContainer.innerHTML = data.html;

                        const items = menuContainer.querySelectorAll('.menu-item');
                        items.forEach((item, index) => {
                            item.style.opacity = '0';
                            item.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                                item.style.opacity = '1';
                                item.style.transform = 'translateY(0)';
                            }, index * 100);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        menuContainer.innerHTML = '<div class="col-span-2 text-center py-8 text-red-600"><i class="fas fa-exclamation-triangle text-3xl"></i><p class="mt-4">Terjadi kesalahan saat memuat menu</p></div>';
                    });
            });
        });
    </script>
</body>
</html>
