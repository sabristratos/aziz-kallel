@php
use App\Models\Setting;

// Get consultant information from settings using the get method
$consultantName = Setting::get('consultant_name', 'Abdelaziz Kallel');
$consultantTitle = Setting::get('consultant_title', 'Vermögensberater');
$consultantCredentials = Setting::get('consultant_credentials');
$consultantExperience = Setting::get('consultant_experience');
$consultantTeam = Setting::get('consultant_team_size');
$consultantRating = Setting::get('consultant_rating');
$contactPhone = Setting::get('contact_phone');
$contactEmail = Setting::get('contact_email');

// Get profile photo - use original image only
$profilePhotoSetting = Setting::where('key', 'consultant_profile_photo')->first();
$profilePhoto = $profilePhotoSetting?->getFirstMediaUrl('profile_photo');
@endphp

<x-ui.popover trigger-type="hover" position="bottom-left" width="w-80">
    <x-slot name="trigger">
        <a href="{{ localized_route('home') }}" class="flex items-center ltr:space-x-4 rtl:space-x-reverse rtl:space-x-4 p-3 rounded-xl transition-all duration-200 cursor-pointer group">
            <!-- Avatar -->
            <x-ui.avatar 
                :src="$profilePhoto" 
                :alt="$consultantName" 
                size="xl"
                class="group-hover:scale-105 transition-transform duration-200" />
            
            <!-- Basic Info -->
            <div class="flex flex-col min-w-0">
                <div class="font-semibold text-white text-sm truncate">
                    {{ $consultantName }}
                </div>
                <div class="text-white/80 text-xs truncate">
                    {{ $consultantTitle }}
                </div>
            </div>
            
            <!-- Chevron indicator -->
            <x-heroicon-s-chevron-down class="h-4 w-4 text-white/80 group-hover:text-white transition-colors duration-200" />
        </a>
    </x-slot>

    <!-- Popover Content -->
    <div class="space-y-4">
        <!-- Header without avatar -->
        <div class="pb-3 border-b border-slate-200">
            <h3 class="font-semibold text-slate-900 text-lg">{{ $consultantName }}</h3>
            <p class="text-science-blue-600 text-sm font-medium">{{ $consultantTitle }}</p>
            
            @php
                $contactAddress = Setting::get('contact_address_street') . ', ' . Setting::get('contact_address_city');
                $companyName = Setting::get('company_name');
            @endphp
            
            @if($companyName)
            <p class="text-slate-500 text-xs mt-1">{{ $companyName }}</p>
            @endif
            
            @if($contactAddress && $contactAddress !== ', ')
            <p class="text-slate-500 text-xs">{{ $contactAddress }}</p>
            @endif
        </div>

        <!-- Credentials and Experience -->
        <div class="space-y-3">
            @if($consultantCredentials)
            <div class="flex items-start space-x-2 rtl:space-x-reverse">
                <x-heroicon-o-academic-cap class="h-4 w-4 text-science-blue-600 mt-0.5 shrink-0" />
                <div>
                    <p class="text-xs text-slate-500">{{ __('Qualifikation') }}</p>
                    <p class="text-sm text-slate-900">{{ $consultantCredentials }}</p>
                </div>
            </div>
            @endif

            @if($consultantExperience)
            <div class="flex items-start space-x-2 rtl:space-x-reverse">
                <x-heroicon-o-calendar-days class="h-4 w-4 text-science-blue-600 mt-0.5 shrink-0" />
                <div>
                    <p class="text-xs text-slate-500">{{ __('Erfahrung') }}</p>
                    <p class="text-sm text-slate-900">{{ $consultantExperience }}</p>
                </div>
            </div>
            @endif

            @if($consultantTeam)
            <div class="flex items-start space-x-2 rtl:space-x-reverse">
                <x-heroicon-o-users class="h-4 w-4 text-science-blue-600 mt-0.5 shrink-0" />
                <div>
                    <p class="text-xs text-slate-500">{{ __('Team') }}</p>
                    <p class="text-sm text-slate-900">{{ $consultantTeam }}</p>
                </div>
            </div>
            @endif

            @if($consultantRating)
            <div class="flex items-start space-x-2 rtl:space-x-reverse">
                <x-heroicon-s-star class="h-4 w-4 text-yellow-500 mt-0.5 shrink-0" />
                <div>
                    <p class="text-xs text-slate-500">{{ __('Bewertung') }}</p>
                    <p class="text-sm text-slate-900">{{ $consultantRating }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Contact Information -->
        @if($contactPhone || $contactEmail)
        <div class="pt-3 border-t border-slate-200">
            <p class="text-xs text-slate-500 mb-2">{{ __('Kontakt') }}</p>
            <div class="space-y-2">
                @if($contactPhone)
                <a href="tel:{{ $contactPhone }}"
                   class="flex items-center space-x-2 rtl:space-x-reverse text-sm text-slate-900 hover:text-science-blue-600 transition-colors duration-200">
                    <x-heroicon-o-phone class="h-4 w-4" />
                    <span>{{ $contactPhone }}</span>
                </a>
                @endif
                
                @if($contactEmail)
                <a href="mailto:{{ $contactEmail }}"
                   class="flex items-center space-x-2 rtl:space-x-reverse text-sm text-slate-900 hover:text-science-blue-600 transition-colors duration-200">
                    <x-heroicon-o-envelope class="h-4 w-4" />
                    <span>{{ $contactEmail }}</span>
                </a>
                @endif
            </div>
        </div>
        @endif

        <!-- CTA -->
        <div class="pt-2">
            <x-ui.button href="#contact" variant="golden" size="sm" class="w-full">
                <x-heroicon-o-chat-bubble-left class="h-4 w-4 ltr:mr-2 rtl:ml-2" />
                {{ __('Beratung anfragen') }}
            </x-ui.button>
        </div>
    </div>
</x-ui.popover>