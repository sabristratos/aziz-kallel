@props([
    'variant' => 'default', // default, hero, compact
    'maxWidth' => '7xl',     // 7xl, 6xl, 5xl, 4xl, etc.
    'spacing' => 'default'   // default, compact, none
])

@php
$variantClasses = match($variant) {
    'hero' => 'px-4 sm:px-6 lg:px-8 xl:px-12',
    'compact' => 'px-4 sm:px-6 lg:px-6',
    default => 'px-4 sm:px-6 lg:px-8'
};

$spacingClasses = match($spacing) {
    'compact' => 'py-6 sm:py-8 lg:py-10',
    'none' => '',
    default => 'py-8 sm:py-12 lg:py-16'
};

$maxWidthClass = "max-w-{$maxWidth}";
$combinedClasses = trim("{$variantClasses} {$spacingClasses}");

// Extract id attribute for section element if provided
$sectionAttributes = $attributes->only('id');
$divAttributes = $attributes->except('id')->merge(['class' => "{$maxWidthClass} mx-auto {$combinedClasses}"]);
@endphp

<section {{ $sectionAttributes }}>
    <div {{ $divAttributes }}>
        {{ $slot }}
    </div>
</section>
