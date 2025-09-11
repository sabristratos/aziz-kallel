document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('back-to-top');
    
    if (!backToTopButton) return;
    
    // Show/hide back to top button based on scroll position
    function toggleBackToTop() {
        const scrolled = window.pageYOffset;
        const threshold = 200; // Show button after scrolling 200px
        
        if (scrolled > threshold) {
            backToTopButton.classList.remove('opacity-0', 'translate-y-2', 'pointer-events-none');
            backToTopButton.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
        } else {
            backToTopButton.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
            backToTopButton.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
        }
    }
    
    // Listen for scroll events
    window.addEventListener('scroll', toggleBackToTop);
    
    // Initial check
    toggleBackToTop();
});