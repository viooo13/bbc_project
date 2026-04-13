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
    <style>
        body, h1, h2, h3, h4, h5, h6, p, span, a, li, ul, ol, button, input, textarea, div {
            font-family: 'Poppins', sans-serif !important;
        }
        .font-playfair { font-family: 'Poppins', sans-serif !important; }

        .fade-up {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .js .fade-up {
            opacity: 0;
            transform: translateY(30px);
        }
        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .hero-panel {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #fff8ef 0%, #f7dfcf 100%);
            border: 1px solid rgba(139, 0, 0, 0.08);
        }

        .hero-panel::before,
        .hero-panel::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
            filter: blur(2px);
            opacity: 0.85;
        }

        .hero-panel::before {
            width: 220px;
            height: 220px;
            top: -80px;
            right: -70px;
            background: radial-gradient(circle at 35% 35%, rgba(239, 47, 36, 0.18), rgba(239, 47, 36, 0));
        }

        .hero-panel::after {
            width: 160px;
            height: 160px;
            bottom: -60px;
            left: -40px;
            background: radial-gradient(circle at 35% 35%, rgba(139, 0, 0, 0.12), rgba(139, 0, 0, 0));
        }

        .info-card {
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(139, 0, 0, 0.08);
            box-shadow: 0 12px 26px rgba(58, 32, 24, 0.08);
            backdrop-filter: blur(12px);
        }

        .info-icon {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 999px;
            background: rgba(239, 47, 36, 0.12);
            color: #ef2f24;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
        }

        .section-title {
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #8b0000;
        }

        .map-frame {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            box-shadow: 0 18px 36px rgba(58, 32, 24, 0.16);
            border: 1px solid rgba(139, 0, 0, 0.08);
        }

        .map-frame::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(0,0,0,0));
            pointer-events: none;
        }

        .contact-form-card {
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(139, 0, 0, 0.08);
            box-shadow: 0 16px 34px rgba(58, 32, 24, 0.12);
            backdrop-filter: blur(14px);
        }

        .contact-input {
            width: 100%;
            background: rgba(249, 237, 222, 0.82);
            border: 1px solid rgba(139, 0, 0, 0.12);
            border-radius: 0.95rem;
            padding: 0.9rem 1rem;
            outline: none;
            transition: box-shadow 0.25s ease, border-color 0.25s ease, transform 0.25s ease, background-color 0.25s ease;
        }

        .contact-input:focus {
            border-color: rgba(239, 47, 36, 0.55);
            box-shadow: 0 0 0 4px rgba(239, 47, 36, 0.1);
            background: rgba(255, 247, 242, 0.95);
        }

        .contact-btn {
            background: linear-gradient(135deg, #ef2f24 0%, #c81f17 100%);
            box-shadow: 0 12px 24px rgba(239, 47, 36, 0.24);
            transition: transform 0.25s ease, box-shadow 0.25s ease, filter 0.25s ease;
        }

        .contact-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 28px rgba(239, 47, 36, 0.3);
            filter: brightness(1.02);
        }

        .floating-badge {
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(139, 0, 0, 0.08);
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 24px rgba(58, 32, 24, 0.08);
        }
    </style>
</head>
<body class="js font-poppins bg-[#EFE1D1] text-[#3a2a1a] overflow-x-hidden">
    @include('partials.navbar')

    <section class="py-14 md:py-20 bg-[#EFE1D1]">
        <div class="max-w-7xl mx-auto px-5 sm:px-6">
            <div class="hero-panel fade-up rounded-[2rem] p-6 sm:p-8 md:p-10 lg:p-12 mb-8 md:mb-10">
                <div class="grid lg:grid-cols-2 gap-8 lg:gap-10 items-center relative z-10">
                    <div class="fade-up">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/75 border border-[#f0d3c3] text-[#8b0000] text-xs font-extrabold tracking-[0.14em] uppercase mb-4">
                            <i class="fas fa-location-dot"></i>
                            Lokasi & Kontak
                        </div>
                        <h3 class="text-3xl md:text-5xl font-extrabold leading-tight text-[#3a2a1a] mb-4">
                            Temukan kami di Ciomas dan hubungi kapan saja.
                        </h3>
                        <p class="text-sm md:text-base text-[#5a4133] leading-relaxed max-w-xl">
                            Kami siap melayani pesanan, pertanyaan, dan kerja sama. Silakan lihat lokasi kami, kirim pesan, atau hubungi langsung lewat kontak yang tersedia.
                        </p>

                        <div class="grid sm:grid-cols-3 gap-3 mt-6">
                            <div class="info-card rounded-2xl p-4">
                                <div class="info-icon mb-3"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="text-sm font-bold text-[#3a2a1a]">Lokasi</div>
                                <div class="text-xs text-[#6e5547] mt-1">Bakso Bunderan Ciomas</div>
                            </div>
                            <div class="info-card rounded-2xl p-4">
                                <div class="info-icon mb-3"><i class="fas fa-phone-alt"></i></div>
                                <div class="text-sm font-bold text-[#3a2a1a]">Telepon</div>
                                <div class="text-xs text-[#6e5547] mt-1">Hubungi via WhatsApp</div>
                            </div>
                            <div class="info-card rounded-2xl p-4">
                                <div class="info-icon mb-3"><i class="fas fa-clock"></i></div>
                                <div class="text-sm font-bold text-[#3a2a1a]">Jam Buka</div>
                                <div class="text-xs text-[#6e5547] mt-1">Setiap hari</div>
                            </div>
                        </div>
                    </div>

                    <div class="relative fade-up">
                        <div class="floating-badge absolute -top-3 -left-3 z-20 rounded-2xl px-4 py-3">
                            <div class="text-xs font-bold text-[#8b0000] uppercase tracking-[0.12em]">Lokasi Utama</div>
                            <div class="text-sm font-extrabold text-[#3a2a1a]">Bakso Bunderan Ciomas</div>
                        </div>
                        <div class="map-frame h-[330px] sm:h-[380px] lg:h-[420px]">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.1234567890!2d106.7890123!3d-6.5678901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5f2e5f2e5f2%3A0x1234567890abcdef!2sBakso+Bunderan+Ciomas!5e0!3m2!1sen!2sid!4v1234567890"
                                class="w-full h-full border-0"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-6 md:py-10 bg-[#EFE1D1]">
        <div class="max-w-4xl mx-auto px-5 sm:px-6">
            <h3 class="section-title text-center text-xs sm:text-sm font-extrabold mb-3">Kontak Kami</h3>
            <h4 class="text-3xl md:text-4xl font-bold text-center mb-8 text-[#3a2a1a]">Kirim pesan langsung</h4>

            @if(session('contact_success'))
            <div class="info-card border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-xl"></i>
                    <span class="font-medium">{{ session('contact_success') }}</span>
                </div>
            </div>
            @endif

            @if(session('contact_error'))
            <div class="info-card border-red-200 text-red-700 px-6 py-4 rounded-2xl mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                    <span class="font-medium">{{ session('contact_error') }}</span>
                </div>
            </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="contact-form-card rounded-[2rem] p-5 sm:p-6 md:p-8">
                @csrf
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-[#3a2a1a] font-extrabold tracking-wide text-xs mb-2 uppercase">Nama</label>
                        <input type="text" name="name" required class="contact-input">
                    </div>

                    <div>
                        <label class="block text-[#3a2a1a] font-extrabold tracking-wide text-xs mb-2 uppercase">Email</label>
                        <input type="email" name="email" required class="contact-input">
                    </div>

                    <div>
                        <label class="block text-[#3a2a1a] font-extrabold tracking-wide text-xs mb-2 uppercase">Nomor WA</label>
                        <input type="tel" name="phone" required class="contact-input">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[#3a2a1a] font-extrabold tracking-wide text-xs mb-2 uppercase">Pesan</label>
                        <textarea name="message" rows="6" required class="contact-input resize-none"></textarea>
                    </div>

                    <div class="md:col-span-2 text-center pt-2">
                        <button type="submit" class="contact-btn text-white px-10 py-3 rounded-full font-semibold">
                            Kirim
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @include('partials.footer')
    <script>
        const revealEls = document.querySelectorAll('.fade-up');
        if (revealEls.length > 0) {
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });

                revealEls.forEach(el => observer.observe(el));
            } else {
                revealEls.forEach(el => el.classList.add('visible'));
            }
        }
    </script>
</body>
</html>
