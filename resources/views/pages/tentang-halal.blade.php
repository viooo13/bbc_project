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
            transform-origin: 50% 0%;
            will-change: transform;
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
            animation: cardSwing 2.8s ease-in-out infinite;
            box-shadow: 0 24px 50px rgba(58, 42, 26, 0.16);
        }

        .about-image {
            transition: transform 0.35s ease;
        }

        .about-image-frame:hover .about-image {
            transform: scale(1.02);
        }

        @keyframes cardSwing {
            0% { transform: rotate(0deg) translateY(-2px); }
            20% { transform: rotate(-1.8deg) translateY(-1px); }
            50% { transform: rotate(1.8deg) translateY(0); }
            80% { transform: rotate(-1.2deg) translateY(-1px); }
            100% { transform: rotate(0deg) translateY(-2px); }
        }

        .about-copy p {
            transition: color 0.25s ease;
        }

        .about-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            background: rgba(239, 47, 36, 0.08);
            color: #8b0000;
            font-size: 0.66rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .about-title {
            font-family: 'Poppins', sans-serif !important;
            font-size: clamp(1.45rem, 2.2vw, 2.3rem);
            line-height: 1.15;
            letter-spacing: -0.03em;
        }

        .about-lead {
            color: #5c4637;
            font-size: 0.9rem;
            line-height: 1.72;
        }

        .about-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.6rem;
        }

        .about-metric {
            padding: 0.78rem 0.82rem;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid rgba(139, 0, 0, 0.08);
            box-shadow: 0 12px 24px rgba(58, 42, 26, 0.07);
        }

        .about-metric-value {
            font-size: 1rem;
            font-weight: 800;
            color: #8b0000;
            line-height: 1.1;
        }

        .about-metric-label {
            margin-top: 0.25rem;
            color: #6a5244;
            font-size: 0.72rem;
            line-height: 1.35;
        }

        .about-points {
            display: grid;
            gap: 0.55rem;
        }

        .about-point {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            padding: 0.72rem 0.82rem;
            border-radius: 1rem;
            background: rgba(249, 237, 222, 0.7);
            border: 1px solid rgba(139, 0, 0, 0.06);
        }

        .about-point-icon {
            width: 1.8rem;
            height: 1.8rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(239, 47, 36, 0.12);
            color: #ef2f24;
            flex: 0 0 auto;
            font-size: 0.78rem;
        }

        .about-point-title {
            font-size: 0.85rem;
            font-weight: 800;
            color: #3a2a1a;
            line-height: 1.2;
        }

        .about-point-text {
            margin-top: 0.2rem;
            color: #6a5244;
            font-size: 0.76rem;
            line-height: 1.45;
        }

        .about-quote {
            margin-top: 0.85rem;
            padding: 0.85rem 0.95rem;
            border-radius: 1rem;
            background: linear-gradient(135deg, rgba(255, 250, 244, 0.95), rgba(247, 224, 209, 0.95));
            border: 1px solid rgba(139, 0, 0, 0.08);
            color: #5d4638;
            font-size: 0.82rem;
            line-height: 1.6;
        }

        .about-hero-note {
            position: absolute;
            right: 1rem;
            bottom: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(139, 0, 0, 0.08);
            box-shadow: 0 12px 24px rgba(58, 42, 26, 0.08);
            backdrop-filter: blur(10px);
        }

        .about-hero-note strong {
            display: block;
            color: #8b0000;
            font-size: 0.82rem;
        }

        .about-hero-note span {
            display: block;
            color: #5d4638;
            font-size: 0.75rem;
            margin-top: 0.15rem;
        }

        @media (max-width: 767px) {
            .about-metrics {
                grid-template-columns: 1fr;
            }
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

        .influencer-card {
            border-radius: 16px;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
        }

        .influencer-media {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 10px 22px rgba(58, 42, 26, 0.14);
        }

        .influencer-media img {
            transition: transform 0.55s ease;
        }

        .influencer-media::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 45%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.32), rgba(0, 0, 0, 0));
            pointer-events: none;
        }

        .influencer-play {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 46px;
            height: 46px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.9);
            color: #b42318;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.18);
            transition: transform 0.3s ease, background-color 0.3s ease, color 0.3s ease;
        }

        .influencer-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #b42318;
            color: #fff;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            padding: 0.35rem 0.65rem;
            border-radius: 999px;
            max-width: 82%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .influencer-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            background: #b42318;
            color: #fff;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            padding: 0.58rem 1.1rem;
            border-radius: 999px;
            transition: transform 0.25s ease, background-color 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 8px 16px rgba(180, 35, 24, 0.28);
        }

        .influencer-cta .external-icon {
            font-size: 0.68rem;
            opacity: 0.9;
            transform: translateY(0);
            transition: transform 0.25s ease, opacity 0.25s ease;
        }

        .influencer-card:hover {
            transform: translateY(-4px);
        }

        .influencer-card:hover .influencer-media {
            box-shadow: 0 16px 30px rgba(58, 42, 26, 0.2);
        }

        .influencer-card:hover .influencer-media img {
            transform: scale(1.045);
        }

        .influencer-card:hover .influencer-play {
            transform: translate(-50%, -50%) scale(1.07);
            background: #b42318;
            color: #fff;
        }

        .influencer-card:hover .influencer-cta {
            transform: translateY(-2px);
            background: #8f1e14;
            box-shadow: 0 12px 20px rgba(143, 30, 20, 0.3);
        }

        .influencer-card:hover .influencer-cta .external-icon {
            transform: translate(1px, -1px);
            opacity: 1;
        }

        @media (prefers-reduced-motion: reduce) {
            .influencer-card,
            .influencer-media,
            .influencer-media img,
            .influencer-play,
            .influencer-cta,
            .influencer-cta .external-icon {
                transition: none !important;
            }
        }
    </style>
</head>
<body class="js font-poppins bg-[#EFE1D1] text-[#3a2a1a] overflow-x-hidden">
    @include('partials.navbar')
    @include('partials.review-readmore')

    <section class="py-12 md:py-20 bg-[#EFE1D1]">
        <div class="max-w-6xl mx-auto px-6 space-y-8 md:space-y-10">
            <div class="rounded-[1.5rem] overflow-hidden fade-up about-panel">
                <div class="grid lg:grid-cols-2 gap-0 items-stretch">
                    <div class="relative p-5 sm:p-6 md:p-7 lg:p-8 about-copy order-2 lg:order-1">
                        <div class="about-kicker mb-3">
                            <i class="fas fa-store"></i>
                            Tentang Kami
                        </div>
                        <h3 class="about-title font-extrabold text-[#3a2a1a] mb-3">
                            Bakso Bunderan Ciomas
                        </h3>
                        <p class="about-lead text-justify mb-4">
                            Berdiri sejak 12 Februari 2025, kami melayani pelanggan setia dengan sajian bakso tulang dan sumsum yang diracik dari bahan pilihan. Cita rasa dibuat konsisten, tampil lebih bersih, dan tetap mempertahankan karakter rumahan yang hangat.
                        </p>

                        <div class="about-metrics mb-4">
                            <div class="about-metric">
                                <div class="about-metric-value">2025</div>
                                <div class="about-metric-label">Tahun berdiri dan mulai melayani pelanggan.</div>
                            </div>
                            <div class="about-metric">
                                <div class="about-metric-value">100%</div>
                                <div class="about-metric-label">Dimasak fresh dengan standar kebersihan yang dijaga.</div>
                            </div>
                            <div class="about-metric">
                                <div class="about-metric-value">Rasa</div>
                                <div class="about-metric-label">Fokus pada kuah gurih dan tekstur bakso yang konsisten.</div>
                            </div>
                        </div>

                        <div class="about-points">
                            <div class="about-point">
                                <div class="about-point-icon"><i class="fas fa-bowl-food"></i></div>
                                <div>
                                    <div class="about-point-title">Menu Andalan Yang Jelas</div>
                                    <div class="about-point-text">Bakso tulang, sumsum, dan varian favorit lain disiapkan untuk pengalaman makan yang lebih fokus dan mudah diingat.</div>
                                </div>
                            </div>
                            <div class="about-point">
                                <div class="about-point-icon"><i class="fas fa-shield-heart"></i></div>
                                <div>
                                    <div class="about-point-title">Proses Yang Terjaga</div>
                                    <div class="about-point-text">Mulai dari pemilihan bahan, pengolahan, sampai penyajian, semuanya dibuat rapi agar kualitas tetap stabil.</div>
                                </div>
                            </div>
                        </div>

                        <div class="about-quote">
                            Kami ingin setiap porsi terasa familiar, hangat, dan layak direkomendasikan, baik untuk pelanggan baru maupun pelanggan yang sudah kembali berulang kali.
                        </div>
                    </div>

                    <div class="relative p-5 sm:p-6 md:p-7 lg:p-8 flex items-center justify-center order-1 lg:order-2">
                        <div class="relative w-full max-w-xl about-image-shell">
                            <div class="about-image-frame relative rounded-[1.2rem] shadow-xl">
                                <img src="about.jpeg" alt="Bakso Bunderan Ciomas" class="about-image w-full h-[250px] sm:h-[300px] lg:h-[340px] object-cover rounded-[1.1rem]">
                            </div>
                            <div class="about-hero-note hidden sm:block">
                                <strong>Fresh Every Day</strong>
                                <span>Disajikan hangat dengan presentasi yang bersih dan rapi.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-[1.5rem] overflow-hidden fade-up about-panel reverse">
                <div class="grid lg:grid-cols-2 gap-0 items-stretch">
                    <div class="relative p-5 sm:p-6 md:p-7 lg:p-8 order-2 lg:order-1 about-copy">
                        <div class="about-kicker mb-3">
                            <i class="fas fa-award"></i>
                            Kenapa BBC
                        </div>
                        <h3 class="about-title font-extrabold text-[#3a2a1a] mb-3">
                            Konsisten, Bersih, dan Layak Direkomendasikan
                        </h3>
                        <p class="about-lead text-justify mb-4">
                            Setiap porsi dibuat dengan dedikasi penuh menggunakan bahan berkualitas tinggi. Kami menjaga kebersihan, tekstur, dan rasa agar pengalaman makan tetap terasa premium tanpa kehilangan identitas bakso khas rumahan.
                        </p>

                        <div class="about-points">
                            <div class="about-point">
                                <div class="about-point-icon"><i class="fas fa-seedling"></i></div>
                                <div>
                                    <div class="about-point-title">Bahan Pilihan</div>
                                    <div class="about-point-text">Fokus pada bahan yang segar agar rasa kuah dan isian tetap kuat saat disajikan.</div>
                                </div>
                            </div>
                            <div class="about-point">
                                <div class="about-point-icon"><i class="fas fa-star"></i></div>
                                <div>
                                    <div class="about-point-title">Cita Rasa Konsisten</div>
                                    <div class="about-point-text">Setiap mangkuk dijaga agar rasanya stabil dari hari ke hari, bukan hanya enak sesaat.</div>
                                </div>
                            </div>
                            <div class="about-point">
                                <div class="about-point-icon"><i class="fas fa-clipboard-check"></i></div>
                                <div>
                                    <div class="about-point-title">Sajian Lebih Rapi</div>
                                    <div class="about-point-text">Penyajian dibuat lebih bersih dan terstruktur agar terlihat meyakinkan di mata pelanggan.</div>
                                </div>
                            </div>
                        </div>

                        <div class="about-quote">
                            Itulah kenapa Bakso Bunderan Ciomas mulai dikenal dari pelanggan biasa hingga influencer dan pelaku usaha kuliner.
                        </div>
                    </div>

                    <div class="relative p-5 sm:p-6 md:p-7 lg:p-8 flex items-center justify-center order-1 lg:order-2 about-image-shell">
                        <div class="relative w-full max-w-xl">
                            <div class="about-image-frame relative rounded-[1.2rem] shadow-xl">
                                <img src="https://placehold.co/720x560/efe1d1/3a2a1a?text=About+Image" alt="Bakso Bunderan Ciomas" class="about-image w-full h-[250px] sm:h-[300px] lg:h-[340px] object-cover rounded-[1.1rem]">
                            </div>
                            <div class="about-hero-note hidden sm:block left-4 right-auto">
                                <strong>Quality First</strong>
                                <span>Disiapkan dengan perhatian pada detail dan kebersihan.</span>
                            </div>
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
                    @forelse(($influencerTestimonials ?? collect()) as $idx => $influencer)
                        <article class="influencer-card fade-up" style="transition-delay: {{ number_format($idx * 0.08, 2) }}s;">
                            <div class="influencer-media">
                                <img src="{{ $influencer->thumbnail_url }}" alt="Influencer" class="w-full h-52 md:h-56 object-cover" />
                                <div class="influencer-play"><i class="fas fa-play"></i></div>
                                <div class="influencer-badge">
                                    {{ $influencer->title ?: 'Video Influencer' }}
                                </div>
                            </div>
                            <div class="mt-4 flex justify-center">
                                <a href="{{ $influencer->youtube_url }}" target="_blank" rel="noopener" class="influencer-cta">
                                    <i class="fab fa-youtube"></i>
                                    <span>See on YouTube</span>
                                    <i class="fas fa-up-right-from-square external-icon"></i>
                                </a>
                            </div>
                        </article>
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
                        @foreach($testimonials as $idx => $testimonial)
                            <div class="bg-[#F9EDDE] p-6 rounded-xl shadow-md hover:shadow-lg transition self-start fade-up" style="transition-delay: {{ number_format($idx * 0.07, 2) }}s;">
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
