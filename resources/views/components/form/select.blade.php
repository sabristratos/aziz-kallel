@props([
    'label' => '',
    'placeholder' => '',
    'required' => false,
    'wireModel' => '',
    'options' => [],
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
    
    <select 
        @if($wireModel) wire:model="{{ $wireModel }}" @endif
        @if($required) required @endif
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-golden-amber-500 focus:border-transparent transition-colors duration-200 bg-white'
        ]) }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        
        @if(count($options) > 0)
            @foreach($options as $value => $text)
                <option value="{{ $value }}">{{ $text }}</option>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </select>
    
    @if($error)
        <p class="text-sm text-red-600">{{ $error }}</p>
    @endif
</div>