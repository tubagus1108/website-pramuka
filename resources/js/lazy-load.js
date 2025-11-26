/**
 * Lazy Loading Images - Optimized
 */

// Immediate preload for LCP image
const heroSlider = document.getElementById('heroSlider');
if (heroSlider) {
    const firstImage = heroSlider.querySelector('img');
    if (firstImage && firstImage.dataset.src) {
        firstImage.src = firstImage.dataset.src;
        firstImage.removeAttribute('data-src');
    }
}

// Lazy load other images when DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLazyLoad);
} else {
    initLazyLoad();
}

function initLazyLoad() {
    // Native lazy loading supported by modern browsers
    if ('loading' in HTMLImageElement.prototype) {
        const lazyImages = document.querySelectorAll('img[loading="lazy"]');
        lazyImages.forEach(img => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            }
        });
    } else {
        // Fallback for older browsers
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });

            document.querySelectorAll('img[loading="lazy"]').forEach(img => {
                imageObserver.observe(img);
            });
        } else {
            // Ultimate fallback - load all images
            document.querySelectorAll('img[data-src]').forEach(img => {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            });
        }
    }
}
