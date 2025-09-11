@props([
    'type' => 'text',
    'label' => '',
    'placeholder' => '',
    'required' => false,
    'wireModel' => '',
    'error' => null
])

<div class="space-y-2">
    @if($label)
        <label class="block text-sm font-medium text-gray-700">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <input 
        type="{{ $type }}"
        @if($wireModel) wire:model="{{ $wireModel }}" @endif
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-golden-amber-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400'
        ]) }}
    />
    
    @if($error)
        <p class="text-sm text-red-600">{{ $error }}</p>
    @endif
</div>