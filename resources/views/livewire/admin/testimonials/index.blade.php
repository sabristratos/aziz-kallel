<div class="flex h-full w-full flex-1 flex-col gap-6">
    {{-- Breadcrumbs --}}
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>{{ __('Dashboard') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Testimonials') }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ __('Testimonials') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Manage client testimonials and reviews') }}</flux:text>
        </div>
        <flux:button wire:click="openCreateModal" variant="primary">
            {{ __('Add Testimonial') }}
        </flux:button>
    </div>

    {{-- Table --}}
    @if($this->testimonials->isEmpty())
        <div class="rounded-xl border border-neutral-200 bg-white py-12 text-center dark:border-neutral-700 dark:bg-zinc-800">
            <flux:icon icon="inbox" class="mx-auto size-12 text-neutral-300 dark:text-neutral-600" />
            <p class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">{{ __('No testimonials yet') }}</p>
            <flux:button wire:click="openCreateModal" variant="ghost" class="mt-4">
                {{ __('Create your first testimonial') }}
            </flux:button>
        </div>
    @else
        <flux:table>
            <flux:table.columns>
                <flux:table.column>{{ __('Client') }}</flux:table.column>
                <flux:table.column>{{ __('Content') }}</flux:table.column>
                <flux:table.column>{{ __('Rating') }}</flux:table.column>
                <flux:table.column>{{ __('Order') }}</flux:table.column>
                <flux:table.column>{{ __('Status') }}</flux:table.column>
                <flux:table.column align="end">{{ __('Actions') }}</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach($this->testimonials as $testimonial)
                    <flux:table.row :key="$testimonial->id">
                        <flux:table.cell class="flex items-center gap-3">
                            @if($testimonial->hasMedia('avatar'))
                                <flux:avatar size="xs" src="{{ $testimonial->getFirstMediaUrl('avatar', 'thumb') }}" />
                            @else
                                <div class="flex size-8 items-center justify-center rounded-full bg-neutral-200 text-sm font-semibold text-neutral-700 dark:bg-neutral-700 dark:text-neutral-300">
                                    {{ substr($testimonial->client_name, 0, 2) }}
                                </div>
                            @endif
                            {{ $testimonial->client_name }}
                        </flux:table.cell>

                        <flux:table.cell class="max-w-md truncate">
                            {{ $testimonial->content }}
                        </flux:table.cell>

                        <flux:table.cell>
                            <div class="flex gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    <flux:icon icon="star" class="size-4 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-neutral-300 dark:text-neutral-600' }}" />
                                @endfor
                            </div>
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:badge size="sm" color="zinc">{{ $testimonial->sort_order }}</flux:badge>
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:switch
                                :checked="$testimonial->is_active"
                                wire:click="toggleActive({{ $testimonial->id }})"
                            />
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            <div class="flex justify-end gap-2">
                                <flux:button size="sm" variant="ghost" wire:click="moveUp({{ $testimonial->id }})" icon="chevron-up" />
                                <flux:button size="sm" variant="ghost" wire:click="moveDown({{ $testimonial->id }})" icon="chevron-down" />
                                <flux:button size="sm" variant="ghost" wire:click="openEditModal({{ $testimonial->id }})">
                                    {{ __('Edit') }}
                                </flux:button>
                                <flux:button size="sm" variant="ghost" wire:click="confirmDelete({{ $testimonial->id }})">
                                    {{ __('Delete') }}
                                </flux:button>
                            </div>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    @endif

    {{-- Create Modal --}}
    <flux:modal wire:model="showCreateModal" class="w-full max-w-2xl">
        <flux:heading>{{ __('Create Testimonial') }}</flux:heading>

        <form wire:submit="save" class="mt-6 space-y-6">
            <flux:field>
                <flux:label>{{ __('Client Name') }}</flux:label>
                <flux:input wire:model="client_name" required />
                <flux:error name="client_name" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Content (German)') }}</flux:label>
                <flux:textarea wire:model="content.de" rows="4" required />
                <flux:error name="content.de" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Content (Arabic)') }}</flux:label>
                <flux:textarea wire:model="content.ar" rows="4" />
                <flux:error name="content.ar" />
            </flux:field>

            <div class="grid gap-6 sm:grid-cols-2">
                <flux:field>
                    <flux:label>{{ __('Rating') }}</flux:label>
                    <flux:select wire:model="rating">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} {{ __('Stars') }}</option>
                        @endfor
                    </flux:select>
                    <flux:error name="rating" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Order') }}</flux:label>
                    <flux:input type="number" wire:model="sort_order" min="0" required />
                    <flux:error name="sort_order" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label>{{ __('Avatar Image') }}</flux:label>
                <input type="file" wire:model="avatar" accept="image/*" class="block w-full text-sm text-neutral-500 file:me-4 file:rounded-md file:border-0 file:bg-science-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-science-blue-700 hover:file:bg-science-blue-100 dark:file:bg-science-blue-900/30 dark:file:text-science-blue-400">
                <flux:error name="avatar" />
            </flux:field>

            <flux:field variant="inline">
                <flux:label>{{ __('Active') }}</flux:label>
                <flux:switch wire:model="is_active" />
            </flux:field>

            <div class="flex justify-end gap-2">
                <flux:button type="button" variant="ghost" wire:click="$set('showCreateModal', false)">{{ __('Cancel') }}</flux:button>
                <flux:button type="submit" variant="primary">{{ __('Create') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Edit Modal --}}
    <flux:modal wire:model="showEditModal" class="w-full max-w-2xl">
        <flux:heading>{{ __('Edit Testimonial') }}</flux:heading>

        <form wire:submit="update" class="mt-6 space-y-6">
            <flux:field>
                <flux:label>{{ __('Client Name') }}</flux:label>
                <flux:input wire:model="client_name" required />
                <flux:error name="client_name" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Content (German)') }}</flux:label>
                <flux:textarea wire:model="content.de" rows="4" required />
                <flux:error name="content.de" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Content (Arabic)') }}</flux:label>
                <flux:textarea wire:model="content.ar" rows="4" />
                <flux:error name="content.ar" />
            </flux:field>

            <div class="grid gap-6 sm:grid-cols-2">
                <flux:field>
                    <flux:label>{{ __('Rating') }}</flux:label>
                    <flux:select wire:model="rating">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} {{ __('Stars') }}</option>
                        @endfor
                    </flux:select>
                    <flux:error name="rating" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Order') }}</flux:label>
                    <flux:input type="number" wire:model="sort_order" min="0" required />
                    <flux:error name="sort_order" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label>{{ __('Avatar Image') }}</flux:label>
                <input type="file" wire:model="avatar" accept="image/*" class="block w-full text-sm text-neutral-500 file:me-4 file:rounded-md file:border-0 file:bg-science-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-science-blue-700 hover:file:bg-science-blue-100 dark:file:bg-science-blue-900/30 dark:file:text-science-blue-400">
                <flux:error name="avatar" />
            </flux:field>

            <flux:field variant="inline">
                <flux:label>{{ __('Active') }}</flux:label>
                <flux:switch wire:model="is_active" />
            </flux:field>

            <div class="flex justify-end gap-2">
                <flux:button type="button" variant="ghost" wire:click="$set('showEditModal', false)">{{ __('Cancel') }}</flux:button>
                <flux:button type="submit" variant="primary">{{ __('Update') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Delete Confirmation Modal --}}
    <flux:modal wire:model="showDeleteModal" class="w-full max-w-md">
        <flux:heading>{{ __('Delete Testimonial') }}</flux:heading>
        <flux:text class="mt-4">{{ __('Are you sure you want to delete this testimonial? This action cannot be undone.') }}</flux:text>

        <div class="mt-6 flex justify-end gap-2">
            <flux:button type="button" variant="ghost" wire:click="$set('showDeleteModal', false)">{{ __('Cancel') }}</flux:button>
            <flux:button type="button" variant="danger" wire:click="delete">{{ __('Delete') }}</flux:button>
        </div>
    </flux:modal>
</div>
