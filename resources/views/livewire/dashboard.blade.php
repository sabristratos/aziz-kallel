<div class="flex h-full w-full flex-1 flex-col gap-6">
    {{-- Statistics Cards --}}
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        {{-- Testimonials Card --}}
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">{{ __('Testimonials') }}</p>
                    <p class="mt-2 text-3xl font-bold text-neutral-900 dark:text-white">{{ $this->totalTestimonials }}</p>
                    <div class="mt-2 flex gap-3 text-sm">
                        <span class="text-green-600 dark:text-green-400">{{ $this->activeTestimonials }} {{ __('active') }}</span>
                        <span class="text-neutral-400">•</span>
                        <span class="text-neutral-500 dark:text-neutral-400">{{ $this->inactiveTestimonials }} {{ __('inactive') }}</span>
                    </div>
                </div>
                <flux:icon icon="chat-bubble-left-right" class="size-8 text-neutral-400" />
            </div>
        </div>

        {{-- FAQs Card --}}
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">{{ __('FAQs') }}</p>
                    <p class="mt-2 text-3xl font-bold text-neutral-900 dark:text-white">{{ $this->totalFaqs }}</p>
                    <div class="mt-2 flex gap-3 text-sm">
                        <span class="text-green-600 dark:text-green-400">{{ $this->activeFaqs }} {{ __('active') }}</span>
                        <span class="text-neutral-400">•</span>
                        <span class="text-neutral-500 dark:text-neutral-400">{{ $this->inactiveFaqs }} {{ __('inactive') }}</span>
                    </div>
                </div>
                <flux:icon icon="question-mark-circle" class="size-8 text-neutral-400" />
            </div>
        </div>

        {{-- Pending Requests Card --}}
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">{{ __('Pending Requests') }}</p>
                    <p class="mt-2 text-3xl font-bold text-neutral-900 dark:text-white">{{ $this->pendingConsultationRequests }}</p>
                    <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">{{ __('Awaiting response') }}</p>
                </div>
                <flux:icon icon="calendar-days" class="size-8 text-neutral-400" />
            </div>
        </div>

        {{-- Total Requests Card --}}
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">{{ __('Total Requests') }}</p>
                    <p class="mt-2 text-3xl font-bold text-neutral-900 dark:text-white">{{ \App\Models\ConsultationRequest::count() }}</p>
                    <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">{{ __('All time') }}</p>
                </div>
                <flux:icon icon="inbox" class="size-8 text-neutral-400" />
            </div>
        </div>
    </div>

    {{-- Recent Consultation Requests --}}
    <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-zinc-800">
        <div class="border-b border-neutral-200 px-6 py-4 dark:border-neutral-700">
            <flux:heading size="lg">{{ __('Recent Consultation Requests') }}</flux:heading>
        </div>
        <div class="p-6">
            @if($this->recentConsultationRequests->isEmpty())
                <div class="py-12 text-center">
                    <flux:icon icon="inbox" class="mx-auto size-12 text-neutral-300 dark:text-neutral-600" />
                    <p class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">{{ __('No consultation requests yet') }}</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($this->recentConsultationRequests as $request)
                        <div class="flex items-start justify-between rounded-lg border border-neutral-200 p-4 dark:border-neutral-700">
                            <div class="flex-1">
                                <div class="flex items-center gap-3">
                                    <flux:heading size="sm">{{ $request->name }}</flux:heading>
                                    <flux:badge :color="$request->status === 'pending' ? 'yellow' : 'green'" size="sm">
                                        {{ ucfirst($request->status) }}
                                    </flux:badge>
                                </div>
                                <div class="mt-2 space-y-1 text-sm text-neutral-600 dark:text-neutral-400">
                                    <div class="flex items-center gap-2">
                                        <flux:icon icon="envelope" class="size-4" />
                                        <span>{{ $request->email }}</span>
                                    </div>
                                    @if($request->phone)
                                        <div class="flex items-center gap-2">
                                            <flux:icon icon="phone" class="size-4" />
                                            <span>{{ $request->phone }}</span>
                                        </div>
                                    @endif
                                    <div class="flex items-center gap-2">
                                        <flux:icon icon="calendar" class="size-4" />
                                        <span>{{ $request->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <flux:button variant="ghost" size="sm" :href="route('admin.consultation-requests')" wire:navigate>
                                    {{ __('View') }}
                                </flux:button>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if(\App\Models\ConsultationRequest::count() > 5)
                    <div class="mt-6 text-center">
                        <flux:button variant="ghost" :href="route('admin.consultation-requests')" wire:navigate>
                            {{ __('View all requests') }} →
                        </flux:button>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
