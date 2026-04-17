<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    @php
        $items = is_array($pesanan->items ?? null) ? $pesanan->items : [];
        $subtotal = (float) ($pesanan->total_price ?? 0);

        $totalQty = 0;
        foreach ($items as $it) {
            $totalQty += (int) ($it['quantity'] ?? 0);
        }

        $status = (string) ($pesanan->status ?? 'pending');

        $stepPending = true;
        $stepConfirmed = in_array($status, ['pending', 'confirmed', 'shipped', 'completed'], true);
        $stepShipped = in_array($status, ['shipped', 'completed'], true);
        $stepCompleted = $status === 'completed';

        $statusTitle = 'Menunggu Pembayaran';
        if ($status === 'confirmed') $statusTitle = 'Menunggu Pembayaran';
        if ($status === 'shipped') $statusTitle = 'Sedang Diproses';
        if ($status === 'completed') $statusTitle = 'Transaksi Selesai';
        if ($status === 'rejected') $statusTitle = 'Pesanan Ditolak';

        $statusDescription = 'Silakan lakukan pembayaran untuk melanjutkan proses pesanan.';
        if ($status === 'confirmed') {
            $statusDescription = 'Silakan lakukan pembayaran untuk melanjutkan proses pesanan.';
        }
        if ($status === 'rejected') {
            $statusDescription = 'Pesanan kamu ditolak oleh admin. Silakan hubungi penjual untuk informasi lebih lanjut.';
        }

        $special = [];
        if (!empty($pesanan->special_request)) {
            if (is_array($pesanan->special_request)) {
                $special = $pesanan->special_request;
            } elseif (is_string($pesanan->special_request)) {
                $decoded = json_decode($pesanan->special_request, true);
                if (is_array($decoded)) $special = $decoded;
            }
        }
    @endphp

    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
        <div class="mb-4">
            <h1 class="text-3xl font-extrabold text-[#3a2a1a]">TRANSAKSI</h1>
        </div>

        <section class="bg-[#F9EDDE] rounded-xl shadow overflow-hidden">
            <div class="px-6 py-7 {{ $status === 'confirmed' ? 'bg-[#58A9D6]' : 'bg-white' }}">
                <div class="flex flex-col items-center justify-center">
                    @if($status === 'completed')
                        <img src="/selesai.jpeg" class="w-full max-w-md h-auto" />
                    @elseif($status === 'confirmed' || $status === 'pending')
                        <img src="/pembayaran.jpeg" class="w-full max-w-md h-auto" />
                    @else
                        <img src="/konfirmasi.jpeg" class="w-full max-w-md h-auto" />
                    @endif
                    <div class="mt-4 text-sm font-extrabold {{ $status === 'confirmed' ? 'text-[#3a2a1a]' : 'text-[#3a2a1a]' }}">{{ strtoupper($statusTitle) }}</div>
                </div>
            </div>

            <div class="px-6 py-6">
                <div class="text-xs font-extrabold text-[#3a2a1a] mb-3">PROGRES TRANSAKSI</div>

                <div class="relative">
                    <div class="absolute left-0 right-0 top-[10px] h-[2px] bg-black/20"></div>
                    <div class="grid grid-cols-4 gap-0 relative">
                        <div class="flex flex-col items-center">
                            <div class="w-5 h-5 rounded-full {{ $stepPending ? 'bg-green-500' : 'bg-black' }}"></div>
                            <div class="mt-2 text-[10px] font-extrabold text-[#3a2a1a]">TRANSAKSI DIBUAT</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-5 h-5 rounded-full {{ $stepConfirmed ? 'bg-green-500' : 'bg-black' }}"></div>
                            <div class="mt-2 text-[10px] font-extrabold text-[#3a2a1a]">PEMBAYARAN</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-5 h-5 rounded-full {{ $stepShipped ? 'bg-green-500' : 'bg-black' }}"></div>
                            <div class="mt-2 text-[10px] font-extrabold text-[#3a2a1a]">SEDANG DIPROSES</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-5 h-5 rounded-full {{ $stepCompleted ? 'bg-green-500' : 'bg-black' }}"></div>
                            <div class="mt-2 text-[10px] font-extrabold text-[#3a2a1a]">TRANSAKSI SELESAI</div>
                        </div>
                    </div>
                </div>

                @if($status === 'completed')
                    <div class="mt-8">
                        <div class="text-center">
                            <div class="text-xl font-extrabold text-[#3a2a1a]">TRANSAKSI SELESAI</div>
                        </div>

                        <div class="mt-5 bg-white rounded-xl shadow-sm p-6">
                            <div class="font-extrabold text-[#3a2a1a]">TRANSAKSI SELESAI</div>
                            <p class="mt-3 text-xs text-gray-700 leading-relaxed">Terima kasih sudah order di Bakso Bunderan Ciomas! Pesanan Anda sudah kami terima dan selesai. Yuk, bantu kami berkembang dengan memberikan rating & ulasan. Pendapat Anda sangat berarti buat kami!</p>
                        </div>

                        <div class="mt-6 bg-white rounded-xl shadow-sm p-6">
                            <div class="text-xs font-extrabold text-[#3a2a1a] mb-3">BERI RATING & REVIEW</div>

                            <form method="POST" action="{{ route('testimonial.store') }}" class="space-y-3">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $pesanan->order_id }}" />
                                <input type="hidden" name="customer_name" value="{{ $pesanan->customer_name }}" />

                                <input type="hidden" name="rating" id="ratingValue" value="5" />

                                <div>
                                    <div class="flex items-center gap-1 text-2xl text-amber-500">
                                        <button type="button" class="leading-none" onclick="setRating(1)" aria-label="1 star">★</button>
                                        <button type="button" class="leading-none" onclick="setRating(2)" aria-label="2 stars">★</button>
                                        <button type="button" class="leading-none" onclick="setRating(3)" aria-label="3 stars">★</button>
                                        <button type="button" class="leading-none" onclick="setRating(4)" aria-label="4 stars">★</button>
                                        <button type="button" class="leading-none" onclick="setRating(5)" aria-label="5 stars">★</button>
                                    </div>
                                    <div class="text-[11px] text-gray-500 mt-1">Klik bintang untuk memberi rating</div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-extrabold text-[#3a2a1a] mb-1">Ulasan</label>
                                    <textarea name="content" rows="4" class="w-full bg-[#F9EDDE] px-4 py-2 rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-red-500 transition resize-none" placeholder="Deskripsikan pengalaman Anda"></textarea>
                                </div>

                                <button type="submit" class="inline-flex items-center justify-center bg-red-600 text-white w-full py-2.5 rounded-lg font-extrabold hover:bg-red-700 transition">Kirim Ulasan</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="mt-8">
                        <div class="text-xs font-extrabold text-[#3a2a1a] mb-3">RINCIAN PEMBAYARAN</div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="bg-white rounded-xl shadow-sm p-5">
                                <div class="space-y-3 text-sm text-[#3a2a1a]">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold">Jumlah</span>
                                        <span class="font-extrabold">{{ $totalQty }}x</span>
                                    </div>
                                    <div class="flex items-start justify-between gap-4">
                                        <span class="font-semibold">Harga</span>
                                        <div class="text-right font-extrabold">
                                            @foreach($items as $it)
                                                <div>Rp {{ number_format((float) ($it['price'] ?? 0), 0, ',', '.') }}</div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="pt-4 border-t border-[#EFE1D1]">
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold">Subtotal</span>
                                            <span class="font-extrabold">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex items-center justify-between mt-2">
                                            <span class="font-semibold">Total Pembayaran</span>
                                            <span class="font-extrabold">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl shadow-sm p-5">
                                @if($status === 'pending' || $status === 'confirmed')
                                    <div class="space-y-3 text-sm text-[#3a2a1a]">
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold">Metode Pembayaran</span>
                                            <span class="font-extrabold">QRIS (ALL Payment)</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold">Status Pembayaran</span>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-extrabold bg-pink-100 text-pink-700">Unpaid</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold">Status Transaksi</span>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-extrabold bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>

                                        <div class="pt-2">
                                            <button type="button" onclick="openQrisModal()" class="inline-flex items-center justify-center bg-red-600 text-white w-full py-2.5 rounded-lg font-extrabold hover:bg-red-700 transition">Klik di sini untuk melakukan pembayaran</button>
                                        </div>

                                        <div class="pt-2">
                                            <form method="POST" action="{{ route('transaksi.transfer.notify', ['orderId' => $pesanan->order_id]) }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center justify-center bg-[#3a2a1a] text-[#EFE1D1] w-full py-2.5 rounded-lg font-extrabold hover:opacity-95 transition">
                                                    Saya sudah transfer
                                                </button>
                                            </form>
                                            <div class="mt-2 text-[11px] text-gray-600">Setelah transfer, klik tombol ini agar admin mendapat notifikasi WhatsApp otomatis.</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="font-extrabold text-[#3a2a1a]">{{ $statusTitle }}</div>
                                    <p class="mt-3 text-xs text-gray-700 leading-relaxed">{{ $statusDescription }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <div id="qrisModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 px-4">
            <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden">
                <div class="px-5 py-4 flex items-center justify-between border-b border-gray-100">
                    <div class="font-extrabold text-[#3a2a1a]">QRIS Pembayaran</div>
                    <button type="button" onclick="closeQrisModal()" class="text-gray-500 hover:text-gray-800 text-xl leading-none">&times;</button>
                </div>
                <div class="p-5">
                    <img src="/qriss.jpeg" alt="QRIS" class="w-full h-auto rounded-xl border" />
                    <div class="mt-4 text-xs text-gray-600">Scan QRIS di atas untuk pembayaran (dummy).</div>
                </div>
                <div class="px-5 pb-5">
                    <button type="button" onclick="closeQrisModal()" class="w-full bg-[#3a2a1a] text-[#EFE1D1] py-2.5 rounded-lg font-extrabold hover:opacity-95 transition">Tutup</button>
                </div>
            </div>
        </div>

        <footer class="bg-[#3a2a1a] text-[#EFE1D1] mt-4 border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-5 items-start">
                    <div class="flex items-center gap-3">
                        <img src="/logo.jpeg" alt="Bakso Bunderan Ciomas" class="w-9 h-9 rounded-full object-contain bg-[#EFE1D1] p-1" />
                        <div class="leading-tight">
                            <div class="text-[11px] font-extrabold tracking-wide">BAKSO BUNDERAN</div>
                            <div class="text-[11px] font-extrabold tracking-wide">CIOMAS BBC</div>
                        </div>
                    </div>

                    <div class="text-[9.5px] leading-relaxed">
                        <div class="text-[10.5px] font-extrabold mb-1">Alamat</div>
                        <div>Jl. Vihara Ciomas, Ciomas</div>
                        <div>Rahayu, Kec. Ciomas,</div>
                        <div>Kabupaten Bogor, Jawa Barat</div>
                        <div>16610</div>
                    </div>

                    <div class="text-[9.5px]">
                        <div class="text-[10.5px] font-extrabold mb-1">Media Sosial</div>
                        <div class="flex items-center gap-2.5">
                            <a href="#" class="inline-flex w-7.5 h-7.5 items-center justify-center rounded-lg bg-white/10 hover:bg-white/15 transition" aria-label="Instagram">
                                <i class="fab fa-instagram text-[13px]"></i>
                            </a>
                            <a href="#" class="inline-flex w-7.5 h-7.5 items-center justify-center rounded-lg bg-white/10 hover:bg-white/15 transition" aria-label="Facebook">
                                <i class="fab fa-facebook text-[13px]"></i>
                            </a>
                            <a href="#" class="inline-flex w-7.5 h-7.5 items-center justify-center rounded-lg bg-white/10 hover:bg-white/15 transition" aria-label="TikTok">
                                <i class="fab fa-tiktok text-[13px]"></i>
                            </a>
                        </div>
                    </div>

                    <div class="text-[9.5px] leading-relaxed">
                        <div class="text-[10.5px] font-extrabold mb-1">Kontak</div>
                        <a href="https://wa.me/6282123368495" target="_blank" rel="noopener noreferrer" class="block font-semibold hover:text-white transition">0812123368495</a>
                        <div>baksobunderan</div>
                        <div>baksobunderan@gmail.com</div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <script>
        function openQrisModal() {
            const modal = document.getElementById('qrisModal');
            if (!modal) return;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeQrisModal() {
            const modal = document.getElementById('qrisModal');
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('qrisModal');
            if (!modal) return;
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeQrisModal();
            });
        });

        function setRating(value) {
            const input = document.getElementById('ratingValue');
            if (!input) return;
            input.value = String(value);
        }
    </script>
</body>
</html>
