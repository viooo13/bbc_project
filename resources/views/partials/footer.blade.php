<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<footer class="site-footer">

    <!-- Large Statement -->
    <div class="footer-statement">
        <div class="footer-w">
            <p class="statement-label">Bakso Bunderan Ciomas</p>
            <h2 class="statement-text">
                Setiap mangkuk<br>punya cerita.
            </h2>
            <a href="https://maps.app.goo.gl/QWu31z8q7NLZPs5b7" class="statement-link">
                Kunjungi outlet kami
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 17L17 7M17 7H7M17 7v10"/></svg>
            </a>
        </div>
    </div>

    <!-- Divider -->
    <div class="footer-w"><div class="footer-line"></div></div>

    <!-- Info Row -->
    <div class="footer-info">
        <div class="footer-w">
            <div class="info-grid">

                <div class="info-col">
                    <span class="info-label">Lokasi</span>
                    <p>Jl. Villa Ciomas,<br>Ciomas Rahayu, Kec. Ciomas<br>Kab. Bogor, Jawa Barat 16610</p>
                </div>

                <div class="info-col">
                    <span class="info-label">Jam Buka</span>
                    <p>Setiap Hari<br>10:00 — 21:00 WIB</p>
                </div>

                <div class="info-col">
                    <span class="info-label">Kontak</span>
                    <p>
                        <a href="https://wa.me/6285200000000">0822-6006-8707</a><br>
                    </p>
                </div>

                <div class="info-col">
                    <span class="info-label">Sosial</span>
                    <div class="social-links">
                        <a href="https://www.instagram.com/bakso_bunderan_ciomas?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">Instagram</a>
                        <a href="https://www.tiktok.com/@bakso_bunderan_ciomas">TikTok</a>
                        <a href="https://www.facebook.com/profile.php?id=61551251751338&rdid=xzJdFUkwwq12fNAp&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F1DdUGm4PgF%2F#">Facebook</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bottom -->
    <div class="footer-w"><div class="footer-line"></div></div>
    <div class="footer-bottom-row">
        <div class="footer-w">
            <div class="bottom-flex">
                <span>&copy; {{ date('Y') }} Bakso Bunderan Ciomas</span>
                <div class="bottom-links">
                    <a href="/home">Beranda</a>
                    <a href="/menu">Menu</a>
                    <a href="/tentang-bbc">Tentang</a>
                    <a href="/lokasi-kontak">Kontak</a>
                </div>
            </div>
        </div>
    </div>

</footer>

<style>
.site-footer {
    background: #1a120b;
    color: #8a7b6a;
    font-family: 'Poppins', sans-serif;
    margin-top: auto;
}

.footer-w {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 32px;
}

.footer-line {
    height: 1px;
    background: #2e2218;
}

/* Statement */
.footer-statement {
    padding: 80px 0 60px;
}

.statement-label {
    font-size: 12px;
    font-weight: 600;
    color: #6a5a48;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin: 0 0 24px;
}

.statement-text {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: clamp(2.5rem, 6vw, 4.5rem);
    font-weight: 800;
    color: #EFE1D1;
    line-height: 1.1;
    margin: 0 0 40px;
    letter-spacing: -1px;
}

.statement-link {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #8b0000;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border-bottom: 1px solid #8b0000;
    padding-bottom: 4px;
    transition: gap 0.3s, color 0.3s;
}

.statement-link:hover {
    gap: 16px;
    color: #c44;
}

/* Info */
.footer-info {
    padding: 48px 0;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 32px;
}

.info-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #6a5a48;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 14px;
}

.info-col p {
    font-size: 14px;
    color: #8a7b6a;
    line-height: 1.8;
    margin: 0;
}

.info-col a {
    color: #8a7b6a;
    text-decoration: none;
    transition: color 0.2s;
}

.info-col a:hover {
    color: #EFE1D1;
}

.info-note {
    margin-top: 8px !important;
    font-size: 12px !important;
    color: #5a4a38 !important;
    font-style: italic;
}

.social-links {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.social-links a {
    font-size: 14px;
    color: #8a7b6a;
    text-decoration: none;
    transition: color 0.2s;
}

.social-links a:hover {
    color: #EFE1D1;
}

/* Bottom */
.footer-bottom-row {
    padding: 24px 0;
}

.bottom-flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.bottom-flex span {
    font-size: 12px;
    color: #4a3d30;
}

.bottom-links {
    display: flex;
    gap: 24px;
}

.bottom-links a {
    font-size: 12px;
    color: #4a3d30;
    text-decoration: none;
    transition: color 0.2s;
}

.bottom-links a:hover {
    color: #EFE1D1;
}

/* Responsive */
@media (max-width: 768px) {
    .footer-statement { padding: 56px 0 40px; }
    .statement-text { letter-spacing: -0.5px; }

    .info-grid {
        grid-template-columns: 1fr 1fr;
        gap: 28px;
    }

    .bottom-flex {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }

    .bottom-links { gap: 16px; }
}

@media (max-width: 480px) {
    .info-grid { grid-template-columns: 1fr; }
    .footer-w { padding: 0 20px; }
}
</style>
