import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register ScrollTrigger plugin
gsap.registerPlugin(ScrollTrigger);

class AnimationManager {
    constructor() {
        this.timeline = gsap.timeline();
        this.init();
    }

    init() {
        // Set initial states for animations
        this.setInitialStates();
        
        // Initialize scroll-triggered animations
        this.initScrollAnimations();
        
        // Initialize entrance animations
        this.initEntranceAnimations();
        
        // Add fallback safety mechanism
        this.addFallbackSafety();
    }

    setInitialStates() {
        // Add gsap-ready class to enable CSS-based hiding
        document.documentElement.classList.add('gsap-ready');
        
        // Wait for CSS to apply before setting GSAP states
        requestAnimationFrame(() => {
            // Set initial opacity and position for animated elements
            gsap.set('.animate-fade-in', { opacity: 0, y: 30 });
            gsap.set('.animate-slide-up', { opacity: 0, y: 50 });
            gsap.set('.animate-slide-left', { opacity: 0, x: 50 });
            gsap.set('.animate-slide-right', { opacity: 0, x: -50 });
            gsap.set('.animate-scale', { opacity: 0, scale: 0.8 });
            
            // Set initial states on children of stagger containers
            gsap.utils.toArray('.animate-stagger').forEach(container => {
                const children = container.children;
                if (children.length > 0) {
                    gsap.set(children, { opacity: 0, y: 30 });
                }
            });
        });
    }

    initEntranceAnimations() {
        // Hero section entrance animation
        const heroTimeline = gsap.timeline();
        
        heroTimeline
            .to('.animate-fade-in', {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: 'power2.out'
            });
    }

    initScrollAnimations() {
        // Fade in animations on scroll
        gsap.utils.toArray('.animate-fade-in').forEach((element, index) => {
            if (index === 0) return; // Skip hero section (already animated)
            
            gsap.to(element, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: element,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Slide up animations
        gsap.utils.toArray('.animate-slide-up').forEach(element => {
            gsap.to(element, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: element,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Slide left animations
        gsap.utils.toArray('.animate-slide-left').forEach(element => {
            gsap.to(element, {
                opacity: 1,
                x: 0,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: element,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Slide right animations
        gsap.utils.toArray('.animate-slide-right').forEach(element => {
            gsap.to(element, {
                opacity: 1,
                x: 0,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: element,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Scale animations
        gsap.utils.toArray('.animate-scale').forEach(element => {
            gsap.to(element, {
                opacity: 1,
                scale: 1,
                duration: 0.8,
                ease: 'back.out(1.7)',
                scrollTrigger: {
                    trigger: element,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Stagger animations (for groups of elements)
        gsap.utils.toArray('.animate-stagger').forEach(container => {
            const children = container.children;
            
            gsap.to(children, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                stagger: 0.2,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: container,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            });
        });
    }

    // Utility methods for custom animations
    animateIn(element, options = {}) {
        const defaults = {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'power2.out'
        };
        
        return gsap.to(element, { ...defaults, ...options });
    }

    animateOut(element, options = {}) {
        const defaults = {
            opacity: 0,
            y: -30,
            duration: 0.5,
            ease: 'power2.in'
        };
        
        return gsap.to(element, { ...defaults, ...options });
    }

    createTimeline(options = {}) {
        return gsap.timeline(options);
    }

    // Method to refresh ScrollTrigger (useful after dynamic content changes)
    refresh() {
        ScrollTrigger.refresh();
    }

    // Method to kill all animations
    killAll() {
        gsap.killTweensOf('*');
        ScrollTrigger.killAll();
    }

    // Fallback safety mechanism
    addFallbackSafety() {
        // Show all animated elements after 3 seconds if they're still hidden
        setTimeout(() => {
            const hiddenElements = document.querySelectorAll('.animate-fade-in, .animate-slide-up, .animate-slide-left, .animate-slide-right, .animate-scale');
            hiddenElements.forEach(element => {
                const computedStyle = window.getComputedStyle(element);
                if (computedStyle.opacity === '0') {
                    gsap.set(element, { opacity: 1, x: 0, y: 0, scale: 1 });
                }
            });

            // Show children of stagger containers that might still be hidden
            document.querySelectorAll('.animate-stagger').forEach(container => {
                Array.from(container.children).forEach(child => {
                    const computedStyle = window.getComputedStyle(child);
                    if (computedStyle.opacity === '0') {
                        gsap.set(child, { opacity: 1, x: 0, y: 0, scale: 1 });
                    }
                });
            });
        }, 3000);

        // Respect user's motion preferences
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            // Remove gsap-ready class to show content immediately
            document.documentElement.classList.remove('gsap-ready');
            
            // Also set GSAP states for safety
            gsap.set('.animate-fade-in, .animate-slide-up, .animate-slide-left, .animate-slide-right, .animate-scale', { 
                opacity: 1, x: 0, y: 0, scale: 1 
            });
            
            document.querySelectorAll('.animate-stagger').forEach(container => {
                gsap.set(container.children, { opacity: 1, x: 0, y: 0, scale: 1 });
            });
        }
    }
}

// Export the animation manager
export default AnimationManager;

// GSAP + Alpine.js + Livewire Integration
let animationManager = null;

// Initialize animations with proper lifecycle hooks
function initializeAnimations() {
    if (animationManager) {
        animationManager.killAll();
    }
    
    animationManager = new AnimationManager();
    window.animationManager = animationManager;
}

// Hook into Livewire lifecycle
if (typeof Livewire !== 'undefined') {
    // Use Livewire hooks for proper timing
    Livewire.hook('message.processed', () => {
        // Wait for DOM updates to complete
        requestAnimationFrame(() => {
            if (animationManager) {
                animationManager.refresh();
            }
        });
    });
}

// Initialize after Alpine and DOM are ready
document.addEventListener('alpine:init', () => {
    // Wait for Alpine components to initialize
    Alpine.nextTick(() => {
        initializeAnimations();
    });
});

// Livewire navigation events
document.addEventListener('livewire:navigated', () => {
    // Reinitialize animations after navigation
    Alpine.nextTick(() => {
        initializeAnimations();
    });
});

// Fallback initialization
document.addEventListener('DOMContentLoaded', () => {
    // Only initialize if Alpine/Livewire haven't already
    setTimeout(() => {
        if (!animationManager) {
            initializeAnimations();
        }
    }, 1000);
});