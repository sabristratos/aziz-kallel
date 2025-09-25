@php
use App\Models\Setting;

// Get footer information from settings
$consultantName = Setting::where('key', 'consultant_name')->first()?->value ?? 'Abdelaziz Kallel';
$contactPhone = Setting::where('key', 'contact_phone')->first()?->value;
$contactEmail = Setting::where('key', 'contact_email')->first()?->value ?? 'info@abdelaziz-kallel.de';
$consultantAddress = Setting::where('key', 'consultant_address')->first()?->value;
$consultantCity = Setting::where('key', 'consultant_city')->first()?->value;
$consultantPostalCode = Setting::where('key', 'consultant_postal_code')->first()?->value;
$consultantExperience = Setting::where('key', 'consultant_experience')->first()?->value;

// Get profile photo for branding
$profilePhotoSetting = Setting::where('key', 'consultant_profile_photo')->first();
$profilePhoto = $profilePhotoSetting?->getFirstMediaUrl('profile_photo', 'thumb');
@endphp

<x-section-wrapper class="bg-slate-100 rounded-3xl mt-16 animate-fade-in">
    <!-- Main Footer Content -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mb-8">
            <!-- Brand Column -->
            <div class="lg:col-span-1">
                <div class="flex items-center space-x-3 mb-4">
                    @if($profilePhoto)
                        <img src="{{ $profilePhoto }}" 
                             alt="{{ $consultantName }}" 
                             class="w-12 h-12 rounded-full object-cover" />
                    @endif
                    <div>
                        <h3 class="font-semibold text-lg text-slate-900">{{ $consultantName }}</h3>
                        <p class="text-slate-600 text-sm">{{ __('Vermögensberater') }}</p>
                    </div>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                    {{ __('Professionelle Finanzberatung mit über :experience Jahren Erfahrung. Individuelle Lösungen für Ihre finanziellen Ziele.', ['experience' => $consultantExperience]) }}
                </p>
                
                <!-- Social Media -->
                <div class="flex space-x-4">
                    <a href="https://www.instagram.com/abdelaziz_kallel/" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="text-slate-600 hover:text-golden-amber-600 transition-colors duration-200">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="lg:col-span-1">
                <h4 class="font-semibold text-slate-900 mb-4">{{ __('Navigation') }}</h4>
                <nav class="space-y-3">
                    <a href="#about" class="block text-slate-600 hover:text-golden-amber-600 transition-colors duration-200 text-sm">
                        {{ __('Über mich') }}
                    </a>
                    <a href="#testimonials" class="block text-slate-600 hover:text-golden-amber-600 transition-colors duration-200 text-sm">
                        {{ __('Referenzen') }}
                    </a>
                    <a href="#faq" class="block text-slate-600 hover:text-golden-amber-600 transition-colors duration-200 text-sm">
                        {{ __('Häufige Fragen') }}
                    </a>
                    <a href="#contact" class="block text-slate-600 hover:text-golden-amber-600 transition-colors duration-200 text-sm">
                        {{ __('Kontakt') }}
                    </a>
                </nav>
            </div>

            <!-- Contact Information -->
            <div class="lg:col-span-1">
                <h4 class="font-semibold text-slate-900 mb-4">{{ __('Kontakt') }}</h4>
                <div class="space-y-3">
                    @if($contactPhone)
                        <a href="tel:{{ $contactPhone }}" 
                           class="flex items-center space-x-3 text-slate-600 hover:text-golden-amber-600 transition-colors duration-200 text-sm">
                            <x-heroicon-o-phone class="w-4 h-4 flex-shrink-0" />
                            <span>{{ $contactPhone }}</span>
                        </a>
                    @endif
                    
                    <a href="mailto:{{ $contactEmail }}" 
                       class="flex items-center space-x-3 text-slate-600 hover:text-golden-amber-600 transition-colors duration-200 text-sm">
                        <x-heroicon-o-envelope class="w-4 h-4 flex-shrink-0" />
                        <span>{{ $contactEmail }}</span>
                    </a>
                    
                    @if($consultantAddress && $consultantCity && $consultantPostalCode)
                        <div class="flex items-start space-x-3 text-slate-600 text-sm">
                            <x-heroicon-o-map-pin class="w-4 h-4 flex-shrink-0 mt-0.5" />
                            <div>
                                <div>{{ $consultantAddress }}</div>
                                <div>{{ $consultantPostalCode }} {{ $consultantCity }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Services & Legal -->
            <div class="lg:col-span-1">
                <h4 class="font-semibold text-slate-900 mb-4">{{ __('Service') }}</h4>
                <div class="space-y-3">
                    <div class="text-slate-600 text-sm">
                        <x-heroicon-o-shield-check class="w-4 h-4 inline mr-2 text-science-blue-600" />
                        {{ __('Deutsche Vermögensberatung') }}
                    </div>
                    <div class="text-slate-600 text-sm">
                        <x-heroicon-o-clock class="w-4 h-4 inline mr-2 text-science-blue-600" />
                        {{ __('Über :experience Jahre Erfahrung', ['experience' => $consultantExperience]) }}
                    </div>
                    <div class="text-slate-600 text-sm">
                        <x-heroicon-o-heart class="w-4 h-4 inline mr-2 text-science-blue-600" />
                        {{ __('Persönliche Beratung') }}
                    </div>
                </div>

                <!-- Legal Links -->
                <div class="mt-6 space-y-2">
                    <a href="/datenschutz" class="block text-slate-500 hover:text-golden-amber-600 transition-colors duration-200 text-xs">
                        {{ __('Datenschutz') }}
                    </a>
                    <a href="/impressum" class="block text-slate-500 hover:text-golden-amber-600 transition-colors duration-200 text-xs">
                        {{ __('Impressum') }}
                    </a>
                    <button onclick="window.dispatchEvent(new CustomEvent('edit-cookies'))" 
                            class="block text-slate-500 hover:text-golden-amber-600 transition-colors duration-200 text-xs">
                        {{ __('Cookies bearbeiten') }}
                    </button>
                </div>
            </div>
        </div>

    <!-- Bottom Bar -->
    <div class="border-t border-slate-300 pt-6">
        <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
            <!-- Copyright -->
            <div class="text-slate-600 text-sm">
                &copy; {{ date('Y') }} {{ $consultantName }}. {{ __('Alle Rechte vorbehalten') }}.
            </div>
            
            <!-- Credits -->
            <div class="flex items-center space-x-2 text-xs text-slate-500">
                <a href="https://www.rosa-media.net/" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="hover:text-golden-amber-600 transition-colors duration-200">
                    Rosa Media
                </a>
                <span>powered by</span>
                <a href="https://stratosdigital.io/" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="hover:text-golden-amber-600 transition-colors duration-200">
                    Stratos
                </a>
            </div>
        </div>
    </div>
</x-section-wrapper>