@php
use App\Models\Setting;

// Get contact information
$contactPhone = Setting::where('key', 'contact_phone')->first()?->value ?? '+49 123 456 789';
$whatsappNumber = str_replace([' ', '-', '(', ')'], '', $contactPhone);
$consultantName = Setting::where('key', 'consultant_name')->first()?->value ?? 'Abdelaziz Kallel';
@endphp

<!-- Floating Action Dock -->
<div class="fixed right-4 top-1/2 transform -translate-y-1/2 z-50 hidden lg:flex flex-col space-y-2 animate-slide-right">
    <!-- Call Button -->
    <div class="relative group animate-scale">
        <a href="tel:{{ $contactPhone }}" 
           class="flex items-center justify-center w-10 h-10 bg-science-blue-600/90 hover:bg-science-blue-600 text-white rounded-full shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
            <x-heroicon-o-phone class="w-4 h-4" />
        </a>
        <!-- Tooltip -->
        <div class="absolute right-12 top-1/2 transform -translate-y-1/2 bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap px-2 py-1">
            <x-ui.text size="xs" color="white" as="span">Jetzt anrufen</x-ui.text>
            <div class="absolute left-full top-1/2 transform -translate-y-1/2 border-4 border-transparent border-l-gray-900"></div>
        </div>
    </div>

    <!-- WhatsApp Button -->
    <div class="relative group animate-scale">
        <a href="https://wa.me/{{ $whatsappNumber }}?text=Hallo%20{{ urlencode($consultantName) }},%20ich%20interessiere%20mich%20für%20eine%20Finanzberatung." 
           target="_blank"
           class="flex items-center justify-center w-10 h-10 bg-green-500/90 hover:bg-green-500 text-white rounded-full shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.785"/>
            </svg>
        </a>
        <!-- Tooltip -->
        <div class="absolute right-12 top-1/2 transform -translate-y-1/2 bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap px-2 py-1">
            <x-ui.text size="xs" color="white" as="span">WhatsApp Nachricht</x-ui.text>
            <div class="absolute left-full top-1/2 transform -translate-y-1/2 border-4 border-transparent border-l-gray-900"></div>
        </div>
    </div>

    <!-- Download VCF Button -->
    <div class="relative group animate-scale">
        <a href="/vcf/abdelaziz-kallel.vcf" 
           download="Abdelaziz-Kallel-Kontakt.vcf"
           class="flex items-center justify-center w-10 h-10 bg-slate-600/90 hover:bg-slate-600 text-white rounded-full shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
            <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
        </a>
        <!-- Tooltip -->
        <div class="absolute right-12 top-1/2 transform -translate-y-1/2 bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap px-2 py-1">
            <x-ui.text size="xs" color="white" as="span">Kontakt speichern</x-ui.text>
            <div class="absolute left-full top-1/2 transform -translate-y-1/2 border-4 border-transparent border-l-gray-900"></div>
        </div>
    </div>

    <!-- Emergency Help Button -->
    <div class="relative group animate-scale">
        <a href="tel:112" 
           class="flex items-center justify-center w-10 h-10 bg-red-600/90 hover:bg-red-600 text-white rounded-full shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
            <x-heroicon-o-exclamation-triangle class="w-4 h-4" />
        </a>
        <!-- Tooltip -->
        <div class="absolute right-12 top-1/2 transform -translate-y-1/2 bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap px-2 py-1">
            <x-ui.text size="xs" color="white" as="span">Hilfe im Notfall (112)</x-ui.text>
            <div class="absolute left-full top-1/2 transform -translate-y-1/2 border-4 border-transparent border-l-gray-900"></div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div id="back-to-top" 
     class="fixed bottom-4 left-4 z-40 opacity-0 transform translate-y-2 transition-all duration-300 pointer-events-none animate-scale">
    <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="flex items-center justify-center w-12 h-12 bg-slate-600/90 hover:bg-slate-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
        <x-heroicon-o-arrow-up class="w-5 h-5" />
    </button>
</div>

<!-- Mobile Floating Action Button -->
<div class="fixed bottom-4 right-4 z-50 lg:hidden animate-scale">
    <div class="relative" x-data="{ open: false }">
        <!-- Main FAB -->
        <button @click="open = !open"
                class="flex items-center justify-center w-12 h-12 bg-science-blue-600/90 hover:bg-science-blue-600 text-white rounded-full shadow-md">
            <x-heroicon-o-phone class="w-5 h-5" x-show="!open" />
            <x-heroicon-o-x-mark class="w-5 h-5" x-show="open" x-cloak />
        </button>

        <!-- Action Menu -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             x-cloak
             class="absolute bottom-14 right-0 flex flex-col space-y-2">
            
            <!-- Call -->
            <a href="tel:{{ $contactPhone }}" 
               class="flex items-center justify-center w-10 h-10 bg-science-blue-600/90 text-white rounded-full shadow-md">
                <x-heroicon-o-phone class="w-4 h-4" />
            </a>

            <!-- WhatsApp -->
            <a href="https://wa.me/{{ $whatsappNumber }}?text=Hallo%20{{ urlencode($consultantName) }},%20ich%20interessiere%20mich%20für%20eine%20Finanzberatung." 
               target="_blank"
               class="flex items-center justify-center w-10 h-10 bg-green-500/90 text-white rounded-full shadow-md">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.785"/>
                </svg>
            </a>

            <!-- Download VCF -->
            <a href="/vcf/abdelaziz-kallel.vcf" 
               download="Abdelaziz-Kallel-Kontakt.vcf"
               class="flex items-center justify-center w-10 h-10 bg-slate-600/90 text-white rounded-full shadow-md">
                <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
            </a>

            <!-- Emergency -->
            <a href="tel:112" 
               class="flex items-center justify-center w-10 h-10 bg-red-600/90 text-white rounded-full shadow-md">
                <x-heroicon-o-exclamation-triangle class="w-4 h-4" />
            </a>
        </div>
    </div>
</div>