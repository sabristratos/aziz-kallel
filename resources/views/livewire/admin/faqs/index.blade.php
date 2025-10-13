<div class="flex h-full w-full flex-1 flex-col gap-6">
    {{-- Breadcrumbs --}}
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>{{ __('Dashboard') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('FAQs') }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ __('FAQs') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Manage frequently asked questions') }}</flux:text>
        </div>
        <flux:button wire:click="openCreateModal" variant="primary">
            {{ __('Add FAQ') }}
        </flux:button>
    </div>

    {{-- Table --}}
    @if($this->faqs->isEmpty())
        <div class="rounded-xl border border-neutral-200 bg-white py-12 text-center dark:border-neutral-700 dark:bg-zinc-800">
            <flux:icon icon="inbox" class="mx-auto size-12 text-neutral-300 dark:text-neutral-600" />
            <p class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">{{ __('No FAQs yet') }}</p>
            <flux:button wire:click="openCreateModal" variant="ghost" class="mt-4">
                {{ __('Create your first FAQ') }}
            </flux:button>
        </div>
    @else
        <flux:table>
            <flux:table.columns>
                <flux:table.column>{{ __('Question') }}</flux:table.column>
                <flux:table.column>{{ __('Answer') }}</flux:table.column>
                <flux:table.column>{{ __('Order') }}</flux:table.column>
                <flux:table.column>{{ __('Status') }}</flux:table.column>
                <flux:table.column align="end">{{ __('Actions') }}</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach($this->faqs as $faq)
                    <flux:table.row :key="$faq->id">
                        <flux:table.cell class="max-w-md font-medium">
                            {{ $faq->question }}
                        </flux:table.cell>

                        <flux:table.cell class="max-w-md truncate">
                            {{ $faq->answer }}
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:badge size="sm" color="zinc">{{ $faq->order }}</flux:badge>
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:switch
                                :checked="$faq->is_active"
                                wire:click="toggleActive({{ $faq->id }})"
                            />
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            <div class="flex justify-end gap-2">
                                <flux:button size="sm" variant="ghost" wire:click="moveUp({{ $faq->id }})" icon="chevron-up" />
                                <flux:button size="sm" variant="ghost" wire:click="moveDown({{ $faq->id }})" icon="chevron-down" />
                                <flux:button size="sm" variant="ghost" wire:click="openEditModal({{ $faq->id }})">
                                    {{ __('Edit') }}
                                </flux:button>
                                <flux:button size="sm" variant="ghost" wire:click="confirmDelete({{ $faq->id }})">
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
        <flux:heading>{{ __('Create FAQ') }}</flux:heading>

        <form wire:submit="save" class="mt-6 space-y-6">
            <flux:field>
                <flux:label>{{ __('Question (German)') }}</flux:label>
                <flux:input wire:model="question.de" required />
                <flux:error name="question.de" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Question (Arabic)') }}</flux:label>
                <flux:input wire:model="question.ar" />
                <flux:error name="question.ar" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Answer (German)') }}</flux:label>
                <flux:textarea wire:model="answer.de" rows="6" required />
                <flux:error name="answer.de" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Answer (Arabic)') }}</flux:label>
                <flux:textarea wire:model="answer.ar" rows="6" />
                <flux:error name="answer.ar" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Order') }}</flux:label>
                <flux:input type="number" wire:model="order" min="0" required />
                <flux:error name="order" />
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
        <flux:heading>{{ __('Edit FAQ') }}</flux:heading>

        <form wire:submit="update" class="mt-6 space-y-6">
            <flux:field>
                <flux:label>{{ __('Question (German)') }}</flux:label>
                <flux:input wire:model="question.de" required />
                <flux:error name="question.de" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Question (Arabic)') }}</flux:label>
                <flux:input wire:model="question.ar" />
                <flux:error name="question.ar" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Answer (German)') }}</flux:label>
                <flux:textarea wire:model="answer.de" rows="6" required />
                <flux:error name="answer.de" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Answer (Arabic)') }}</flux:label>
                <flux:textarea wire:model="answer.ar" rows="6" />
                <flux:error name="answer.ar" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Order') }}</flux:label>
                <flux:input type="number" wire:model="order" min="0" required />
                <flux:error name="order" />
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
        <flux:heading>{{ __('Delete FAQ') }}</flux:heading>
        <flux:text class="mt-4">{{ __('Are you sure you want to delete this FAQ? This action cannot be undone.') }}</flux:text>

        <div class="mt-6 flex justify-end gap-2">
            <flux:button type="button" variant="ghost" wire:click="$set('showDeleteModal', false)">{{ __('Cancel') }}</flux:button>
            <flux:button type="button" variant="danger" wire:click="delete">{{ __('Delete') }}</flux:button>
        </div>
    </flux:modal>
</div>
