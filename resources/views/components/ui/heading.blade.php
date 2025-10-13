@props([
    'level' => '2',          // 1, 2, 3, 4
    'color' => 'primary',    // primary, white, muted
    'as' => null             // Override HTML tag if needed
])

@php
$tag = $as ?? "h{$level}";

$levelClasses = match($level) {
    '1' => 'text-3xl lg:text-4xl font-bold leading-tight font-heading',
    '2' => 'text-3xl lg:text-4xl font-bold font-heading',
    '3' => 'text-2xl font-bold font-heading',
    '4' => 'font-semibold text-base font-heading',
    default => 'text-3xl lg:text-4xl font-bold font-heading'
};

$colorClasses = match($color) {
    'white' => 'text-white',
    'muted' => 'text-gray-600',
    default => 'text-gray-900'
};

$classes = "{$levelClasses} {$colorClasses}";
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</{{ $tag }}>
