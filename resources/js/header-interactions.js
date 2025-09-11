import { gsap } from 'gsap';

class HeaderInteractions {
    constructor() {
        this.header = null;
        this.mobileMenu = null;
        this.consultantCard = null;
        this.init();
    }

    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.initializeComponents());
        } else {
            this.initializeComponents();
        }
    }

    initializeComponents() {
        this.header = document.querySelector('header');
        this.mobileMenu = document.querySelector('[x-data*="mobileMenuOpen"]');
        this.consultantCard = document.querySelector('.consultant-info-card');

        this.setupHeaderEffects();
        this.setupPopoverAnimations();
        this.setupMobileMenuAnimations();
        this.setupNavigationEffects();
        this.setupScrollSpy();
    }

    setupHeaderEffects() {
        if (!this.header) return;

        let lastScrollY = window.scrollY;
        let ticking = false;

        const updateHeader = () => {
            const scrollY = window.scrollY;
            const scrollDelta = scrollY - lastScrollY;

            // Header background opacity based on scroll
            const opacity = Math.min(0.95, Math.max(0.8, scrollY / 100));
            this.header.style.setProperty('--header-bg-opacity', opacity);

            // Header transform on scroll direction
            if (scrollY > 100) {
                if (scrollDelta > 0) {
                    // Scrolling down - slight compress
                    gsap.to(this.header, { 
                        scaleY: 0.98, 
                        duration: 0.2, 
                        ease: 'power2.out' 
                    });
                } else {
                    // Scrolling up - return to normal
                    gsap.to(this.header, { 
                        scaleY: 1, 
                        duration: 0.3, 
                        ease: 'power2.out' 
                    });
                }
            }

            lastScrollY = scrollY;
            ticking = false;
        };

        const handleScroll = () => {
            if (!ticking) {
                requestAnimationFrame(updateHeader);
                ticking = true;
            }
        };

        window.addEventListener('scroll', handleScroll, { passive: true });
    }

    setupPopoverAnimations() {
        const popovers = document.querySelectorAll('[x-data*="open"]');
        
        popovers.forEach(popover => {
            const trigger = popover.querySelector('[x-on\\:mouseenter], [x-on\\:click]');
            const content = popover.querySelector('[x-show="open"]');
            
            if (!trigger || !content) return;

            // Enhanced hover animations
            trigger.addEventListener('mouseenter', () => {
                gsap.to(trigger, {
                    scale: 1.02,
                    duration: 0.2,
                    ease: 'power2.out'
                });
            });

            trigger.addEventListener('mouseleave', () => {
                gsap.to(trigger, {
                    scale: 1,
                    duration: 0.3,
                    ease: 'elastic.out(1, 0.8)'
                });
            });

            // Content animation improvements
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                        const isVisible = !content.style.display || content.style.display !== 'none';
                        
                        if (isVisible) {
                            gsap.fromTo(content.children, {
                                y: 20,
                                opacity: 0
                            }, {
                                y: 0,
                                opacity: 1,
                                duration: 0.3,
                                stagger: 0.05,
                                ease: 'back.out(1.7)'
                            });
                        }
                    }
                });
            });

            observer.observe(content, { attributes: true });
        });
    }

    setupMobileMenuAnimations() {
        // Mobile menu animations are handled by Alpine.js and CSS transitions
        // No additional JavaScript interference needed
        return;
    }

    setupNavigationEffects() {
        const navItems = document.querySelectorAll('.nav-item');
        
        navItems.forEach(item => {
            // Magnetic effect on hover
            item.addEventListener('mouseenter', (e) => {
                gsap.to(item, {
                    scale: 1.05,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            item.addEventListener('mouseleave', (e) => {
                gsap.to(item, {
                    scale: 1,
                    duration: 0.4,
                    ease: 'elastic.out(1, 0.7)'
                });
            });

            // Click ripple effect
            item.addEventListener('click', (e) => {
                const ripple = document.createElement('span');
                const rect = item.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: radial-gradient(circle, var(--color-primary) 0%, transparent 70%);
                    border-radius: 50%;
                    pointer-events: none;
                    opacity: 0.3;
                    transform: scale(0);
                `;

                item.style.position = 'relative';
                item.style.overflow = 'hidden';
                item.appendChild(ripple);

                gsap.to(ripple, {
                    scale: 2,
                    opacity: 0,
                    duration: 0.6,
                    ease: 'power2.out',
                    onComplete: () => ripple.remove()
                });
            });
        });
    }

    setupScrollSpy() {
        const sections = document.querySelectorAll('section[id]');
        const navItems = document.querySelectorAll('.nav-item[href^="#"]');
        
        if (sections.length === 0 || navItems.length === 0) return;

        const observerOptions = {
            root: null,
            rootMargin: '-20% 0px -80% 0px',
            threshold: 0
        };

        const activeNavItems = new Set();

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const sectionId = entry.target.id;
                const navItem = document.querySelector(`.nav-item[href="#${sectionId}"]`);
                
                if (!navItem) return;

                if (entry.isIntersecting) {
                    activeNavItems.add(sectionId);
                    
                    // Animate nav item activation
                    gsap.to(navItem, {
                        scale: 1.1,
                        duration: 0.3,
                        ease: 'back.out(1.7)'
                    });
                } else {
                    activeNavItems.delete(sectionId);
                    
                    // Return to normal size
                    gsap.to(navItem, {
                        scale: 1,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                }

                // Update active classes
                this.updateActiveNavigation();
            });
        }, observerOptions);

        sections.forEach(section => observer.observe(section));
    }

    updateActiveNavigation() {
        const navItems = document.querySelectorAll('.nav-item[href^="#"]');
        
        navItems.forEach(item => {
            const href = item.getAttribute('href');
            const sectionId = href.substring(1);
            const isActive = document.querySelector(`#${sectionId}`)?.classList.contains('active-section');
            
            if (isActive) {
                item.classList.add('active');
                gsap.to(item, {
                    color: 'var(--color-primary)',
                    duration: 0.2
                });
            } else {
                item.classList.remove('active');
                gsap.to(item, {
                    color: 'var(--color-muted-foreground)',
                    duration: 0.2
                });
            }
        });
    }

    // Public method to refresh interactions after dynamic content changes
    refresh() {
        this.initializeComponents();
    }
}

// Initialize header interactions
const headerInteractions = new HeaderInteractions();

// Export for external use
export default headerInteractions;

// Make available globally for Livewire
window.headerInteractions = headerInteractions;