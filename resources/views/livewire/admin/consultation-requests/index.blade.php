<div class="flex h-full w-full flex-1 flex-col gap-6">
    {{-- Breadcrumbs --}}
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>{{ __('Dashboard') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Consultation Requests') }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    {{-- Header with Stats --}}
    <div>
        <flux:heading size="xl">{{ __('Consultation Requests') }}</flux:heading>
        <flux:text class="mt-1">{{ __('Manage and track client consultation requests') }}</flux:text>

        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
            <div class="rounded-lg border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-zinc-800">
                <flux:text class="text-sm text-neutral-500 dark:text-neutral-400">{{ __('Total') }}</flux:text>
                <flux:heading size="lg" class="mt-1">{{ $this->stats['total'] }}</flux:heading>
            </div>
            <div class="rounded-lg border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-zinc-800">
                <flux:text class="text-sm text-neutral-500 dark:text-neutral-400">{{ __('Pending') }}</flux:text>
                <flux:heading size="lg" class="mt-1">{{ $this->stats['pending'] }}</flux:heading>
            </div>
            <div class="rounded-lg border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-zinc-800">
                <flux:text class="text-sm text-neutral-500 dark:text-neutral-400">{{ __('Confirmed') }}</flux:text>
                <flux:heading size="lg" class="mt-1">{{ $this->stats['confirmed'] }}</flux:heading>
            </div>
            <div class="rounded-lg border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-zinc-800">
                <flux:text class="text-sm text-neutral-500 dark:text-neutral-400">{{ __('Completed') }}</flux:text>
                <flux:heading size="lg" class="mt-1">{{ $this->stats['completed'] }}</flux:heading>
            </div>
            <div class="rounded-lg border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-zinc-800">
                <flux:text class="text-sm text-neutral-500 dark:text-neutral-400">{{ __('Cancelled') }}</flux:text>
                <flux:heading size="lg" class="mt-1">{{ $this->stats['cancelled'] }}</flux:heading>
            </div>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div class="flex gap-2">
        <flux:button
            size="sm"
            :variant="$statusFilter === 'all' ? 'primary' : 'ghost'"
            wire:click="setFilter('all')"
        >
            {{ __('All') }}
        </flux:button>
        <flux:button
            size="sm"
            :variant="$statusFilter === 'pending' ? 'primary' : 'ghost'"
            wire:click="setFilter('pending')"
        >
            {{ __('Pending') }}
        </flux:button>
        <flux:button
            size="sm"
            :variant="$statusFilter === 'confirmed' ? 'primary' : 'ghost'"
            wire:click="setFilter('confirmed')"
        >
            {{ __('Confirmed') }}
        </flux:button>
        <flux:button
            size="sm"
            :variant="$statusFilter === 'completed' ? 'primary' : 'ghost'"
            wire:click="setFilter('completed')"
        >
            {{ __('Completed') }}
        </flux:button>
        <flux:button
            size="sm"
            :variant="$statusFilter === 'cancelled' ? 'primary' : 'ghost'"
            wire:click="setFilter('cancelled')"
        >
            {{ __('Cancelled') }}
        </flux:button>
    </div>

    {{-- Table --}}
    @if($this->requests->isEmpty())
        <div class="rounded-xl border border-neutral-200 bg-white py-12 text-center dark:border-neutral-700 dark:bg-zinc-800">
            <flux:icon icon="inbox" class="mx-auto size-12 text-neutral-300 dark:text-neutral-600" />
            <p class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">{{ __('No consultation requests found') }}</p>
        </div>
    @else
        <flux:table>
            <flux:table.columns>
                <flux:table.column>{{ __('Client') }}</flux:table.column>
                <flux:table.column>{{ __('Contact') }}</flux:table.column>
                <flux:table.column>{{ __('Topics') }}</flux:table.column>
                <flux:table.column>{{ __('Meeting Type') }}</flux:table.column>
                <flux:table.column>{{ __('Date') }}</flux:table.column>
                <flux:table.column>{{ __('Status') }}</flux:table.column>
                <flux:table.column align="end">{{ __('Actions') }}</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach($this->requests as $request)
                    <flux:table.row :key="$request->id">
                        <flux:table.cell variant="strong">
                            {{ $request->name }}
                        </flux:table.cell>

                        <flux:table.cell class="max-w-xs">
                            <div class="space-y-1 text-sm">
                                <div>{{ $request->email }}</div>
                                <div class="text-neutral-500 dark:text-neutral-400">{{ $request->phone }}</div>
                            </div>
                        </flux:table.cell>

                        <flux:table.cell class="max-w-xs">
                            <div class="flex flex-wrap gap-1">
                                @foreach($request->financial_topics ?? [] as $topic)
                                    <flux:badge size="sm" color="zinc">{{ ucfirst($topic) }}</flux:badge>
                                @endforeach
                            </div>
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:badge size="sm" color="zinc">{{ ucfirst($request->meeting_type) }}</flux:badge>
                        </flux:table.cell>

                        <flux:table.cell class="whitespace-nowrap">
                            {{ $request->created_at->format('M d, Y') }}
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:badge
                                size="sm"
                                :color="$this->getStatusColor($request->status)"
                            >
                                {{ ucfirst($request->status) }}
                            </flux:badge>
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            <flux:button size="sm" variant="ghost" wire:click="viewDetails({{ $request->id }})">
                                {{ __('View Details') }}
                            </flux:button>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    @endif

    {{-- Detail Modal --}}
    @if($this->viewingRequest)
        <flux:modal wire:model="showDetailModal" class="w-full max-w-3xl">
            <flux:heading>{{ __('Consultation Request Details') }}</flux:heading>

            <div class="mt-6 space-y-6">
                {{-- Client Information --}}
                <div>
                    <flux:heading size="sm" class="mb-3">{{ __('Client Information') }}</flux:heading>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Name') }}</flux:text>
                            <flux:text class="mt-1">{{ $this->viewingRequest->name }}</flux:text>
                        </div>
                        <div>
                            <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Email') }}</flux:text>
                            <flux:text class="mt-1">{{ $this->viewingRequest->email }}</flux:text>
                        </div>
                        <div>
                            <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Phone') }}</flux:text>
                            <flux:text class="mt-1">{{ $this->viewingRequest->phone }}</flux:text>
                        </div>
                        <div>
                            <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Preferred Contact') }}</flux:text>
                            <flux:text class="mt-1">{{ ucfirst($this->viewingRequest->preferred_contact_method) }}</flux:text>
                        </div>
                    </div>
                </div>

                {{-- Meeting Preferences --}}
                <div>
                    <flux:heading size="sm" class="mb-3">{{ __('Meeting Preferences') }}</flux:heading>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Meeting Type') }}</flux:text>
                            <flux:text class="mt-1">{{ ucfirst($this->viewingRequest->meeting_type) }}</flux:text>
                        </div>
                        <div>
                            <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Time Preference') }}</flux:text>
                            <flux:text class="mt-1">{{ ucfirst($this->viewingRequest->time_preference) }}</flux:text>
                        </div>
                        <div class="sm:col-span-2">
                            <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Preferred Dates') }}</flux:text>
                            <div class="mt-1 flex flex-wrap gap-2">
                                @foreach($this->viewingRequest->preferred_dates ?? [] as $date)
                                    <flux:badge size="sm" color="zinc">{{ $date }}</flux:badge>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Financial Topics --}}
                <div>
                    <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Financial Topics') }}</flux:text>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach($this->viewingRequest->financial_topics ?? [] as $topic)
                            <flux:badge color="blue">{{ ucfirst($topic) }}</flux:badge>
                        @endforeach
                    </div>
                </div>

                {{-- Goals & Situation --}}
                <div>
                    <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Current Situation') }}</flux:text>
                    <flux:text class="mt-1">{{ $this->viewingRequest->current_situation }}</flux:text>
                </div>

                <div>
                    <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Specific Goals') }}</flux:text>
                    <flux:text class="mt-1">{{ $this->viewingRequest->specific_goals }}</flux:text>
                </div>

                @if($this->viewingRequest->additional_notes)
                    <div>
                        <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Additional Notes') }}</flux:text>
                        <flux:text class="mt-1">{{ $this->viewingRequest->additional_notes }}</flux:text>
                    </div>
                @endif

                {{-- Status --}}
                <div>
                    <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Status') }}</flux:text>
                    <div class="mt-2">
                        <flux:radio.group wire:model="newStatus" variant="segmented">
                            <flux:radio value="pending" label="Pending" />
                            <flux:radio value="confirmed" label="Confirmed" />
                            <flux:radio value="completed" label="Completed" />
                            <flux:radio value="cancelled" label="Cancelled" />
                        </flux:radio.group>
                    </div>
                </div>

                {{-- Submitted Date --}}
                <div>
                    <flux:text class="text-xs font-semibold text-neutral-500 dark:text-neutral-400">{{ __('Submitted') }}</flux:text>
                    <flux:text class="mt-1">{{ $this->viewingRequest->created_at->format('F d, Y \a\t H:i') }}</flux:text>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <flux:button type="button" variant="ghost" wire:click="$set('showDetailModal', false)">{{ __('Close') }}</flux:button>
                <flux:button type="button" variant="primary" wire:click="saveStatus">{{ __('Save Status') }}</flux:button>
            </div>
        </flux:modal>
    @endif
</div>
