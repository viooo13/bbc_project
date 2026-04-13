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

        .halal-intro {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1), transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform, opacity;
        }
        .js .halal-intro {
            opacity: 0;
            transform: translateY(80px) scale(0.965);
        }
        .halal-intro.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        .halal-logo,
        .halal-desc {
            opacity: 0;
            transform: translateY(34px) scale(0.985);
            transition: opacity 1s cubic-bezier(0.16, 1, 0.3, 1), transform 1s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform, opacity;
        }
        .halal-intro.visible .halal-logo,
        .halal-intro.visible .halal-desc {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        .halal-intro.visible .halal-logo {
            transition-delay: 0.12s;
        }
        .halal-intro.visible .halal-desc {
            transition-delay: 0.34s;
        }

        .about-panel {
            position: relative;
        }

        .about-image-shell,
        .about-copy {
            opacity: 0;
            will-change: transform, opacity;
            transition: opacity 0.95s cubic-bezier(0.16, 1, 0.3, 1), transform 0.95s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .about-image-shell {
            transform: translateX(-28px) scale(0.97);
        }

        .about-copy {
            transform: translateX(22px) translateY(10px);
        }

        .about-panel.reverse .about-image-shell {
            transform: translateX(28px) scale(0.97);
        }

        .about-panel.reverse .about-copy {
            transform: translateX(-22px) translateY(10px);
        }

        .fade-up.visible .about-image-shell,
        .fade-up.visible .about-copy {
            opacity: 1;
            transform: translateX(0) translateY(0) scale(1);
        }

        .fade-up.visible .about-copy {
            transition-delay: 0.14s;
        }

        .about-image-frame {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            transform: translateZ(0);
            transition: transform 0.45s ease, box-shadow 0.45s ease;
        }

        .about-image-frame::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.16), rgba(0,0,0,0));
            pointer-events: none;
        }

        .about-image-frame:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 24px 50px rgba(58, 42, 26, 0.16);
        }

        .about-image {
            transition: transform 0.55s ease;
        }

        .about-image-frame:hover .about-image {
            transform: scale(1.04);
        }

        .about-copy p {
            transition: color 0.25s ease;
        }

        .review-clamp {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-break: break-word;
        }

        .review-full {
            display: block;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .review-animated {
            display: block;
            overflow: hidden;
            transition: max-height 280ms ease;
            will-change: max-height;
            position: relative;
        }

        .review-animated.review-clamp::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 1.8em;
            pointer-events: none;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), var(--review-fade-bg, #F9EDDE));
        }
    </style>
</head>
<body class="js font-poppins bg-[#EFE1D1] text-[#3a2a1a] overflow-x-hidden">
    @include('partials.navbar')
    @include('partials.review-readmore')

    <section class="py-12 md:py-20 bg-[#EFE1D1]">
        <div class="max-w-7xl mx-auto px-6 space-y-8 md:space-y-12">
            <div class="bg-[#F9EDDE] rounded-3xl shadow-lg overflow-hidden fade-up about-panel">
                <div class="grid md:grid-cols-2 gap-6 md:gap-8 items-center p-6 sm:p-8 md:p-12">
                    <div class="flex justify-center order-1 md:order-1 about-image-shell">
                        <div class="about-image-frame w-full max-w-sm shadow-lg bg-white/40">
                            <img src="https://placehold.co/520x360/efe1d1/3a2a1a?text=About+Image" alt="Bakso Bunderan Ciomas" class="about-image w-full h-auto rounded-2xl">
                        </div>
                    </div>

                    <div class="order-2 md:order-2 about-copy">
                        <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-[#3a2a1a] flex items-center gap-2 font-poopins">
                            BAKSO BUNDERAN CIOMAS
                            <img src="logo.jpeg" alt="Logo" class="w-10 h-10 object-contain" />
                        </h3>
                        <p class="text-gray-700 mb-4 leading-relaxed text-justify font-fairplay">
                            Berdiri sejak 12 Februari 2025 yang lalu setiap hari melayani pelanggan setia di Diaol & Grobak. Kami menghadirkan Bakso Tulang & Sum-sum dengan bumbu rahasia dan cita rasa yang autentik. Dari influencer hingga pengusaha cita mulai dikenal semua kalangan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-[#F9EDDE] rounded-3xl shadow-lg overflow-hidden fade-up about-panel reverse">
                <div class="grid md:grid-cols-2 gap-6 md:gap-8 items-center p-6 sm:p-8 md:p-12">
                    <div class="order-2 md:order-1 about-copy">
                        <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-[#3a2a1a] flex items-center gap-2 font-poopins">
                            BAKSO BUNDERAN CIOMAS
                            <img src="logo.jpeg" alt="Logo" class="w-10 h-10 object-contain" />
                        </h3>
                        <p class="text-gray-700 mb-4 leading-relaxed text-justify font-poppins">
                            Setiap porsi bakso kami dibuat dengan dedikasi penuh menggunakan bahan-bahan pilihan berkualitas tinggi. Proses produksi yang ketat memastikan setiap bakso yang kami sajikan memiliki cita rasa yang konsisten, tekstur yang sempurna, dan selalu higienis. Kepuasan pelanggan adalah prioritas utama kami.
                        </p>
                    </div>

                    <div class="flex justify-center order-1 md:order-2 about-image-shell">
                        <div class="about-image-frame w-full max-w-sm shadow-lg bg-white/40">
                            <img src="https://placehold.co/520x360/efe1d1/3a2a1a?text=About+Image" alt="Bakso Bunderan Ciomas" class="about-image w-full h-auto rounded-2xl">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-[#EFE1D1]">
        <div class="max-w-5xl mx-auto px-6">
            <div class="relative bg-[#EFE1D1]">
                <div class="relative text-center halal-intro fade-up">
                    <div class="flex justify-center mb-4 halal-logo">
                        <img src="{{ asset('halal.jpeg') }}" onerror="this.onerror=null;this.src='https://placehold.co/160x80/efe1d1/3a2a1a?text=Halal';" alt="Halal" class="w-24 sm:w-28 h-auto" />
                    </div>
                    <p class="text-sm md:text-base text-gray-700 max-w-3xl mx-auto leading-relaxed halal-desc">
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
                    @forelse(($influencerTestimonials ?? collect()) as $influencer)
                        <div class="bg-transparent">
                            <div class="relative rounded-xl overflow-hidden shadow-md bg-white">
                                <img src="{{ $influencer->thumbnail ? asset($influencer->thumbnail) : 'https://placehold.co/420x240/ffffff/3a2a1a?text=Influencer' }}" alt="Influencer" class="w-full h-52 md:h-56 object-cover" />
                                <div class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded">
                                    {{ $influencer->title ?: 'Video Influencer' }}
                                </div>
                            </div>
                            <div class="mt-4 flex justify-center">
                                <a href="{{ $influencer->youtube_url }}" target="_blank" rel="noopener" class="bg-red-600 text-white text-xs font-bold px-6 py-2 rounded-full hover:bg-red-700 transition">See on Youtube</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-sm text-gray-600 bg-[#F9EDDE] border border-[#e6d8c5] rounded-xl py-8">
                            Testimoni influencer belum tersedia.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-14">
                <h4 class="text-center font-extrabold tracking-wide text-lg md:text-xl">ULASAN</h4>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 items-start" id="daftarTestimoni">
                    @if(isset($testimonials) && $testimonials->count() > 0)
                        @foreach($testimonials as $testimonial)
                            <div class="bg-[#F9EDDE] p-6 rounded-xl shadow-md hover:shadow-lg transition self-start">
                                <div class="flex items-center justify-between">
                                    <div class="font-extrabold text-sm text-[#3a2a1a]">{{ $testimonial->customer_name }}</div>
                                    <div class="text-amber-500 text-sm font-semibold">
                                        @for($i = 0; $i < 5; $i++)
                                            @if($i < $testimonial->rating) ★ @else ☆ @endif
                                        @endfor
                                    </div>
                                </div>
                                <div class="mt-3" data-review-block>
                                    <p class="text-xs text-gray-700 leading-relaxed review-clamp" data-review-text style="--review-fade-bg:#F9EDDE;">{{ $testimonial->content }}</p>
                                    <button type="button" class="mt-2 text-xs font-semibold text-red-600 hover:text-red-700 underline hidden" data-toggle-text>
                                        Lihat selengkapnya
                                    </button>
                                </div>
                                @if($testimonial->admin_reply)
                                    <div class="mt-4 p-3 bg-red-50 rounded-lg border-l-4 border-red-600" data-review-block>
                                        <p class="text-sm font-semibold text-red-600 mb-1">Balasan:</p>
                                        <p class="text-sm text-gray-700 review-clamp" data-review-text style="--review-fade-bg:#FEF2F2;">{{ $testimonial->admin_reply }}</p>
                                        <button type="button" class="mt-2 text-xs font-semibold text-red-600 hover:text-red-700 underline hidden" data-toggle-text>
                                            Lihat selengkapnya
                                        </button>
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
    <script>
        const revealEls = document.querySelectorAll('.fade-up, .fade-left, .fade-right');
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

        function initReviewReadMore() {
            const blocks = document.querySelectorAll('[data-review-block]');
            if (!blocks.length) return;

            blocks.forEach((block) => {
                const text = block.querySelector('[data-review-text]');
                const toggle = block.querySelector('[data-toggle-text]');
                if (!text || !toggle) return;

                const lineHeight = parseFloat(window.getComputedStyle(text).lineHeight) || 20;
                const collapsedHeight = Math.round(lineHeight * 3);

                text.classList.remove('review-full');
                text.classList.add('review-clamp', 'review-animated');

                text.classList.remove('review-clamp');
                const expandedHeight = Math.ceil(text.scrollHeight);
                text.classList.add('review-clamp');

                const hasOverflow = expandedHeight - collapsedHeight > 2;
                if (!hasOverflow) {
                    toggle.classList.add('hidden');
                    text.classList.remove('review-clamp', 'review-animated');
                    text.classList.add('review-full');
                    text.style.maxHeight = 'none';
                    return;
                }

                let expanded = false;
                text.style.maxHeight = `${collapsedHeight}px`;
                toggle.classList.remove('hidden');

                toggle.addEventListener('click', () => {
                    if (expanded) {
                        text.style.maxHeight = `${collapsedHeight}px`;
                        toggle.textContent = 'Lihat selengkapnya';
                        setTimeout(() => {
                            if (!expanded) {
                                text.classList.remove('review-full');
                                text.classList.add('review-clamp');
                            }
                        }, 280);
                    } else {
                        text.classList.remove('review-clamp');
                        text.classList.add('review-full');
                        text.style.maxHeight = `${expandedHeight}px`;
                        toggle.textContent = 'Lihat lebih sedikit';
                    }

                    expanded = !expanded;
                });
            });
        }

        initReviewReadMore();
    </script>
</body>
</html>
