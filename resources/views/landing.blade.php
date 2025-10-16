@extends('components.layouts.landing')

@section('content')
    @php
        $landingHeadline = \App\Models\Setting::where('key', 'landing_headline')->first()?->value ?? 'Kostenlose Finanzberatung vereinbaren';
        $landingLede = \App\Models\Setting::where('key', 'landing_lede')->first()?->value ?? 'Professionelle Beratung für Ihre finanzielle Zukunft. Vereinbaren Sie jetzt ein unverbindliches Gespräch mit Ihrem persönlichen Finanzberater.';
        $consultantExperience = \App\Models\Setting::where('key', 'consultant_experience')->first()?->value ?? 'Seit 2009';
        $consultantCredentials = \App\Models\Setting::where('key', 'consultant_credentials')->first()?->value ?? 'IHK-Zertifizierung';
    @endphp

    <!-- Hero Header Section -->
    <div class="relative bg-gradient-to-br from-science-blue-400 via-science-blue-500 to-science-blue-600 overflow-hidden">
        <!-- Diagonal Fade Grid Background -->
        <div class="absolute inset-0 z-0"
             style="background-image: linear-gradient(to right, rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 32px 32px; -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 40%, #000 40%, transparent 85%); mask-image: radial-gradient(ellipse 70% 60% at 50% 40%, #000 40%, transparent 85%);">
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 py-12 sm:py-16">
            <!-- Language Switcher -->
            <div class="flex justify-center mb-8">
                <x-language-switcher-landing />
            </div>

            <!-- Headline Section -->
            <div class="text-center">
                <x-ui.heading level="1" color="white" class="mb-4 animate-slide-up">
                    {{ $landingHeadline }}
                </x-ui.heading>
                <x-ui.text size="lead" color="white" class="max-w-2xl mx-auto animate-slide-up">
                    {{ $landingLede }}
                </x-ui.text>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="max-w-4xl mx-auto px-4 py-8 sm:py-12">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
            <div class="max-w-2xl mx-auto">
                @livewire('consultation-booking')
            </div>
        </div>
    </div>

    <!-- Trust Indicators -->
    <div class="max-w-4xl mx-auto px-4 pb-12 sm:pb-16">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8">
            <div class="flex flex-col items-center text-center">
                <div class="w-14 h-14 bg-science-blue-100 rounded-full flex items-center justify-center mb-4">
                    <x-heroicon-o-shield-check class="w-7 h-7 text-science-blue-600" />
                </div>
                <x-ui.text class="font-semibold mb-1 text-gray-900">{{ __('Zertifiziert') }}</x-ui.text>
                <x-ui.text size="small" class="text-gray-600">{{ $consultantCredentials }}</x-ui.text>
            </div>

            <div class="flex flex-col items-center text-center">
                <div class="w-14 h-14 bg-science-blue-100 rounded-full flex items-center justify-center mb-4">
                    <x-heroicon-o-clock class="w-7 h-7 text-science-blue-600" />
                </div>
                <x-ui.text class="font-semibold mb-1 text-gray-900">{{ __('Erfahren') }}</x-ui.text>
                <x-ui.text size="small" class="text-gray-600">{{ $consultantExperience }}</x-ui.text>
            </div>

            <div class="flex flex-col items-center text-center">
                <div class="w-14 h-14 bg-science-blue-100 rounded-full flex items-center justify-center mb-4">
                    <x-heroicon-o-heart class="w-7 h-7 text-science-blue-600" />
                </div>
                <x-ui.text class="font-semibold mb-1 text-gray-900">{{ __('Persönlich') }}</x-ui.text>
                <x-ui.text size="small" class="text-gray-600">{{ __('Individuelle Beratung') }}</x-ui.text>
            </div>
        </div>
    </div>
@endsection