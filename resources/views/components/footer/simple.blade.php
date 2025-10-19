@php
use App\Models\Setting;

// Get essential footer information from settings
$consultantName = Setting::where('key', 'consultant_name')->first()?->value ?? 'Abdelaziz Kallel';
$contactPhone = Setting::where('key', 'contact_phone')->first()?->value;
$contactEmail = Setting::where('key', 'contact_email')->first()?->value ?? 'info@abdelaziz-kallel.de';
@endphp

<footer class="bg-white mt-16 border-t border-gray-200">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Contact Info -->
        <div class="text-center mb-6">
            <h3 class="font-semibold text-gray-900 mb-3">{{ $consultantName }}</h3>
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-2 sm:space-y-0 sm:space-x-6 text-sm text-gray-600">
                @if($contactPhone)
                    <a href="tel:{{ $contactPhone }}"
                       class="flex items-center space-x-2 hover:text-golden-amber-600 transition-colors duration-200">
                        <x-heroicon-o-phone class="w-4 h-4" />
                        <span dir="ltr">{{ $contactPhone }}</span>
                    </a>
                @endif

                <a href="mailto:{{ $contactEmail }}"
                   class="flex items-center space-x-2 hover:text-golden-amber-600 transition-colors duration-200">
                    <x-heroicon-o-envelope class="w-4 h-4" />
                    <span>{{ $contactEmail }}</span>
                </a>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-200 pt-6">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                <!-- Copyright -->
                <div class="text-gray-600 text-sm text-center sm:text-left">
                    &copy; {{ date('Y') }} {{ $consultantName }}. {{ __('Alle Rechte vorbehalten') }}.
                </div>

                <!-- Legal Links -->
                <div class="flex items-center space-x-4 text-xs text-gray-500">
                    <a href="/impressum" class="hover:text-golden-amber-600 transition-colors duration-200">
                        {{ __('Impressum') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>