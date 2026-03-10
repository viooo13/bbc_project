<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang BBC - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="font-poppins bg-[#EFE1D1] text-[#3a2a1a] overflow-x-hidden">
    @include('partials.navbar')

    <section class="py-12 md:py-20 bg-[#EFE1D1]">
        <div class="max-w-7xl mx-auto px-6 space-y-8 md:space-y-12">
            <div class="bg-[#F9EDDE] rounded-3xl shadow-lg overflow-hidden fade-up">
                <div class="grid md:grid-cols-2 gap-6 md:gap-8 items-center p-6 sm:p-8 md:p-12">
                    <div class="flex justify-center order-1 md:order-1">
                        <img src="https://placehold.co/520x360/efe1d1/3a2a1a?text=About+Image" alt="Bakso Bunderan Ciomas" class="w-full h-auto rounded-2xl shadow-lg max-w-sm">
                    </div>

                    <div class="order-2 md:order-2">
                        <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-[#3a2a1a] flex items-center gap-2 font-poopins">
                            BAKSO BUNDERAN CIOMAS
                            <img src="logo.jpeg" alt="Logo" class="w-8 h-8 object-contain" />
                        </h3>
                        <p class="text-gray-700 mb-4 leading-relaxed text-justify font-poppins">
                            Berdiri sejak 12 Februari 2025 yang lalu setiap hari melayani pelanggan setia di Diaol & Grobak. Kami menghadirkan Bakso Tulang & Sum-sum dengan bumbu rahasia dan cita rasa yang autentik. Dari influencer hingga pengusaha cita mulai dikenal semua kalangan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-[#F9EDDE] rounded-3xl shadow-lg overflow-hidden fade-up">
                <div class="grid md:grid-cols-2 gap-6 md:gap-8 items-center p-6 sm:p-8 md:p-12">
                    <div class="order-2 md:order-1">
                        <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-[#3a2a1a] flex items-center gap-2 font-poopins">
                            BAKSO BUNDERAN CIOMAS
                            <img src="logo.jpeg" alt="Logo" class="w-8 h-8 object-contain" />
                        </h3>
                        <p class="text-gray-700 mb-4 leading-relaxed text-justify font-poppins">
                            Setiap porsi bakso kami dibuat dengan dedikasi penuh menggunakan bahan-bahan pilihan berkualitas tinggi. Proses produksi yang ketat memastikan setiap bakso yang kami sajikan memiliki cita rasa yang konsisten, tekstur yang sempurna, dan selalu higienis. Kepuasan pelanggan adalah prioritas utama kami.
                        </p>
                    </div>

                    <div class="flex justify-center order-1 md:order-2">
                        <img src="https://placehold.co/520x360/efe1d1/3a2a1a?text=About+Image" alt="Bakso Bunderan Ciomas" class="w-full h-auto rounded-2xl shadow-lg max-w-sm">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-[#EFE1D1]">
        <div class="max-w-5xl mx-auto px-6">
            <div class="relative bg-[#EFE1D1]">
                <div class="relative text-center">
                    <div class="flex justify-center mb-4">
                        <img src="{{ asset('halal.jpeg') }}" onerror="this.onerror=null;this.src='https://placehold.co/160x80/efe1d1/3a2a1a?text=Halal';" alt="Halal" class="w-24 sm:w-28 h-auto" />
                    </div>
                    <p class="text-sm md:text-base text-gray-700 max-w-3xl mx-auto leading-relaxed">
                        Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen boo
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 md:py-32 bg-[#EFE1D1]">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-4xl font-bold mb-10">REVIEW</h3>

            <div class="mt-10">
                <h4 class="text-center font-extrabold tracking-wide text-lg md:text-xl">TESTIMONI INFLUENCER</h4>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                    <div class="bg-transparent">
                        <div class="relative rounded-xl overflow-hidden shadow-md bg-white">
                            <img src="{{ asset('tanboy.jpeg') }}" alt="Influencer" class="w-full h-52 md:h-56 object-cover" />
                            <div class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded">
                                BUSET!! Apaan nih??
                            </div>
                        </div>
                        <div class="mt-4 flex justify-center">
                            <a href="https://www.youtube.com" target="_blank" rel="noopener" class="bg-red-600 text-white text-xs font-bold px-6 py-2 rounded-full hover:bg-red-700 transition">See on Youtube</a>
                        </div>
                    </div>

                    <div class="bg-transparent">
                        <div class="relative rounded-xl overflow-hidden shadow-md bg-white">
                            <img src="{{ asset('testimoni2.jpeg') }}" alt="Influencer" class="w-full h-52 md:h-56 object-cover" />
                        </div>
                        <div class="mt-4 flex justify-center">
                            <a href="https://www.youtube.com" target="_blank" rel="noopener" class="bg-red-600 text-white text-xs font-bold px-6 py-2 rounded-full hover:bg-red-700 transition">See on Youtube</a>
                        </div>
                    </div>

                    <div class="bg-transparent">
                        <div class="relative rounded-xl overflow-hidden shadow-md bg-white">
                            <img src="{{ asset('testimoni3.jpeg') }}" alt="Influencer" class="w-full h-52 md:h-56 object-cover" />
                        </div>
                        <div class="mt-4 flex justify-center">
                            <a href="https://www.youtube.com" target="_blank" rel="noopener" class="bg-red-600 text-white text-xs font-bold px-6 py-2 rounded-full hover:bg-red-700 transition">See on Youtube</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-14">
                <h4 class="text-center font-extrabold tracking-wide text-lg md:text-xl">ULASAN</h4>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="daftarTestimoni">
                    @if(isset($testimonials) && $testimonials->count() > 0)
                        @foreach($testimonials as $testimonial)
                            <div class="bg-[#F9EDDE] p-6 rounded-xl shadow-md hover:shadow-lg transition">
                                <div class="flex items-center justify-between">
                                    <div class="font-extrabold text-sm text-[#3a2a1a]">{{ $testimonial->customer_name }}</div>
                                    <div class="text-amber-500 text-sm font-semibold">
                                        @for($i = 0; $i < 5; $i++)
                                            @if($i < $testimonial->rating) ★ @else ☆ @endif
                                        @endfor
                                    </div>
                                </div>
                                <p class="mt-3 text-xs text-gray-700 leading-relaxed">{{ $testimonial->content }}</p>
                                @if($testimonial->admin_reply)
                                    <div class="mt-4 p-3 bg-red-50 rounded-lg border-l-4 border-red-600">
                                        <p class="text-sm font-semibold text-red-600 mb-1">Balasan:</p>
                                        <p class="text-sm text-gray-700">{{ $testimonial->admin_reply }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-full text-center text-gray-700">
                            <div class="bg-[#F9EDDE] rounded-2xl p-10 shadow">
                                <h4 class="text-2xl font-bold mb-2">Belum ada ulasan</h4>
                                <p class="text-sm">Ulasan akan tampil setelah ada testimoni dari pelanggan.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
</body>
</html>
