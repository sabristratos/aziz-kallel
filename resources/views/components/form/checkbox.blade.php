@props([
    'label' => '',
    'value' => '',
    'wireModel' => '',
    'checked' => false
])

<label class="flex items-start cursor-pointer group">
    <div class="relative flex items-center justify-center">
        <input 
            type="checkbox"
            @if($wireModel) wire:model="{{ $wireModel }}" @endif
            @if($value) value="{{ $value }}" @endif
            @if($checked) checked @endif
            {{ $attributes->merge([
                'class' => 'sr-only'
            ]) }}
        />
        
        <!-- Custom Checkbox -->
        <div class="w-5 h-5 border-2 border-gray-300 rounded group-hover:border-golden-amber-400 transition-colors duration-200 flex items-center justify-center bg-white">
            <!-- Checkmark (hidden by default, shown when checked) -->
            <svg class="w-3 h-3 text-white opacity-0 group-has-[:checked]:opacity-100 transition-opacity duration-200" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
        </div>
        
        <!-- Golden background when checked -->
        <div class="absolute inset-0 w-5 h-5 bg-golden-amber-500 border-2 border-golden-amber-500 rounded opacity-0 group-has-[:checked]:opacity-100 transition-opacity duration-200"></div>
    </div>
    
    @if($label)
        <span class="text-sm text-gray-700 leading-5 select-none ltr:ml-3 rtl:mr-3">{{ $label }}</span>
    @else
        <span class="text-sm text-gray-700 leading-5 select-none ltr:ml-3 rtl:mr-3">{{ $slot }}</span>
    @endif
</label>