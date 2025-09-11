@props([
    'href' => '#',
    'variant' => 'primary',    // primary, secondary, muted
    'size' => 'base',          // small, base, large
    'external' => false        // Opens in new tab if true
])

@php
$variantClasses = match($variant) {
    'secondary' => 'text-gray-600 hover:text-gray-900',
    'muted' => 'text-gray-500 hover:text-gray-700',
    default => 'text-science-blue-600 hover:text-science-blue-700'
};

$sizeClasses = match($size) {
    'small' => 'text-sm',
    'large' => 'text-lg',
    default => 'text-base'
};

$baseClasses = 'font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-science-blue-600 focus:ring-offset-2 rounded';

$classes = "{$baseClasses} {$variantClasses} {$sizeClasses}";

$attributes = $attributes->merge(['class' => $classes, 'href' => $href]);

if ($external) {
    $attributes = $attributes->merge(['target' => '_blank', 'rel' => 'noopener noreferrer']);
}

// Handle navigation for internal links
if (!str_starts_with($href, 'http') && !str_starts_with($href, 'mailto') && !str_starts_with($href, 'tel') && $href !== '#') {
    $attributes = $attributes->merge(['wire:navigate' => true]);
}
@endphp

<a {{ $attributes }}>
    {{ $slot }}
</a>