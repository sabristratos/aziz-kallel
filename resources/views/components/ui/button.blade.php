@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
    'disabled' => false,
    'loading' => false,
    'icon' => null,
    'iconPosition' => 'left'
])

@php
$tag = $href ? 'a' : 'button';

$baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

$variantClasses = [
    'primary' => 'bg-science-blue-600 text-white hover:bg-science-blue-700 focus:ring-science-blue-600',
    'secondary' => 'bg-slate-100 text-slate-900 hover:bg-slate-200 focus:ring-slate-100',
    'white' => 'bg-white text-science-blue-600 hover:bg-white/90 hover:text-science-blue-700 focus:ring-white border-0',
    'outline' => 'border border-slate-300 bg-white text-slate-900 hover:bg-slate-50 focus:ring-science-blue-600',
    'ghost' => 'text-slate-900 hover:bg-slate-100 focus:ring-science-blue-600',
    'destructive' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-600',
    'golden' => 'bg-golden-amber-500 text-white hover:bg-golden-amber-600 focus:ring-golden-amber-500 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200'
];

$sizeClasses = [
    'sm' => 'px-3 py-1.5 text-xs',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-6 py-3 text-base',
    'icon' => 'p-2 aspect-square'
];

// Add border radius for pill shape
$radiusClass = $size === 'sm' ? 'rounded-full' : 'rounded-full';

$classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']) . ' ' . ($sizeClasses[$size] ?? $sizeClasses['md']) . ' ' . $radiusClass;

if ($disabled || $loading) {
    $classes .= ' opacity-50 cursor-not-allowed';
}

$attributes = $attributes->merge(['class' => $classes]);

if ($href) {
    $attributes = $attributes->merge(['href' => $href]);
    // Only add wire:navigate for internal page navigation, not for anchor links
    if (!str_starts_with($href, 'http') && !str_starts_with($href, 'mailto') && !str_starts_with($href, 'tel') && !str_starts_with($href, '#')) {
        $attributes = $attributes->merge(['wire:navigate' => true]);
    }
} else {
    $attributes = $attributes->merge(['type' => $type]);
    if ($disabled || $loading) {
        $attributes = $attributes->merge(['disabled' => true]);
    }
}
@endphp

<{{ $tag }} {{ $attributes }}>
    @if($loading)
        <span class="animate-spin mr-2">
            <x-heroicon-o-arrow-path class="h-4 w-4" />
        </span>
    @endif
    
    @if($icon && $iconPosition === 'left' && !$loading)
        <x-dynamic-component :component="$icon" class="h-4 w-4 mr-2" />
    @endif
    
    {{ $slot }}
    
    @if($icon && $iconPosition === 'right' && !$loading)
        <x-dynamic-component :component="$icon" class="h-4 w-4 ml-2" />
    @endif
</{{ $tag }}>