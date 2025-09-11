@props([
    'question' => '',
    'answer' => '',
    'itemId' => '',
    'isFirst' => false
])

<div 
    class="border-b border-gray-200 {{ $isFirst ? 'border-t' : '' }}"
    x-data="{ isOpen: false }"
>
    <button 
        type="button"
        class="w-full py-6 text-left focus:outline-none focus:ring-2 focus:ring-golden-amber-500 focus:ring-offset-2 rounded-lg transition-colors duration-200 hover:bg-gray-50/50"
        @click="isOpen = !isOpen"
        :aria-expanded="isOpen"
        :aria-controls="'faq-answer-{{ $itemId }}'"
    >
        <div class="flex items-center justify-between">
            <x-ui.heading level="4" class="pr-4">{{ $question }}</x-ui.heading>
            <div class="flex-shrink-0">
                <x-heroicon-o-chevron-down 
                    class="w-5 h-5 text-gray-500 transition-transform duration-200"
                    :class="{ 'rotate-180': isOpen }"
                />
            </div>
        </div>
    </button>
    
    <div 
        x-show="isOpen"
        x-collapse
        :id="'faq-answer-{{ $itemId }}'"
        class="pb-6"
    >
        <div class="pr-8">
            <x-ui.text size="body" color="secondary" class="leading-relaxed">
                {!! nl2br(e($answer)) !!}
            </x-ui.text>
        </div>
    </div>
</div>