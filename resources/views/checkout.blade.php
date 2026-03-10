<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                        'playfair': ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#EFE1D1] text-[#2D3748] font-poppins">
    @include('partials.navbar')

    @php
        $items = $items ?? [];
        $subtotal = $subtotal ?? 0;
    @endphp

    <main class="max-w-5xl mx-auto px-4 sm:px-6 py-10">
        <div class="text-center mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#3a2a1a] tracking-wide">CHECKOUT</h1>
        </div>

        <div class="bg-[#F9EDDE] rounded-2xl shadow p-5 sm:p-8">
            <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 gap-8">
                @csrf

                <section class="space-y-4">
                    <input name="customer_name" required placeholder="Nama Lengkap" class="w-full bg-white rounded-md px-4 py-3 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-600" />
                    <input name="customer_phone" required placeholder="Nomor HP" class="w-full bg-white rounded-md px-4 py-3 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-600" />
                    <input name="customer_email" required type="email" placeholder="Email" class="w-full bg-white rounded-md px-4 py-3 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-600" />
                    <input name="event_name" placeholder="Nama Acara" class="w-full bg-white rounded-md px-4 py-3 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-600" />
                    <input name="event_date" type="date" placeholder="Tanggal Acara" class="w-full bg-white rounded-md px-4 py-3 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-600" />
                    <input name="delivery_time" type="time" placeholder="Jam Pengiriman" class="w-full bg-white rounded-md px-4 py-3 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-600" />
                    <textarea name="delivery_address" rows="3" placeholder="Alamat Lengkap Pengiriman" class="w-full bg-white rounded-md px-4 py-3 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-600 resize-none"></textarea>

                    <select name="delivery_method" class="w-full bg-white rounded-md px-4 py-3 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-600">
                        <option value="">Metode Pengiriman</option>
                        <option value="antar">Antar</option>
                        <option value="pickup">Ambil di Tempat</option>
                    </select>

                    <select name="payment_method" class="w-full bg-white rounded-md px-4 py-3 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-600">
                        <option value="">Metode Pembayaran</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>

                    <textarea name="notes" rows="3" placeholder="Catatan Tambahan" class="w-full bg-white rounded-md px-4 py-3 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-600 resize-none"></textarea>
                </section>

                <section>
                    <div class="text-center font-extrabold text-[#3a2a1a] mb-4">Orderan Kamu</div>

                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="px-4 py-3 border-b border-[#EFE1D1]">
                            <div class="grid grid-cols-3 text-xs font-extrabold text-[#3a2a1a]">
                                <div class="col-span-2">Product</div>
                                <div class="text-right">Subtotal</div>
                            </div>
                        </div>

                        <div class="divide-y divide-[#EFE1D1]">
                            @forelse($items as $item)
                                @php
                                    $lineTotal = ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
                                @endphp
                                <div class="px-4 py-3">
                                    <div class="grid grid-cols-3 gap-3 items-start">
                                        <div class="col-span-2">
                                            <div class="text-sm font-extrabold text-[#3a2a1a]">{{ $item['name'] }}</div>
                                            <div class="text-xs text-gray-600">x{{ (int) ($item['quantity'] ?? 0) }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm font-extrabold text-red-700">Rp {{ number_format((float) $lineTotal, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-4 py-6 text-center text-sm text-gray-600">
                                    Keranjang kosong.
                                </div>
                            @endforelse
                        </div>

                        <div class="px-4 py-4 border-t border-[#EFE1D1]">
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-extrabold text-[#3a2a1a]">Subtotal</span>
                                <span class="font-extrabold text-[#3a2a1a]">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm mt-2">
                                <span class="font-extrabold text-[#3a2a1a]">Total</span>
                                <span class="font-extrabold text-[#3a2a1a]">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <button type="submit" class="bg-red-600 text-white px-10 py-2.5 rounded-md font-extrabold shadow hover:bg-red-700 transition">Order Now</button>
                    </div>
                </section>
            </form>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('cart.index') }}" class="text-sm font-semibold text-red-700 hover:underline">Kembali ke Keranjang</a>
        </div>
    </main>
</body>
</html>
