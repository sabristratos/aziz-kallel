@props(['currentSection' => null])

@php
use App\Models\Setting;
$consultantName = Setting::get('consultant_name', 'Abdelaziz Kallel');
@endphp

<header class="z-30 animate-slide-up" x-data="{}">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">

            <!-- Left: Consultant Info Card (Desktop) / Logo (Mobile) -->
            <div class="flex items-center animate-slide-left">
                <!-- Desktop: Consultant Info Card -->
                <div class="hidden lg:block">
                    <x-header.consultant-info-card />
                </div>

                <!-- Mobile: Simple Logo/Name -->
                <div class="lg:hidden">
                    <a href="#hero" class="flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 rounded-lg p-1">
                        <div class="flex flex-col">
                            <span class="font-semibold text-white text-base">{{ $consultantName }}</span>
                            <span class="text-xs text-white/80">Vermögensberater</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Center: Main Navigation (Desktop Only) -->
            <div class="hidden lg:flex flex-1 justify-center animate-fade-in">
                <x-header.navigation :current-section="$currentSection" />
            </div>

            <!-- Right: CTA Button (Desktop) / Mobile Menu (Mobile) -->
            <div class="flex items-center space-x-4 animate-slide-right">
                <!-- Desktop CTA -->
                <div class="hidden lg:block">
                    <x-ui.button href="#contact" variant="golden" size="md">
                        <x-heroicon-o-chat-bubble-left class="h-4 w-4 mr-2" />
                        Beratung anfragen
                    </x-ui.button>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button @click="$dispatch('toggle-mobile-menu')"
                            class="p-2 rounded-lg hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/20 transition-colors duration-200 animate-scale"
                            aria-label="Hauptmenü öffnen">
                        <x-heroicon-o-bars-3 class="h-6 w-6 text-white" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

@once
@push('styles')
<style>
/* Header backdrop blur effect */
.supports-backdrop-filter\:bg-white\/75 {
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

/* Smooth header animations */
header {
    transition: all 0.3s ease-in-out;
}

/* Header shadow on scroll */
.header-scrolled {
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
}

/* Logo/name bounce animation on page load */
@keyframes gentle-bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-2px);
    }
}

.logo-bounce {
    animation: gentle-bounce 2s ease-in-out;
}

/* Navigation item hover effects */
.nav-item {
    position: relative;
    overflow: hidden;
}

.nav-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(var(--color-science-blue-500), 0.1),
        transparent
    );
    transition: left 0.5s;
}

.nav-item:hover::before {
    left: 100%;
}
</style>
@endpush
@endonce

@once
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    let lastScrollY = window.scrollY;

    // Header scroll effects
    function updateHeader() {
        const scrollY = window.scrollY;

        // Add shadow when scrolled
        if (scrollY > 10) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }

        lastScrollY = scrollY;
    }

    // Throttled scroll handler
    let ticking = false;
    function handleScroll() {
        if (!ticking) {
            requestAnimationFrame(() => {
                updateHeader();
                ticking = false;
            });
            ticking = true;
        }
    }

    window.addEventListener('scroll', handleScroll);

    // Initial call
    updateHeader();

    // Add logo bounce animation after page load
    setTimeout(() => {
        const logo = document.querySelector('header a[href="#hero"]');
        if (logo) {
            logo.classList.add('logo-bounce');
        }
    }, 500);
});
</script>
@endpush
@endonce
