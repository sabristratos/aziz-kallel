<div>
<x-section-wrapper id="testimonials">
    <div class="rounded-3xl">
        <!-- Header -->
        <x-ui.section-header
            overline="{{ __('Referenzen') }}"
            title="{{ __('Was meine Kunden sagen') }}"
            description="{{ __('Erfahren Sie aus erster Hand, wie ich meinen Kunden bei ihren finanziellen Zielen geholfen habe.') }}"
            layout="two-column"
            class="animate-slide-up" />

        <!-- Carousel Wrapper with wire:ignore -->
        <div wire:ignore>
            <!-- Testimonials Carousel -->
            <div class="splide testimonials-splide" data-testimonials='{{ $this->testimonials->toJson() }}'>
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($this->testimonials as $testimonial)
                        <li class="splide__slide" wire:key="testimonial-{{ $testimonial->id }}">
                            <div class="bg-slate-100 rounded-2xl p-4 sm:p-6 h-full">
                                <!-- Quote Icon -->
                                <div class="mb-4 sm:mb-6 ltr:text-left rtl:text-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-8 sm:h-12 w-8 sm:w-12 text-science-blue-400 rtl:transform rtl:scale-x-[-1]">
                                        <path d="M15 10C15 7.23858 17.2386 5 20 5C20.5523 5 21 4.55228 21 4C21 3.44772 20.5523 3 20 3C16.134 3 13 6.13401 13 10V17.75C13 19.2688 14.2312 20.5 15.75 20.5H19.75C21.2688 20.5 22.5 19.2688 22.5 17.75V13.75C22.5 12.2312 21.2688 11 19.75 11H15.75C15.49 11 15.2384 11.0361 15 11.1035V10Z" fill="currentColor"></path>
                                        <path d="M3 10C3 7.23858 5.23858 5 8 5C8.55228 5 9 4.55228 9 4C9 3.44772 8.55228 3 8 3C4.13401 3 1 6.13401 1 10V17.75C1 19.2688 2.23122 20.5 3.75 20.5H7.75C9.26878 20.5 10.5 19.2688 10.5 17.75V13.75C10.5 12.2312 9.26878 11 7.75 11H3.75C3.48999 11 3.23842 11.0361 3 11.1035V10Z" fill="currentColor"></path>
                                    </svg>
                                </div>

                                <!-- Testimonial Content -->
                                <blockquote class="mb-3 sm:mb-4">
                                    <x-ui.text size="small" color="secondary" as="span" class="text-xs sm:text-sm">
                                        {{ $testimonial->content }}
                                    </x-ui.text>
                                </blockquote>

                                <!-- Client Details -->
                                <div class="ltr:border-l-4 rtl:border-r-4 border-science-blue-200 ltr:pl-3 ltr:sm:pl-4 rtl:pr-3 rtl:sm:pr-4 mt-auto">
                                    <x-ui.text size="small" class="font-semibold text-xs sm:text-sm" as="div">{{ $testimonial->client_name }}</x-ui.text>
                                    <x-ui.text size="xs" color="muted" class="mt-1 text-xs" as="div">{{ $testimonial->client_title ?? __('Kunde') }}</x-ui.text>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Navigation Controls -->
        <div class="flex justify-center items-center ltr:space-x-4 ltr:sm:space-x-6 rtl:space-x-reverse rtl:space-x-4 rtl:sm:space-x-6 mt-6 sm:mt-8">
            <!-- Previous Arrow -->
            <button class="splide-prev p-1.5 sm:p-2 border border-science-blue-300 text-science-blue-600 hover:border-science-blue-500 hover:text-science-blue-700 transition-colors duration-200 rounded-full bg-transparent rtl:rotate-180">
                <x-heroicon-s-chevron-left class="h-3 sm:h-4 w-3 sm:w-4" />
            </button>

            <!-- Navigation Dots -->
            <div class="splide__pagination flex ltr:space-x-2 rtl:space-x-reverse rtl:space-x-2"></div>

            <!-- Next Arrow -->
            <button class="splide-next p-1.5 sm:p-2 border border-science-blue-300 text-science-blue-600 hover:border-science-blue-500 hover:text-science-blue-700 transition-colors duration-200 rounded-full bg-transparent rtl:rotate-180">
                <x-heroicon-s-chevron-right class="h-3 sm:h-4 w-3 sm:w-4" />
            </button>
        </div>
        </div>
        <!-- End wire:ignore -->

        <!-- Submit Review Button -->
        <div class="flex justify-center mt-8 sm:mt-10">
            <x-ui.button
                wire:click="openModal"
                variant="primary"
                size="lg"
                icon="heroicon-o-star">
                {{ __('Bewertung schreiben') }}
            </x-ui.button>
        </div>

        <!-- Success Message -->
        @if($submitted)
            <div class="mt-6 bg-green-50 border border-green-200 rounded-lg p-4 text-center animate-fade-in">
                <div class="flex items-center justify-center mb-2">
                    <x-heroicon-o-check-circle class="w-6 h-6 text-green-600" />
                </div>
                <x-ui.text class="font-medium text-green-800">{{ __('Vielen Dank für Ihre Bewertung!') }}</x-ui.text>
                <x-ui.text size="small" class="text-green-700 mt-1">{{ __('Ihre Bewertung wurde erfolgreich übermittelt und wird nach Prüfung veröffentlicht.') }}</x-ui.text>
            </div>
        @endif
    </div>
</x-section-wrapper>

<!-- Review Submission Modal -->
<flux:modal wire:model="showModal" class="w-full max-w-2xl">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('Ihre Kundenbewertung') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Teilen Sie Ihre Erfahrungen mit anderen') }}</flux:text>
        </div>

        <form wire:submit.prevent="submit" class="space-y-6">
            {{-- Rating Sections --}}
            <div class="space-y-4">
                {{-- Consulting Rating --}}
                <div>
                    <flux:text class="font-medium mb-2">{{ __('Beratungskompetenz') }}</flux:text>
                    <div class="flex gap-2">
                        @for($i = 1; $i <= 5; $i++)
                            <button
                                type="button"
                                wire:click="$set('consulting_rating', {{ $i }})"
                                wire:key="consulting-star-{{ $i }}"
                                class="text-3xl transition-colors {{ $consulting_rating >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400"
                            >
                                ★
                            </button>
                        @endfor
                    </div>
                    @error('consulting_rating')
                        <flux:text class="text-red-600 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

                {{-- Satisfaction Rating --}}
                <div>
                    <flux:text class="font-medium mb-2">{{ __('Zufriedenheit') }}</flux:text>
                    <div class="flex gap-2">
                        @for($i = 1; $i <= 5; $i++)
                            <button
                                type="button"
                                wire:click="$set('satisfaction_rating', {{ $i }})"
                                wire:key="satisfaction-star-{{ $i }}"
                                class="text-3xl transition-colors {{ $satisfaction_rating >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400"
                            >
                                ★
                            </button>
                        @endfor
                    </div>
                    @error('satisfaction_rating')
                        <flux:text class="text-red-600 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

                {{-- Service Rating --}}
                <div>
                    <flux:text class="font-medium mb-2">{{ __('Servicequalität') }}</flux:text>
                    <div class="flex gap-2">
                        @for($i = 1; $i <= 5; $i++)
                            <button
                                type="button"
                                wire:click="$set('service_rating', {{ $i }})"
                                wire:key="service-star-{{ $i }}"
                                class="text-3xl transition-colors {{ $service_rating >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400"
                            >
                                ★
                            </button>
                        @endfor
                    </div>
                    @error('service_rating')
                        <flux:text class="text-red-600 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>
            </div>

            <flux:separator />

            {{-- Title Field (Optional) --}}
            <flux:field>
                <flux:label>{{ __('Überschrift') }} <span class="text-gray-400 text-sm">({{ __('optional') }})</span></flux:label>
                <flux:input
                    wire:model="title"
                    type="text"
                    placeholder="{{ __('Geben Sie eine Überschrift für Ihre Bewertung ein') }}"
                    maxlength="100"
                />
                <flux:error name="title" />
            </flux:field>

            {{-- Content Field (Required) --}}
            <flux:field>
                <flux:label>{{ __('Ihr Kommentar') }} <span class="text-red-600">*</span></flux:label>
                <flux:textarea
                    wire:model="content"
                    rows="5"
                    placeholder="{{ __('Teilen Sie Ihre Erfahrungen...') }}"
                    maxlength="300"
                />
                <div class="flex justify-between items-center mt-2">
                    <flux:error name="content" />
                    <flux:text class="text-sm text-gray-500">
                        {{ strlen($content) }}/300 {{ __('Zeichen') }}
                    </flux:text>
                </div>
            </flux:field>

            <flux:separator />

            {{-- Personal Information --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Client Name --}}
                <flux:field>
                    <flux:label>{{ __('Ihr Name') }} <span class="text-red-600">*</span></flux:label>
                    <flux:input
                        wire:model="client_name"
                        type="text"
                        placeholder="{{ __('Ihr vollständiger Name') }}"
                    />
                    <flux:error name="client_name" />
                </flux:field>

                {{-- Customer Since --}}
                <flux:field>
                    <flux:label>{{ __('Kunde seit') }} <span class="text-gray-400 text-sm">({{ __('optional') }})</span></flux:label>
                    <flux:select wire:model="customer_since">
                        <option value="">{{ __('Bitte wählen') }}</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}" wire:key="year-{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="customer_since" />
                </flux:field>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end gap-3 pt-4">
                <x-ui.button type="button" variant="outline" wire:click="$set('showModal', false)">
                    {{ __('Abbrechen') }}
                </x-ui.button>
                <x-ui.button type="submit" variant="primary">
                    {{ __('Bewertung absenden') }}
                </x-ui.button>
            </div>
        </form>
    </div>
</flux:modal>
</div>
