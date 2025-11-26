/**
 * Lazy Loading Images
 * Optimizes image loading for better performance
 */

// Native lazy loading fallback with Intersection Observer
document.addEventListener('DOMContentLoaded', function() {
    // Check for native lazy loading support
    if ('loading' in HTMLImageElement.prototype) {
        // Native lazy loading supported
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
            }
            if (img.dataset.srcset) {
                img.srcset = img.dataset.srcset;
            }
        });
    } else {
        // Fallback to Intersection Observer
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                    }
                    if (img.dataset.srcset) {
                        img.srcset = img.dataset.srcset;
                    }
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.01
        });

        const lazyImages = document.querySelectorAll('img.lazy');
        lazyImages.forEach(img => imageObserver.observe(img));
    }

    // Preload LCP image (hero/slider)
    const heroImages = document.querySelectorAll('#heroSlider img');
    if (heroImages.length > 0) {
        const firstHeroImage = heroImages[0];
        if (firstHeroImage.dataset.src) {
            firstHeroImage.src = firstHeroImage.dataset.src;
        }
    }
});

// Defer offscreen images
function deferImages() {
    const imgDefer = document.querySelectorAll('img[data-src]');
    imgDefer.forEach((img) => {
        if (img.dataset.src) {
            img.setAttribute('src', img.dataset.src);
        }
    });
}

// Run after window load
window.addEventListener('load', deferImages);
