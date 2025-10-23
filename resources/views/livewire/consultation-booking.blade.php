<div class="max-w-4xl mx-auto">
    @if(!$submitted)
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

        <flux:field class="mb-6">
            <flux:label>{{ __('Sonstige Anmerkungen') }}</flux:label>
            <flux:textarea wire:model="additionalNotes" rows="4" placeholder="{{ __('z.B. bevorzugte Termine, besondere Wünsche zur Beratung...') }}" />
        </flux:field>

        <div class="mb-6">
            <flux:checkbox wire:model="agreeToTerms" label="{{ __('Ich stimme den Nutzungsbedingungen zu') }} *" />
            <flux:error name="agreeToTerms" />
        </div>

        <div class="flex justify-end pt-6 border-t border-gray-200">
            <x-ui.button wire:click="submit" variant="primary" size="md">
                {{ __('Absenden') }}
            </x-ui.button>
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
