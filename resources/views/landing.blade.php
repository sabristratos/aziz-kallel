@extends('components.layouts.landing')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8 sm:py-12">
        @php
            $landingHeadline = \App\Models\Setting::where('key', 'landing_headline')->first()?->value ?? 'Kostenlose Finanzberatung vereinbaren';
            $landingLede = \App\Models\Setting::where('key', 'landing_lede')->first()?->value ?? 'Professionelle Beratung für Ihre finanzielle Zukunft. Vereinbaren Sie jetzt ein unverbindliches Gespräch mit Ihrem persönlichen Finanzberater.';
        @endphp

        <!-- Language Switcher -->
        <div class="flex justify-center mb-6">
            <x-language-switcher-landing />
        </div>

        <!-- Headline Section -->
        <div class="text-center mb-8 sm:mb-12">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                {{ $landingHeadline }}
            </h1>
            <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                {{ $landingLede }}
            </p>
        </div>

        <!-- Contact Form Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
            <div class="max-w-2xl mx-auto">
                @livewire('consultation-booking')
            </div>
        </div>

        <!-- Trust Indicators -->
        <div class="mt-8 sm:mt-12">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-science-blue-100 rounded-full flex items-center justify-center mb-3">
                        <x-heroicon-o-shield-check class="w-6 h-6 text-science-blue-600" />
                    </div>
                    <h3 class="font-medium text-gray-900 mb-1">{{ __('Zertifiziert') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('IHK-Zertifizierung') }}</p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-golden-amber-100 rounded-full flex items-center justify-center mb-3">
                        <x-heroicon-o-clock class="w-6 h-6 text-golden-amber-600" />
                    </div>
                    <h3 class="font-medium text-gray-900 mb-1">{{ __('Erfahren') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Seit 2009') }}</p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
                        <x-heroicon-o-heart class="w-6 h-6 text-green-600" />
                    </div>
                    <h3 class="font-medium text-gray-900 mb-1">{{ __('Persönlich') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Individuelle Beratung') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection