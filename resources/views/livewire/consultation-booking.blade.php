<div class="max-w-4xl mx-auto">
    @if(!$submitted)
        {{-- Progress Steps --}}
        <div class="mb-6 sm:mb-8">
            <div class="flex justify-center items-center space-x-2 sm:space-x-4">
                @for($i = 1; $i <= $totalSteps; $i++)
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full font-medium text-sm sm:text-base
                            {{ $i <= $currentStep ? 'bg-golden-amber-500 text-white' : 'bg-gray-200 text-gray-600' }}">
                            {{ $i }}
                        </div>
                        @if($i < $totalSteps)
                            <div class="w-6 sm:w-12 h-0.5 mx-1 sm:mx-2 
                                {{ $i < $currentStep ? 'bg-golden-amber-500' : 'bg-gray-200' }}"></div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>

        {{-- Step Content --}}
        <div>
            {{-- Step 1: Contact & Financial Topics --}}
            @if($currentStep === 1)
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('Kontakt & Interessen') }}</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-6">
                    <x-form.input 
                        label="{{ __('Vor- und Nachname') }}"
                        placeholder="Max Mustermann"
                        required="true"
                        wireModel="name"
                        :error="$errors->first('name')"
                    />

                    <x-form.input 
                        type="email"
                        label="{{ __('E-Mail-Adresse') }}"
                        placeholder="max.mustermann@beispiel.de"
                        required="true"
                        wireModel="email"
                        :error="$errors->first('email')"
                    />
                </div>

                <x-form.input 
                    type="tel"
                    label="{{ __('Telefonnummer') }}"
                    placeholder="+49 123 456 7890"
                    required="true"
                    wireModel="phone"
                    :error="$errors->first('phone')"
                    class="mb-6"
                />

                <div class="mb-4 sm:mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2 sm:mb-3">
                        {{ __('Welche Themen interessieren Sie?') }} *
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-3">
                        @foreach(['Altersvorsorge', 'Geldanlage', 'Versicherungen', 'Immobilienfinanzierung', 'Steueroptimierung', 'Vermögensaufbau'] as $topic)
                            <x-form.checkbox
                                label="{{ __($topic) }}"
                                value="{{ $topic }}"
                                wireModel="financialTopics"
                            />
                        @endforeach
                    </div>
                    @error('financialTopics') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            @endif

            {{-- Step 2: Meeting Preferences --}}
            @if($currentStep === 2)
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('Beratungsart') }}</h3>
                
                <div class="mb-4 sm:mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        {{ __('Wie möchten Sie beraten werden?') }} *
                    </label>
                    <div class="space-y-3">
                        @foreach(['Bei Ihnen zu Hause', 'In unserem Büro', 'Online per Video'] as $type)
                            <label class="flex items-center">
                                <input type="radio" wire:model="meetingType" value="{{ $type }}"
                                       class="text-golden-amber-500 focus:ring-golden-amber-500 focus:ring-offset-0">
                                <span class="ml-2 text-sm text-gray-700">{{ __($type) }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('meetingType') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-6">
                    <x-form.select
                        label="{{ __('Bevorzugte Kontaktaufnahme') }}"
                        wireModel="preferredContactMethod"
                        :options="[
                            'email' => __('E-Mail'),
                            'phone' => __('Telefon'),
                            'both' => __('Beides')
                        ]"
                    />

                    <x-form.select
                        label="{{ __('Wann passt es Ihnen am besten?') }}"
                        placeholder="Auswählen..."
                        wireModel="timePreference"
                        :options="[
                            'morning' => __('Vormittags'),
                            'afternoon' => __('Nachmittags'),
                            'evening' => __('Abends')
                        ]"
                    />
                </div>
            @endif

            {{-- Step 3: Details & Goals --}}
            @if($currentStep === 3)
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('Details & Ziele') }}</h3>
                
                <div class="space-y-6">
                    <x-form.textarea
                        label="{{ __('Aktuelle finanzielle Situation') }}"
                        placeholder="z.B. Angestellter mit 3000€ Netto, 50.000€ Erspartes, bestehende Lebensversicherung..."
                        rows="4"
                        wireModel="currentSituation"
                    />

                    <x-form.textarea
                        label="{{ __('Ihre konkreten Ziele und Wünsche') }}"
                        placeholder="z.B. Eigenheim in 5 Jahren, 1000€ monatliche Rente ab 65, Absicherung der Familie..."
                        rows="4"
                        wireModel="specificGoals"
                    />

                    <x-form.textarea
                        label="{{ __('Sonstige Anmerkungen') }}"
                        placeholder="z.B. bevorzugte Termine, besondere Wünsche zur Beratung..."
                        rows="3"
                        wireModel="additionalNotes"
                    />
                </div>
            @endif

            {{-- Step 4: Review & Confirmation --}}
            @if($currentStep === 4)
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('Zusammenfassung Ihrer Angaben') }}</h3>
                
                <div class="bg-gray-50 rounded-lg p-4 sm:p-6 mb-4 sm:mb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Kontaktdaten</h4>
                            <p class="text-sm text-gray-600">{{ $name }}</p>
                            <p class="text-sm text-gray-600">{{ $email }}</p>
                            <p class="text-sm text-gray-600">{{ $phone }}</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Beratungsart</h4>
                            <p class="text-sm text-gray-600">{{ __($meetingType) }}</p>
                            <p class="text-sm text-gray-600">Kontakt: {{ __($preferredContactMethod) }}</p>
                            @if($timePreference)
                                <p class="text-sm text-gray-600">Zeit: {{ __($timePreference) }}</p>
                            @endif
                        </div>
                    </div>

                    @if(count($financialTopics) > 0)
                        <div class="mt-4">
                            <h4 class="font-semibold text-gray-900 mb-2">Interessensgebiete</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($financialTopics as $topic)
                                    <span class="px-3 py-1 bg-golden-amber-500 text-white text-xs rounded-full">
                                        {{ __($topic) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mb-6">
                    <x-form.checkbox
                        label="{{ __('Ich stimme der Datenschutzerklärung zu') }} *"
                        wireModel="agreeToTerms"
                        :error="$errors->first('agreeToTerms')"
                    />
                </div>
            @endif

            {{-- Navigation Buttons --}}
            <div class="flex justify-between pt-6 border-t border-gray-200">
                @if($currentStep > 1)
                    <x-ui.button wire:click="previousStep" variant="outline" size="md">
                        {{ __('Zurück') }}
                    </x-ui.button>
                @else
                    <div></div>
                @endif

                @if($currentStep < $totalSteps)
                    <x-ui.button wire:click="nextStep" variant="primary" size="md">
                        {{ __('Weiter') }}
                    </x-ui.button>
                @else
                    <x-ui.button wire:click="submit" variant="primary" size="md">
                        {{ __('Absenden') }}
                    </x-ui.button>
                @endif
            </div>
        </div>

    @else
        {{-- Success Message --}}
        <div class="text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                <x-heroicon-o-check class="w-8 h-8 text-green-600" />
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ __('Vielen Dank!') }}</h3>
            <p class="text-gray-600 mb-2">{{ __('Ihre Anfrage wurde erfolgreich übermittelt.') }}</p>
            <p class="text-gray-600">{{ __('Wir melden uns zeitnah bei Ihnen.') }}</p>
        </div>
    @endif
</div>
