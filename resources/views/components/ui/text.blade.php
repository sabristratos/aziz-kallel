@props([
    'size' => 'body',        // lead, body, small, xs
    'color' => 'primary',    // primary, secondary, muted, white
    'as' => 'p'              // HTML tag (p, span, div, etc.)
])

@php
$sizeClasses = match($size) {
    'lead' => 'text-lg lg:text-xl leading-normal font-body',
    'body' => 'text-base leading-relaxed font-body',
    'small' => 'text-sm leading-relaxed font-body',
    'xs' => 'text-xs font-body',
    default => 'text-base leading-relaxed font-body'
};

$colorClasses = match($color) {
    'secondary' => 'text-gray-600',
    'muted' => 'text-gray-500',
    'white' => 'text-white/90',
    default => 'text-gray-900'
};

$classes = "{$sizeClasses} {$colorClasses}";
@endphp

<{{ $as }} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</{{ $as }}>