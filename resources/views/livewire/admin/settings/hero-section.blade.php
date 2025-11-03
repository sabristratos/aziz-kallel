<div class="flex h-full w-full flex-1 flex-col gap-6">
    {{-- Breadcrumbs --}}
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>{{ __('Dashboard') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('admin.settings') }}" wire:navigate>{{ __('Settings') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Hero Section') }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ __('Hero Section Settings') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Manage your homepage hero section content') }}</flux:text>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-zinc-800">
        <div class="border-b border-neutral-200 px-6 py-4 dark:border-neutral-700">
            <div class="flex items-center justify-between">
                <flux:heading size="lg">{{ __('Hero Content') }}</flux:heading>
                <div class="flex items-center gap-2">
                    {{-- Language Switcher --}}
                    <flux:button
                        size="sm"
                        :variant="$currentLanguage === 'de' ? 'primary' : 'ghost'"
                        wire:click="switchLanguage('de')"
                    >
                        {{ __('German') }}
                    </flux:button>
                    <flux:button
                        size="sm"
                        :variant="$currentLanguage === 'ar' ? 'primary' : 'ghost'"
                        wire:click="switchLanguage('ar')"
                    >
                        {{ __('Arabic') }}
                    </flux:button>
                </div>
            </div>
        </div>

        <form wire:submit="save" class="p-6 space-y-6">
            {{-- German Content --}}
            @if($currentLanguage === 'de')
                <flux:field>
                    <flux:label>{{ __('Title (German)') }}</flux:label>
                    <flux:input wire:model="form.hero_title_de" />
                    <flux:error name="form.hero_title_de" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Subtitle (German)') }}</flux:label>
                    <flux:input wire:model="form.hero_subtitle_de" />
                    <flux:error name="form.hero_subtitle_de" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Description (German)') }}</flux:label>
                    <flux:textarea wire:model="form.hero_description_de" rows="4" />
                    <flux:error name="form.hero_description_de" />
                </flux:field>
            @endif

            {{-- Arabic Content --}}
            @if($currentLanguage === 'ar')
                <flux:field>
                    <flux:label>{{ __('Title (Arabic)') }}</flux:label>
                    <flux:input wire:model="form.hero_title_ar" dir="rtl" />
                    <flux:error name="form.hero_title_ar" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Subtitle (Arabic)') }}</flux:label>
                    <flux:input wire:model="form.hero_subtitle_ar" dir="rtl" />
                    <flux:error name="form.hero_subtitle_ar" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Description (Arabic)') }}</flux:label>
                    <flux:textarea wire:model="form.hero_description_ar" rows="4" dir="rtl" />
                    <flux:error name="form.hero_description_ar" />
                </flux:field>
            @endif

            {{-- Save Button --}}
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary" wire:dirty.attr="enabled" disabled class="opacity-50 cursor-not-allowed" wire:dirty.class.remove="opacity-50 cursor-not-allowed" wire:dirty.remove.attr="disabled">
                    <span wire:dirty.remove>{{ __('Save Changes') }}</span>
                    <span wire:dirty>{{ __('Save Changes') }} *</span>
                </flux:button>
            </div>
        </form>
    </div>
</div>
