<!-- Desktop Navigation -->
<nav class="hidden lg:flex items-center ltr:space-x-1 rtl:space-x-reverse rtl:space-x-1 animate-stagger" {{ $attributes }}>
    <a href="{{ route('home') }}#about" class="nav-item relative inline-flex items-center transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 px-3 py-2 text-sm font-medium text-white/80 hover:text-golden-amber-300 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-golden-amber-400 after:rounded-full after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-200">
        <span>{{ __('Über mich') }}</span>
    </a>

    <a href="{{ route('home') }}#testimonials" class="nav-item relative inline-flex items-center transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 px-3 py-2 text-sm font-medium text-white/80 hover:text-golden-amber-300 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-golden-amber-400 after:rounded-full after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-200">
        <span>{{ __('Referenzen') }}</span>
    </a>

    <a href="{{ route('home') }}#faq" class="nav-item relative inline-flex items-center transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 px-3 py-2 text-sm font-medium text-white/80 hover:text-golden-amber-300 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-golden-amber-400 after:rounded-full after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-200">
        <span>{{ __('Häufige Fragen') }}</span>
    </a>

    <a href="{{ route('home') }}#contact" class="nav-item relative inline-flex items-center transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 px-3 py-2 text-sm font-medium text-white/80 hover:text-golden-amber-300 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-golden-amber-400 after:rounded-full after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-200">
        <span>{{ __('Kontakt') }}</span>
    </a>
</nav>

