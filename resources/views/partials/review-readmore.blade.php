@once
<style>
    :root {
        --review-clamp-lines: 1.9em;
    }

    .review-clamp {
        display: -webkit-box;
        -webkit-line-clamp: var(--review-clamp-lines);
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

<script>
    (function () {
        function getDefaultClampLines() {
            const rootStyles = window.getComputedStyle(document.documentElement);
            const value = parseInt(rootStyles.getPropertyValue('--review-clamp-lines'), 10);
            return Number.isFinite(value) && value > 0 ? value : 3;
        }

        function initReviewReadMore() {
            const blocks = document.querySelectorAll('[data-review-block]');
            if (!blocks.length) return;

            const defaultClampLines = getDefaultClampLines();

            blocks.forEach((block) => {
                const text = block.querySelector('[data-review-text]');
                const toggle = block.querySelector('[data-toggle-text]');
                if (!text || !toggle) return;

                const specificClamp = parseInt(text.getAttribute('data-clamp-lines') || '', 10);
                const clampLines = Number.isFinite(specificClamp) && specificClamp > 0 ? specificClamp : defaultClampLines;
                text.style.setProperty('--review-clamp-lines', String(clampLines));

                const lineHeight = parseFloat(window.getComputedStyle(text).lineHeight) || 20;
                const collapsedHeight = Math.round(lineHeight * clampLines);

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

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initReviewReadMore);
        } else {
            initReviewReadMore();
        }
    })();
</script>
@endonce
