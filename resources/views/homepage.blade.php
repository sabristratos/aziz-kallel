@extends('components.layouts.public')

@section('content')
    <!-- Testimonials Section -->
    <x-testimonials.carousel id="testimonials" class="animate-fade-in" />

    <!-- About Section -->
    <x-section-wrapper id="about" class="bg-slate-100 rounded-3xl !pb-8 animate-fade-in">
        @php
            $aboutTitle = \App\Models\Setting::where('key', 'about_title')->first()?->value ?? 'Über mich';
            $aboutDescription = \App\Models\Setting::where('key', 'about_description')->first()?->value ?? 'Erfahren Sie mehr über meine Expertise und wie ich Ihnen bei Ihren finanziellen Zielen helfen kann.';
            $consultantName = \App\Models\Setting::where('key', 'consultant_name')->first()?->value;
            $profilePhotoSetting = \App\Models\Setting::where('key', 'consultant_profile_photo')->first();
            $profilePhoto = $profilePhotoSetting?->getFirstMediaUrl('profile_photo', 'high_quality');
        @endphp

        <!-- Header -->
        <x-ui.section-header 
            overline="Ihr Berater"
            title="{{ $aboutTitle }}"
            description="{{ $aboutDescription }}"
            layout="two-column"
            class="animate-slide-left" />

            <!-- Bento Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:h-96 animate-stagger">
                <!-- Left Column - Two benefits -->
                <div class="flex flex-col gap-4 md:col-span-1">
                    <!-- Benefit 1 -->
                    <x-ui.benefit-card
                        title="Expertise"
                        description="Über {{ \App\Models\Setting::where('key', 'consultant_experience')->first()?->value }} Jahre Erfahrung in der Finanzberatung"
                        icon="heroicon-o-academic-cap" />

                    <!-- Benefit 2 -->
                    <x-ui.benefit-card
                        title="Vertrauen"
                        description="Zertifizierter Berater bei der Deutschen Vermögensberatung"
                        icon="heroicon-o-shield-check" />
                </div>

                <!-- Middle Column - Consultant Image -->
                <div class="bg-science-blue-100 rounded-2xl overflow-hidden h-64 md:h-full order-first md:order-none">
                    @if($profilePhoto)
                        <img src="{{ $profilePhoto }}"
                             alt="{{ $consultantName }}"
                             class="h-full w-auto md:w-auto object-cover object-center mx-auto" />
                    @endif
                </div>

                <!-- Right Column - Two more benefits -->
                <div class="flex flex-col gap-4 md:col-span-1">
                    <!-- Benefit 3 -->
                    <x-ui.benefit-card
                        title="Persönlich"
                        description="Individuelle Beratung nach Ihren persönlichen Bedürfnissen"
                        icon="heroicon-o-heart" />

                    <!-- Benefit 4 -->
                    <x-ui.benefit-card
                        title="Flexibel"
                        description="Termine nach Ihren Wünschen - bei Ihnen zu Hause oder im Büro"
                        icon="heroicon-o-clock" />
                </div>
            </div>
    </x-section-wrapper>

    <!-- Consultation Booking Section -->
    <x-section-wrapper id="contact" class="animate-fade-in">
        <!-- Header -->
        <x-ui.section-header 
            overline="Kontakt"
            title="{{ __('Beratungstermin anfragen') }}"
            description="Lassen Sie uns gemeinsam Ihre finanzielle Zukunft planen. Fordern Sie noch heute ein unverbindliches Beratungsgespräch an."
            layout="two-column"
            class="animate-slide-up" />

            <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 lg:gap-0 animate-stagger">
                <!-- Left Column: Consultation Form -->
                <div class="lg:pr-8 xl:pr-12 lg:border-r lg:border-gray-200 animate-slide-left">
                    @livewire('consultation-booking')
                </div>

                <!-- Right Column: Contact Information -->
                <div class="lg:pl-8 xl:pl-12 animate-slide-right">
                    <x-ui.heading level="3" class="mb-4 sm:mb-6 text-lg sm:text-xl">Weitere Kontaktmöglichkeiten</x-ui.heading>

                    <!-- Direct Contact -->
                    <div class="space-y-4 sm:space-y-6 animate-stagger">
                        @php
                            $contactPhone = \App\Models\Setting::where('key', 'contact_phone')->first()?->value;
                        @endphp
                        @if($contactPhone)
                            <x-ui.contact-card
                                title="Direkter Anruf"
                                description="Rufen Sie mich gerne direkt an für eine sofortige Beratung."
                                action="{{ $contactPhone }}"
                                href="tel:{{ $contactPhone }}"
                                icon="heroicon-o-phone" />
                        @endif

                        <x-ui.contact-card
                            title="E-Mail Kontakt"
                            description="Senden Sie mir eine E-Mail mit Ihren Fragen oder Terminwünschen."
                            action="info@abdelaziz-kallel.de"
                            href="mailto:info@abdelaziz-kallel.de"
                            icon="heroicon-o-envelope" />

                        <x-ui.contact-card
                            title="Persönliche Beratung"
                            description="Ich komme gerne zu Ihnen nach Hause oder Sie besuchen mich in meinem Büro."
                            icon="heroicon-o-map-pin">
                            <x-ui.text class="font-medium">Flexibel nach Ihren Wünschen</x-ui.text>
                        </x-ui.contact-card>
                    </div>

                </div>
            </div>
    </x-section-wrapper>

    <!-- FAQ Section -->
    <x-section-wrapper id="faq" variant="hero" class="bg-gradient-to-br from-science-blue-400 via-science-blue-500 to-science-blue-600 rounded-3xl relative overflow-hidden animate-fade-in">
        <!-- Diagonal Fade Grid Background -->
        <div class="absolute inset-0 z-0" 
             style="background-image: linear-gradient(to right, rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 32px 32px; -webkit-mask-image: radial-gradient(ellipse 70% 60% at 80% 60%, #000 40%, transparent 85%); mask-image: radial-gradient(ellipse 70% 60% at 80% 60%, #000 40%, transparent 85%);">
        </div>
        
        <div class="relative z-10">
            <!-- Header -->
            <div class="grid lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-12 items-center mb-8 sm:mb-12 animate-slide-up">
                <!-- Left Column: Overline & Heading -->
                <div class="animate-slide-left">
                    <div class="flex items-center gap-2 mb-2 sm:mb-3 justify-start text-left">
                        <span class="text-xs font-semibold uppercase tracking-widest text-white">Häufige Fragen</span>
                        <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                    </div>
                    <x-ui.heading level="2" color="white" class="text-xl sm:text-2xl lg:text-3xl">Antworten auf Ihre wichtigsten Fragen</x-ui.heading>
                </div>
                <!-- Right Column: Description -->
                <div class="animate-slide-right">
                    <x-ui.text size="lead" color="white" class="text-sm sm:text-base lg:text-lg">Hier finden Sie die Antworten auf die am häufigsten gestellten Fragen zu meiner Finanzberatung.</x-ui.text>
                </div>
            </div>

            <x-faqs.section />
        </div>
    </x-section-wrapper>

    <!-- Floating Action Dock -->
    <x-floating-dock />
@endsection
