@php
    $faqs = \App\Models\Faq::active()->ordered()->get();
@endphp

@if($faqs->count() > 0)
    <div x-data="{ activeId: null }" class="grid sm:grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 animate-stagger">
        @foreach($faqs as $index => $faq)
            <div class="space-y-3 sm:space-y-4">
                <button 
                    type="button"
                    class="w-full text-left focus:outline-none transition-colors duration-200"
                    @click="activeId = activeId === {{ $faq->id }} ? null : {{ $faq->id }}"
                    :aria-expanded="activeId === {{ $faq->id }}"
                    :aria-controls="'faq-answer-{{ $faq->id }}'"
                >
                    <div class="flex items-start justify-between">
                        <x-ui.heading level="4" class="pr-3 sm:pr-4 text-white text-left text-sm sm:text-base">
                            {{ $faq->question }}
                        </x-ui.heading>
                        <div class="flex-shrink-0 mt-1">
                            <x-heroicon-o-chevron-down 
                                class="w-5 h-5 text-golden-amber-300 transition-transform duration-200"
                                x-bind:class="{ 'rotate-180': activeId === {{ $faq->id }} }"
                            />
                        </div>
                    </div>
                </button>
                
                <div 
                    x-show="activeId === {{ $faq->id }}"
                    x-collapse
                    :id="'faq-answer-{{ $faq->id }}'"
                    class="pr-6 sm:pr-8"
                >
                    <x-ui.text size="body" color="white" class="leading-relaxed text-sm sm:text-base">
                        {!! nl2br(e($faq->answer)) !!}
                    </x-ui.text>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-12">
        <x-ui.text color="secondary">
            {{ __('Keine FAQs verfügbar.') }}
        </x-ui.text>
    </div>
@endif