<div class="max-w-4xl mx-auto">
    @if(!$submitted)
        {{-- Progress Steps --}}
        <div class="mb-6 sm:mb-8">
            <div class="flex justify-center items-center ltr:space-x-2 ltr:sm:space-x-4 rtl:space-x-reverse rtl:space-x-2 rtl:sm:space-x-4">
                @for($i = 1; $i <= $totalSteps; $i++)
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full font-medium text-sm sm:text-base
                            {{ $i <= $currentStep ? 'bg-golden-amber-500 text-white' : 'bg-gray-200 text-gray-600' }}">
                            {{ $i }}
                        </div>
                        @if($i < $totalSteps)
                            <div class="w-6 sm:w-12 h-0.5 ltr:mx-1 ltr:sm:mx-2 rtl:mx-1 rtl:sm:mx-2
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
                    <flux:field>
                        <flux:label>{{ __('Vorname') }} *</flux:label>
                        <flux:input wire:model="first_name" placeholder="Max" />
                        <flux:error name="first_name" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Nachname') }} *</flux:label>
                        <flux:input wire:model="last_name" placeholder="Mustermann" />
                        <flux:error name="last_name" />
                    </flux:field>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-6">
                    <flux:field>
                        <flux:label>{{ __('E-Mail-Adresse') }} *</flux:label>
                        <flux:input type="email" wire:model="email" placeholder="max.mustermann@beispiel.de" />
                        <flux:error name="email" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Telefonnummer') }} *</flux:label>
                        <flux:input type="tel" wire:model="phone" placeholder="+49 123 456 7890" />
                        <flux:error name="phone" />
                    </flux:field>
                </div>

                <flux:checkbox.group wire:model="financialTopics" label="{{ __('Welche Themen interessieren Sie?') }} *" class="mb-4 sm:mb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-3">
                        @foreach(['Kennenlernentermin', 'Altersvorsorge', 'Geldanlage', 'Absicherung', 'Immobilienfinanzierung', 'Steueroptimierung', 'Vermögensaufbau', 'Sonstiges'] as $topic)
                            <flux:checkbox value="{{ $topic }}" label="{{ __($topic) }}" />
                        @endforeach
                    </div>
                </flux:checkbox.group>
                <flux:error name="financialTopics" />
            @endif

            {{-- Step 2: Meeting Preferences --}}
            @if($currentStep === 2)
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('Beratungsart') }}</h3>

                <flux:radio.group wire:model="meetingType" label="{{ __('Wie möchten Sie beraten werden?') }} *" class="mb-4 sm:mb-6">
                    @foreach(['Bei Ihnen zu Hause', 'In unserem Büro', 'Online per Video'] as $type)
                        <flux:radio value="{{ $type }}" label="{{ __($type) }}" />
                    @endforeach
                </flux:radio.group>
                <flux:error name="meetingType" />

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-6">
                    <flux:field>
                        <flux:label>{{ __('Bevorzugte Kontaktaufnahme') }}</flux:label>
                        <flux:select wire:model="preferredContactMethod" variant="listbox">
                            <flux:select.option value="email">{{ __('E-Mail') }}</flux:select.option>
                            <flux:select.option value="phone">{{ __('Telefon') }}</flux:select.option>
                            <flux:select.option value="both">{{ __('Beides') }}</flux:select.option>
                        </flux:select>
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Wann passt es Ihnen am besten?') }}</flux:label>
                        <flux:select wire:model="timePreference" variant="listbox" placeholder="{{ __('Auswählen...') }}">
                            <flux:select.option value="morning">{{ __('Vormittags') }}</flux:select.option>
                            <flux:select.option value="afternoon">{{ __('Nachmittags') }}</flux:select.option>
                            <flux:select.option value="evening">{{ __('Abends') }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                </div>
            @endif

            {{-- Step 3: Details & Goals --}}
            @if($currentStep === 3)
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('Details & Ziele') }}</h3>

                <div class="space-y-6">
                    <flux:field>
                        <flux:label>{{ __('Aktuelle finanzielle Situation') }}</flux:label>
                        <flux:textarea wire:model="currentSituation" rows="4" placeholder="z.B. Angestellter mit 3000€ Netto, 50.000€ Erspartes, bestehende Lebensversicherung..." />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Ihre konkreten Ziele und Wünsche') }}</flux:label>
                        <flux:textarea wire:model="specificGoals" rows="4" placeholder="z.B. Eigenheim in 5 Jahren, 1000€ monatliche Rente ab 65, Absicherung der Familie..." />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Sonstige Anmerkungen') }}</flux:label>
                        <flux:textarea wire:model="additionalNotes" rows="3" placeholder="z.B. bevorzugte Termine, besondere Wünsche zur Beratung..." />
                    </flux:field>
                </div>
            @endif

            {{-- Step 4: Review & Confirmation --}}
            @if($currentStep === 4)
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('Zusammenfassung Ihrer Angaben') }}</h3>

                <div class="bg-gray-50 rounded-lg p-4 sm:p-6 mb-4 sm:mb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">{{ __('Kontaktdaten') }}</h4>
                            <p class="text-sm text-gray-600">{{ $first_name }} {{ $last_name }}</p>
                            <p class="text-sm text-gray-600">{{ $email }}</p>
                            <p class="text-sm text-gray-600">{{ $phone }}</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">{{ __('Beratungsart') }}</h4>
                            <p class="text-sm text-gray-600">{{ __($meetingType) }}</p>
                            <p class="text-sm text-gray-600">{{ __('Kontakt') }}: {{ __($preferredContactMethod) }}</p>
                            @if($timePreference)
                                <p class="text-sm text-gray-600">{{ __('Zeit') }}: {{ __($timePreference) }}</p>
                            @endif
                        </div>
                    </div>

                    @if(count($financialTopics) > 0)
                        <div class="mt-4">
                            <h4 class="font-semibold text-gray-900 mb-2">{{ __('Interessensgebiete') }}</h4>
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
                    <flux:checkbox wire:model="agreeToTerms" label="{{ __('Ich stimme den Nutzungsbedingungen zu') }} *" />
                    <flux:error name="agreeToTerms" />
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
