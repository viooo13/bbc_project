<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi & Kontak - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="font-poppins bg-[#EFE1D1] text-[#3a2a1a] overflow-x-hidden">
    @include('partials.navbar')

    <section class="py-16 bg-[#EFE1D1]">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-4xl font-bold text-center mb-10">LOKASI</h3>
            <div class="w-full h-[420px] overflow-hidden rounded-2xl shadow">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.1234567890!2d106.7890123!3d-6.5678901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5f2e5f2e5f2%3A0x1234567890abcdef!2sBakso+Bunderan+Ciomas!5e0!3m2!1sen!2sid!4v1234567890"
                    class="w-full h-full border-0" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <section class="py-16 bg-[#EFE1D1]">
        <div class="max-w-xl mx-auto px-6">
            <h3 class="text-4xl font-bold text-center mb-10">KONTAK KAMI</h3>

            @if(session('contact_success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-lg mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-xl"></i>
                    <span class="font-medium">{{ session('contact_success') }}</span>
                </div>
            </div>
            @endif

            @if(session('contact_error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-lg mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                    <span class="font-medium">{{ session('contact_error') }}</span>
                </div>
            </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="bg-[#EFE1D1] rounded-2xl p-0">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-gray-800 font-extrabold tracking-wide text-sm mb-2">NAMA</label>
                        <input type="text" name="name" required
                               class="w-full bg-[#F9EDDE] px-4 py-3 rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                    </div>

                    <div>
                        <label class="block text-gray-800 font-extrabold tracking-wide text-sm mb-2">EMAIL</label>
                        <input type="email" name="email" required
                               class="w-full bg-[#F9EDDE] px-4 py-3 rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                    </div>

                    <div>
                        <label class="block text-gray-800 font-extrabold tracking-wide text-sm mb-2">NOMOR WA</label>
                        <input type="tel" name="phone" required
                               class="w-full bg-[#F9EDDE] px-4 py-3 rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                    </div>

                    <div>
                        <label class="block text-gray-800 font-extrabold tracking-wide text-sm mb-2">PESAN</label>
                        <textarea name="message" rows="6" required
                                  class="w-full bg-[#F9EDDE] px-4 py-3 rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-red-500 transition resize-none"></textarea>
                    </div>

                    <div class="text-center pt-2">
                        <button type="submit" class="bg-red-600 text-white px-10 py-3 rounded-lg font-semibold hover:bg-red-700 transition">
                            Kirim
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @include('partials.footer')
</body>
</html>
