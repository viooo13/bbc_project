<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#EFE1D1] text-[#2D3748] font-poppins">
    @include('partials.navbar')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#3a2a1a]">Keranjang</h1>
                <p class="text-sm text-gray-700 mt-1">Periksa pesananmu sebelum lanjut.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="bg-white/80 text-[#3a2a1a] px-4 py-2 rounded-xl font-semibold shadow hover:bg-white transition">Kembali</a>
                <button type="button" onclick="clearCart()" class="bg-[#3a2a1a] text-[#EFE1D1] px-4 py-2 rounded-xl font-semibold shadow hover:opacity-95 transition">Kosongkan</button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <section class="lg:col-span-2 space-y-4">
                @php
                    $items = $items ?? [];
                    $subtotal = $subtotal ?? 0;
                @endphp

                @if(count($items) === 0)
                    <div class="bg-[#F9EDDE] rounded-2xl shadow p-10 text-center">
                        <div class="text-[#3a2a1a] text-4xl mb-3"><i class="fas fa-shopping-basket"></i></div>
                        <h2 class="text-xl font-extrabold text-[#3a2a1a]">Keranjang kamu masih kosong</h2>
                        <p class="text-sm text-gray-700 mt-2">Yuk pilih menu atau paket favoritmu dulu.</p>
                        <div class="mt-6">
                            <a href="{{ route('home') }}#paket" class="inline-flex items-center justify-center bg-red-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-red-700 transition">Lihat Paket</a>
                        </div>
                    </div>
                @else
                    @foreach($items as $item)
                        @php
                            $lineTotal = ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
                            $img = $item['image'] ?? null;
                        @endphp
                        <div class="bg-[#F9EDDE] rounded-2xl shadow p-4 sm:p-5">
                            <div class="flex gap-4">
                                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl overflow-hidden bg-[#EFE1D1] shrink-0">
                                    @if($img)
                                        <img src="{{ $img }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover" />
                                    @else
                                        <img src="https://placehold.co/200x200/f9edde/3a2a1a?text=Item" alt="{{ $item['name'] }}" class="w-full h-full object-cover" />
                                    @endif
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <h3 class="font-extrabold text-[#3a2a1a] leading-snug truncate">{{ $item['name'] }}</h3>
                                                <span class="shrink-0 text-[10px] font-bold px-2 py-0.5 rounded-full {{ ($item['type'] ?? '') === 'paket' ? 'bg-red-700 text-white' : 'bg-[#3a2a1a] text-[#EFE1D1]' }}">
                                                    {{ strtoupper($item['type'] ?? '') }}
                                                </span>
                                            </div>
                                            <div class="text-sm font-extrabold text-red-700 mt-1">Rp {{ number_format((float) ($item['price'] ?? 0), 0, ',', '.') }}</div>
                                        </div>

                                        <button type="button" onclick="removeItem('{{ $item['key'] }}')" class="text-gray-500 hover:text-red-700 transition" aria-label="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                        <div class="inline-flex items-center rounded-xl bg-white px-2 py-2 shadow-sm w-fit">
                                            <button type="button" onclick="changeQty('{{ $item['key'] }}', -1)" class="w-9 h-9 rounded-lg bg-[#EFE1D1] text-[#3a2a1a] font-extrabold hover:opacity-90 transition">-</button>
                                            <input id="qty-{{ $item['key'] }}" type="number" min="1" value="{{ (int) ($item['quantity'] ?? 1) }}" class="w-16 text-center bg-transparent font-bold text-[#3a2a1a] focus:outline-none" onchange="setQty('{{ $item['key'] }}', this.value)" />
                                            <button type="button" onclick="changeQty('{{ $item['key'] }}', 1)" class="w-9 h-9 rounded-lg bg-[#EFE1D1] text-[#3a2a1a] font-extrabold hover:opacity-90 transition">+</button>
                                        </div>

                                        <div class="text-right">
                                            <div class="text-xs text-gray-600">Total</div>
                                            <div class="font-extrabold text-[#3a2a1a]">Rp {{ number_format((float) $lineTotal, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </section>

            <aside class="lg:col-span-1">
                <div class="bg-[#F9EDDE] rounded-2xl shadow p-6 sticky top-24">
                    <h2 class="text-lg font-extrabold text-[#3a2a1a]">Ringkasan</h2>
                    <div class="mt-4 space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">Subtotal</span>
                            <span class="font-extrabold text-[#3a2a1a]">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">Biaya lain</span>
                            <span class="font-semibold text-gray-700">Rp 0</span>
                        </div>
                        <div class="h-px bg-[#EFE1D1] my-3"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 font-extrabold">Total</span>
                            <span class="font-extrabold text-red-700">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">
                        <a href="{{ route('home') }}#menu" class="w-full inline-flex items-center justify-center bg-white text-[#3a2a1a] px-4 py-3 rounded-xl font-semibold shadow hover:bg-white/90 transition">
                            Tambah Menu
                        </a>
                        <a href="{{ route('checkout.index') }}" class="w-full inline-flex items-center justify-center bg-red-600 text-white px-4 py-3 rounded-xl font-extrabold shadow hover:bg-red-700 transition">
                            Lanjut Checkout
                        </a>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Checkout masih sederhana. Nanti bisa disambungkan ke WhatsApp / pembayaran.
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <script>
        function csrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        }

        function postJson(url, body) {
            return fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken(),
                },
                body: JSON.stringify(body || {}),
            });
        }

        function updateCartCountBadge() {
            fetch('/api/cart-count')
                .then(r => r.json())
                .then(data => {
                    const cartCount = document.getElementById('cartCount');
                    if (cartCount) cartCount.textContent = data.count;
                });
        }

        function changeQty(key, delta) {
            const input = document.getElementById(`qty-${key}`);
            if (!input) return;
            const next = Math.max(1, (parseInt(input.value || '1', 10) + delta));
            input.value = next;
            setQty(key, next);
        }

        function setQty(key, qty) {
            const quantity = Math.max(1, parseInt(qty || '1', 10));
            postJson('{{ route('cart.update') }}', { key, quantity })
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then(() => {
                    updateCartCountBadge();
                    window.location.reload();
                })
                .catch(() => window.location.reload());
        }

        function removeItem(key) {
            postJson('{{ route('cart.remove') }}', { key })
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then(() => {
                    updateCartCountBadge();
                    window.location.reload();
                })
                .catch(() => window.location.reload());
        }

        function clearCart() {
            postJson('{{ route('cart.clear') }}')
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then(() => {
                    updateCartCountBadge();
                    window.location.reload();
                })
                .catch(() => window.location.reload());
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateCartCountBadge();
        });
    </script>
</body>
</html>
