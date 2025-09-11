@props(['currentSection' => null])

@php
$navigationItems = [
    [
        'label' => 'Über mich',
        'href' => '#about',
        'section' => 'about'
    ],
    [
        'label' => 'Referenzen',
        'href' => '#testimonials',
        'section' => 'testimonials'
    ],
    [
        'label' => 'Häufige Fragen',
        'href' => '#faq',
        'section' => 'faq'
    ],
    [
        'label' => 'Kontakt',
        'href' => '#contact',
        'section' => 'contact'
    ]
];
@endphp

<!-- Desktop Navigation -->
<nav class="hidden lg:flex items-center space-x-1 animate-stagger" {{ $attributes }}>
    @foreach($navigationItems as $item)
        <x-ui.nav-item 
            :href="$item['href']"
            :active="$currentSection === $item['section']"
            class="nav-item">
            {{ $item['label'] }}
        </x-ui.nav-item>
    @endforeach
</nav>

@once
@push('scripts')
<script>
// Add smooth scrolling and active section detection
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const target = document.getElementById(targetId);
            
            if (target) {
                // Calculate header height for proper offset
                const header = document.querySelector('header') || document.querySelector('.header');
                const headerHeight = header ? header.offsetHeight : 80;
                const offsetTop = target.offsetTop - headerHeight - 20; // Extra 20px padding
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Active section detection on scroll
    const sections = document.querySelectorAll('section[id]');
    const navItems = document.querySelectorAll('.nav-item');
    
    function updateActiveNav() {
        if (sections.length === 0) return;
        
        let current = '';
        const scrollPos = window.scrollY + 120; // Account for header height
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                current = section.getAttribute('id');
            }
        });

        // If at top of page, highlight hero section
        if (window.scrollY < 100) {
            current = 'hero';
        }

        navItems.forEach(item => {
            const href = item.getAttribute('href');
            if (href === '#' + current) {
                item.classList.add('text-golden-amber-400');
                item.classList.remove('text-white/80');
            } else {
                item.classList.remove('text-golden-amber-400');
                item.classList.add('text-white/80');
            }
        });
    }

    // Throttle scroll events for better performance
    let ticking = false;
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateActiveNav);
            ticking = true;
        }
    }

    window.addEventListener('scroll', () => {
        requestTick();
        ticking = false;
    });
    
    updateActiveNav(); // Initial call
});
</script>
@endpush
@endonce