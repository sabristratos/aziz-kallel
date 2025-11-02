import { Splide } from '@splidejs/splide';

document.addEventListener('DOMContentLoaded', function() {
    const splideElement = document.querySelector('.testimonials-splide');
    if (!splideElement) return;

    // Check for RTL direction
    const isRTL = document.documentElement.dir === 'rtl' || document.documentElement.classList.contains('rtl');

    const splide = new Splide('.testimonials-splide', {
        type: 'loop',
        perPage: 3,
        perMove: 1,
        gap: '1rem',
        autoplay: true,
        interval: 5000,
        arrows: false,
        pagination: true,
        padding: 0,
        focus: 'center',
        trimSpace: false,
        direction: isRTL ? 'rtl' : 'ltr',
        breakpoints: {
            1023: {
                perPage: 1,
                gap: 0,
                padding: 0,
                autoplay: true,
                interval: 5000,
                direction: isRTL ? 'rtl' : 'ltr'
            }
        }
    });

    splide.mount();

    // Custom arrow controls with proper error handling
    const prevButton = document.querySelector('.splide-prev');
    const nextButton = document.querySelector('.splide-next');

    if (prevButton) {
        prevButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            try {
                splide.go('<');
            } catch (error) {
                console.warn('Carousel navigation error:', error);
            }
        });
    }

    if (nextButton) {
        nextButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            try {
                splide.go('>');
            } catch (error) {
                console.warn('Carousel navigation error:', error);
            }
        });
    }
});