<x-section-wrapper id="hero" variant="hero" spacing="none" class="relative pt-8 lg:pt-12 overflow-hidden min-h-[500px] lg:min-h-[600px] pb-0">
    <!-- Diagonal Fade Grid Background -->
    <div class="absolute inset-0 z-0"
         style="background-image: linear-gradient(to right, rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 32px 32px; -webkit-mask-image: radial-gradient(ellipse 70% 60% at 20% 40%, #000 40%, transparent 85%); mask-image: radial-gradient(ellipse 70% 60% at 20% 40%, #000 40%, transparent 85%);">
    </div>

    <!-- Mobile: Content first, then image below -->
    <div class="block lg:hidden">
        <!-- Mobile Hero Copy -->
        <div class="text-center flex flex-col justify-center z-10 relative pb-8 animate-fade-in">
            <!-- Trust Signal - Rating -->
            @if($consultantRating)
                <div class="flex flex-col items-center justify-center mb-4 animate-slide-up">
                    <div class="flex items-center ltr:space-x-1 rtl:space-x-reverse rtl:space-x-1 mb-1">
                        @for($i = 1; $i <= 5; $i++)
                            <x-heroicon-s-star class="h-4 w-4 text-golden-amber-400" />
                        @endfor
                    </div>
                    <x-ui.text size="small" color="white" as="span">{{ $consultantRating }}</x-ui.text>
                </div>
            @endif

            @if($heroTitle)
                <x-ui.heading level="1" color="white" class="mb-4 animate-slide-up">
                    {{ $heroTitle }}
                </x-ui.heading>
            @endif

            @if($heroSubtitle)
                <x-ui.text size="lead" color="white" class="mb-8 animate-slide-up">
                    {{ $heroSubtitle }}
                </x-ui.text>
            @endif

            <!-- CTA Button -->
            <div class="flex justify-center mb-8 animate-scale">
                <x-ui.button href="#contact" variant="golden" size="md">
                    {{ __('Beratung anfragen') }}
                </x-ui.button>
            </div>

            <!-- Benefits List -->
            <div class="space-y-4 sm:space-y-6">
                <x-ui.heading level="4" color="white" class="text-center mb-4 animate-slide-left">{{ __('Warum mich wählen?') }}</x-ui.heading>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 animate-stagger">
                    <div class="flex items-center justify-center ltr:sm:justify-start rtl:sm:justify-end space-x-3 rtl:space-x-reverse">
                        <x-heroicon-o-currency-euro class="w-5 h-5 text-golden-amber-300 flex-shrink-0" />
                        <x-ui.text color="white" as="span" size="small">{{ __('Kostenlose Erstberatung') }}</x-ui.text>
                    </div>
                    <div class="flex items-center justify-center ltr:sm:justify-start rtl:sm:justify-end space-x-3 rtl:space-x-reverse">
                        <x-heroicon-o-academic-cap class="w-5 h-5 text-golden-amber-300 flex-shrink-0" />
                        <x-ui.text color="white" as="span" size="small">{{ __('Über :experience Jahre Erfahrung', ['experience' => \App\Models\Setting::where('key', 'consultant_experience')->first()?->value]) }}</x-ui.text>
                    </div>
                    <div class="flex items-center justify-center ltr:sm:justify-start rtl:sm:justify-end space-x-3 rtl:space-x-reverse">
                        <x-heroicon-o-light-bulb class="w-5 h-5 text-golden-amber-300 flex-shrink-0" />
                        <x-ui.text color="white" as="span" size="small">{{ __('Individuelle Lösungen für Ihre Ziele') }}</x-ui.text>
                    </div>
                    <div class="flex items-center justify-center ltr:sm:justify-start rtl:sm:justify-end space-x-3 rtl:space-x-reverse">
                        <x-heroicon-o-clock class="w-5 h-5 text-golden-amber-300 flex-shrink-0" />
                        <x-ui.text color="white" as="span" size="small">{{ __('Terminflexibilität nach Ihren Wünschen') }}</x-ui.text>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Consultant Image - full height without cutting -->
        <div class="relative animate-slide-right">
            @if($profilePhoto)
                <img src="{{ $profilePhoto }}"
                     alt="{{ $consultantName }}"
                     class="w-full h-auto object-cover object-center" />
            @endif
        </div>
    </div>

    <!-- Desktop: Two column layout -->
    <div class="hidden lg:grid lg:grid-cols-2 gap-16 items-center pt-12">
        <!-- Left: Hero Copy -->
        <div class="ltr:text-left rtl:text-right flex flex-col justify-center z-10 relative pb-16 animate-fade-in">
            <!-- Trust Signal - Rating -->
            @if($consultantRating)
                <div class="flex flex-col ltr:items-start justify-start mb-4 animate-slide-up">
                    <div class="flex items-center ltr:space-x-1 rtl:space-x-reverse rtl:space-x-1 mb-1">
                        @for($i = 1; $i <= 5; $i++)
                            <x-heroicon-s-star class="h-4 w-4 text-golden-amber-400" />
                        @endfor
                    </div>
                    <x-ui.text size="small" color="white" as="span">{{ $consultantRating }}</x-ui.text>
                </div>
            @endif

            @if($heroTitle)
                <x-ui.heading level="1" color="white" class="mb-4 animate-slide-up">
                    {{ $heroTitle }}
                </x-ui.heading>
            @endif

            @if($heroSubtitle)
                <x-ui.text size="lead" color="white" class="mb-8 animate-slide-up">
                    {{ $heroSubtitle }}
                </x-ui.text>
            @endif

            <!-- CTA Button -->
            <div class="flex ltr:justify-start mb-8 animate-scale">
                <x-ui.button href="#contact" variant="golden" size="md">
                    {{ __('Beratung anfragen') }}
                </x-ui.button>
            </div>

            <!-- Benefits List -->
            <div class="space-y-6">
                <x-ui.heading level="4" color="white" class="ltr:text-left rtl:text-right mb-4 animate-slide-left">{{ __('Warum mich wählen?') }}</x-ui.heading>
                <div class="grid grid-cols-2 gap-4 animate-stagger">
                    <div class="flex items-center ltr:justify-start gap-3 rtl:space-x-reverse">
                        <x-heroicon-o-currency-euro class="w-5 h-5 text-golden-amber-300 flex-shrink-0" />
                        <x-ui.text color="white" as="span" size="small">{{ __('Kostenlose Erstberatung') }}</x-ui.text>
                    </div>
                    <div class="flex items-center ltr:justify-start gap-3 rtl:space-x-reverse">
                        <x-heroicon-o-academic-cap class="w-5 h-5 text-golden-amber-300 flex-shrink-0" />
                        <x-ui.text color="white" as="span" size="small">{{ __('Über :experience Jahre Erfahrung', ['experience' => \App\Models\Setting::where('key', 'consultant_experience')->first()?->value]) }}</x-ui.text>
                    </div>
                    <div class="flex items-center ltr:justify-start gap-3 rtl:space-x-reverse">
                        <x-heroicon-o-light-bulb class="w-5 h-5 text-golden-amber-300 flex-shrink-0" />
                        <x-ui.text color="white" as="span" size="small">{{ __('Individuelle Lösungen für Ihre Ziele') }}</x-ui.text>
                    </div>
                    <div class="flex items-center ltr:justify-start gap-3 rtl:space-x-reverse">
                        <x-heroicon-o-clock class="w-5 h-5 text-golden-amber-300 flex-shrink-0" />
                        <x-ui.text color="white" as="span" size="small">{{ __('Terminflexibilität nach Ihren Wünschen') }}</x-ui.text>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Consultant Image -->
        <div class="relative absolute bottom-0 right-0 h-full animate-slide-right">
            @if($profilePhoto)
                <img src="{{ $profilePhoto }}"
                     alt="{{ $consultantName }}"
                     class="h-full w-auto object-cover object-bottom" />
            @endif
        </div>
    </div>
</x-section-wrapper>
