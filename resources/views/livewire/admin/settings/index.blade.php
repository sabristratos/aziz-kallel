<div class="flex h-full w-full flex-1 flex-col gap-6">
    {{-- Breadcrumbs --}}
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>{{ __('Dashboard') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Website Settings') }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    {{-- Header with Language Tabs --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ __('Website Settings') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Manage your website content and configuration') }}</flux:text>
        </div>

        {{-- Language Switcher --}}
        @if(!in_array($selectedCategory, ['email', 'images']))
            <div class="flex gap-2">
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
        @endif
    </div>

    {{-- Main Content --}}
    <div class="grid gap-6 lg:grid-cols-4">
        {{-- Category Sidebar --}}
        <div class="lg:col-span-1">
            <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-zinc-800">
                <flux:heading size="sm" class="mb-4">{{ __('Categories') }}</flux:heading>
                <nav class="space-y-1">
                    @foreach($categories as $key => $category)
                        <flux:button
                            wire:click="selectCategory('{{ $key }}')"
                            :variant="$selectedCategory === $key ? 'filled' : 'ghost'"
                            class="w-full justify-start text-sm"
                            size="sm"
                        >
                            {{ __($category['label']) }}
                        </flux:button>
                    @endforeach
                </nav>
            </div>
        </div>

        {{-- Settings Table --}}
        <div class="lg:col-span-3">
            <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-zinc-800">
                <div class="border-b border-neutral-200 px-6 py-4 dark:border-neutral-700">
                    <div class="flex items-center justify-between">
                        <flux:heading size="lg">{{ __($categories[$selectedCategory]['label']) }}</flux:heading>
                        <div class="flex items-center gap-2">
                            @if($selectedCategory === 'email')
                                <flux:button size="sm" wire:click="openTestEmailModal" variant="ghost">
                                    {{ __('Send Test Email') }}
                                </flux:button>
                            @endif
                            <flux:button
                                size="sm"
                                wire:click="saveCategory"
                                variant="primary"
                                wire:dirty.class.remove="opacity-50 cursor-not-allowed"
                                wire:dirty.remove.attr="disabled"
                                wire:target="editValues"
                                disabled
                                class="opacity-50 cursor-not-allowed"
                            >
                                <span wire:dirty.remove wire:target="editValues">{{ __('Save All Changes') }}</span>
                                <span wire:dirty wire:target="editValues">{{ __('Save All Changes') }} *</span>
                            </flux:button>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @if($this->categorySettings->isEmpty())
                        <div class="py-12 text-center">
                            <flux:icon icon="inbox" class="mx-auto size-12 text-neutral-300 dark:text-neutral-600" />
                            <p class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">{{ __('No settings found in this category') }}</p>
                        </div>
                    @else
                        <flux:table>
                            <flux:table.columns>
                                <flux:table.column class="w-1/3">{{ __('Setting') }}</flux:table.column>
                                <flux:table.column>{{ __('Value') }}</flux:table.column>
                            </flux:table.columns>

                            <flux:table.rows>
                                @foreach($this->categorySettings as $item)
                                    <flux:table.row :key="$item['key']">
                                        <flux:table.cell>
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <flux:text variant="strong">{{ ucwords(str_replace('_', ' ', $item['key'])) }}</flux:text>
                                                    <span wire:dirty wire:target="editValues.{{ $item['key'] }}">
                                                        <flux:badge size="sm" color="blue">{{ __('Modified') }}</flux:badge>
                                                    </span>
                                                </div>
                                                <flux:badge size="sm" color="zinc" class="mt-1">{{ $item['type'] }}</flux:badge>
                                            </div>
                                        </flux:table.cell>

                                        <flux:table.cell>
                                            @if($item['isMailConfig'])
                                                {{-- Mail Configuration Settings (Non-translatable) --}}
                                                @if($item['key'] === 'mail_password')
                                                    <flux:input type="password" wire:model="editValues.{{ $item['key'] }}" />
                                                @else
                                                    <flux:input wire:model="editValues.{{ $item['key'] }}" />
                                                @endif
                                            @elseif($item['isMedia'])
                                                {{-- Media Upload --}}
                                                @php
                                                    $collectionName = $item['key'];
                                                @endphp
                                                <div class="space-y-3">
                                                    @if($item['setting']->hasMedia($collectionName))
                                                        <div class="relative inline-block">
                                                            <img
                                                                src="{{ $item['setting']->getFirstMediaUrl($collectionName, 'thumb') }}"
                                                                alt="{{ ucwords(str_replace('_', ' ', $item['key'])) }}"
                                                                class="h-24 w-24 rounded-lg object-cover border border-neutral-200"
                                                            >
                                                            <flux:button
                                                                size="xs"
                                                                variant="danger"
                                                                wire:click="removeMedia('{{ $item['key'] }}')"
                                                                wire:confirm="{{ __('Are you sure you want to remove this image?') }}"
                                                                class="absolute -top-2 -right-2"
                                                            >
                                                                <flux:icon icon="x-mark" class="size-3" />
                                                            </flux:button>
                                                        </div>
                                                    @endif
                                                    <input
                                                        type="file"
                                                        wire:model="mediaFiles.{{ $item['key'] }}"
                                                        accept="image/*"
                                                        class="block w-full text-xs text-neutral-500 file:me-2 file:rounded-md file:border-0 file:bg-science-blue-50 file:px-3 file:py-1 file:text-xs file:font-semibold file:text-science-blue-700 hover:file:bg-science-blue-100 dark:file:bg-science-blue-900/30 dark:file:text-science-blue-400"
                                                    >
                                                </div>
                                            @else
                                                {{-- Translatable Settings --}}
                                                @php
                                                    $model = "editValues.{$item['key']}.{$currentLanguage}";
                                                    $isRichText = $item['key'] === 'impressum_content';
                                                    $isEmailCustomization = in_array($item['key'], ['email_consultation_subject', 'email_consultation_body', 'email_consultation_footer']);
                                                @endphp
                                                @if($isRichText)
                                                    <div wire:ignore>
                                                        <flux:editor
                                                            wire:model="{{ $model }}"
                                                            :dir="$currentLanguage === 'ar' ? 'rtl' : 'ltr'"
                                                        />
                                                    </div>

                                                    {{-- Hidden inputs to preserve other locales --}}
                                                    @foreach(['de', 'ar'] as $locale)
                                                        @if($locale !== $currentLanguage)
                                                            <input type="hidden" wire:model="editValues.{{ $item['key'] }}.{{ $locale }}">
                                                        @endif
                                                    @endforeach
                                                @elseif($item['type'] === 'text' || $item['type'] === 'json')
                                                    <flux:textarea wire:model="{{ $model }}" rows="4" :dir="$currentLanguage === 'ar' ? 'rtl' : 'ltr'" />
                                                    @if($isEmailCustomization && $item['key'] === 'email_consultation_body')
                                                        <flux:text size="sm" class="mt-1 text-neutral-500">
                                                            {{ __('Available placeholders: {name}, {topics}, {notes}, {email}, {phone}') }}
                                                        </flux:text>
                                                    @endif

                                                    {{-- Hidden inputs to preserve other locales --}}
                                                    @foreach(['de', 'ar'] as $locale)
                                                        @if($locale !== $currentLanguage)
                                                            <input type="hidden" wire:model="editValues.{{ $item['key'] }}.{{ $locale }}">
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <flux:input wire:model="{{ $model }}" :dir="$currentLanguage === 'ar' ? 'rtl' : 'ltr'" />

                                                    {{-- Hidden inputs to preserve other locales --}}
                                                    @foreach(['de', 'ar'] as $locale)
                                                        @if($locale !== $currentLanguage)
                                                            <input type="hidden" wire:model="editValues.{{ $item['key'] }}.{{ $locale }}">
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                            @error("editValues.{$item['key']}")
                                                <flux:text size="sm" class="mt-1 text-red-600">{{ $message }}</flux:text>
                                            @enderror
                                            @error("editValues.{$item['key']}.{$currentLanguage}")
                                                <flux:text size="sm" class="mt-1 text-red-600">{{ $message }}</flux:text>
                                            @enderror
                                        </flux:table.cell>
                                    </flux:table.row>
                                @endforeach
                            </flux:table.rows>
                        </flux:table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Test Email Modal --}}
    <flux:modal wire:model="showTestEmailModal" class="w-full max-w-md">
        <flux:heading>{{ __('Send Test Email') }}</flux:heading>
        <flux:text class="mt-1 text-sm">{{ __('Send a test email to verify your email configuration') }}</flux:text>

        <form wire:submit="sendTestEmail" class="mt-6 space-y-6">
            <flux:field>
                <flux:label>{{ __('Email Address') }}</flux:label>
                <flux:input type="email" wire:model="testEmailAddress" placeholder="user@example.com" />
                <flux:error name="testEmailAddress" />
            </flux:field>

            <div class="flex justify-end gap-2">
                <flux:button type="button" variant="ghost" wire:click="$set('showTestEmailModal', false)">
                    {{ __('Cancel') }}
                </flux:button>
                <flux:button type="submit" variant="primary">
                    {{ __('Send Test Email') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
