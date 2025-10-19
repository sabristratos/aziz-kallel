@php
use App\Models\Setting;

$consultantName = Setting::get('consultant_name', 'Abdelaziz Kallel');

$navigationItems = [
    [
        'label' => 'Über mich',
        'href' => localized_route('home') . '#about',
        'section' => 'about'
    ],
    [
        'label' => 'Referenzen',
        'href' => localized_route('home') . '#testimonials',
        'section' => 'testimonials'
    ],
    [
        'label' => 'Häufige Fragen',
        'href' => localized_route('home') . '#faq',
        'section' => 'faq'
    ],
    [
        'label' => 'Kontakt',
        'href' => localized_route('home') . '#contact',
        'section' => 'contact'
    ]
];
@endphp

<!-- Mobile Menu Component (body level) -->
<div x-data="{ 
        mobileMenuOpen: false,
        init() {
            this.$watch('mobileMenuOpen', value => {
                if (value) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            });
        }
     }"
     x-on:toggle-mobile-menu.window="mobileMenuOpen = !mobileMenuOpen"
     x-on:keydown.escape.window="mobileMenuOpen = false"
     class="lg:hidden">

    <!-- Mobile Menu Overlay -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false"
         class="fixed inset-0 z-[9998] bg-black bg-opacity-50"
         style="display: none;"
         x-cloak></div>

    <!-- Mobile Menu Panel -->
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed top-0 right-0 z-[9999] h-full w-full max-w-sm bg-white shadow-xl border-l border-slate-200"
         style="display: none;"
         x-cloak>
        
        <!-- Mobile Menu Header -->
        <div class="flex items-center justify-between p-6 border-b border-slate-200">
            <div class="flex items-center space-x-3">
                <!-- Consultant Info -->
                <div>
                    <x-ui.heading level="3" as="h2">{{ $consultantName }}</x-ui.heading>
                    <x-ui.text size="small" color="muted">Vermögensberater</x-ui.text>
                </div>
            </div>
            
            <!-- Close Button -->
            <button @click="mobileMenuOpen = false"
                    class="p-2 rounded-lg hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-science-blue-600 transition-colors duration-200">
                <x-heroicon-o-x-mark class="h-6 w-6 text-slate-900" />
            </button>
        </div>

        <!-- Mobile Menu Navigation -->
        <nav class="px-2 py-6 overflow-y-auto">
            <div class="space-y-1">
                @foreach($navigationItems as $item)
                    <a href="{{ $item['href'] }}" 
                       @click="mobileMenuOpen = false"
                       class="w-full flex items-center px-4 py-3 text-base font-medium border-l-4 border-transparent text-slate-900 hover:border-science-blue-300 hover:bg-slate-50 transition-all duration-200">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            <!-- Mobile CTA Section -->
            <div class="px-4 pt-6 mt-6 border-t border-slate-200">
                <x-ui.button href="{{ localized_route('home') }}#contact"
                           variant="golden"
                           class="w-full mb-3"
                           @click="mobileMenuOpen = false">
                    <x-heroicon-o-chat-bubble-left class="h-4 w-4 mr-2" />
                    Beratung anfragen
                </x-ui.button>
                
                @php
                    $contactPhone = Setting::get('contact_phone');
                    $contactEmail = Setting::get('contact_email');
                @endphp
                
                @if($contactPhone || $contactEmail)
                <div class="space-y-2">
                    @if($contactPhone)
                    <a href="tel:{{ $contactPhone }}"
                       class="flex items-center space-x-3 p-2 hover:bg-slate-50 rounded-lg transition-colors duration-200"
                       @click="mobileMenuOpen = false">
                        <x-heroicon-o-phone class="h-4 w-4" />
                        <x-ui.text size="small" color="muted" as="span" dir="ltr">{{ $contactPhone }}</x-ui.text>
                    </a>
                    @endif
                    
                    @if($contactEmail)
                    <a href="mailto:{{ $contactEmail }}" 
                       class="flex items-center space-x-3 p-2 hover:bg-slate-50 rounded-lg transition-colors duration-200"
                       @click="mobileMenuOpen = false">
                        <x-heroicon-o-envelope class="h-4 w-4" />
                        <x-ui.text size="small" color="muted" as="span">{{ $contactEmail }}</x-ui.text>
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </nav>
    </div>
</div>

