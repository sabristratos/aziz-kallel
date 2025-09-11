@props([
    'href' => '#',
    'active' => false,
    'icon' => null,
    'mobile' => false
])

@php
$baseClasses = 'relative inline-flex items-center transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2';

if ($mobile) {
    $baseClasses .= ' w-full px-4 py-3 text-base font-medium border-l-4';
    if ($active) {
        $baseClasses .= ' border-science-blue-600 bg-science-blue-50 text-science-blue-600';
    } else {
        $baseClasses .= ' border-transparent text-slate-900 hover:border-science-blue-300 hover:bg-slate-50';
    }
} else {
    $baseClasses .= ' px-3 py-2 text-sm font-medium';
    if ($active) {
        $baseClasses .= ' text-golden-amber-400 after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-golden-amber-400 after:rounded-full';
    } else {
        $baseClasses .= ' text-white/80 hover:text-golden-amber-300 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-golden-amber-400 after:rounded-full after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-200';
    }
}

$attributes = $attributes->merge(['class' => $baseClasses]);

// Handle navigation
if (!str_starts_with($href, 'http') && !str_starts_with($href, 'mailto') && !str_starts_with($href, 'tel') && $href !== '#') {
    $attributes = $attributes->merge(['wire:navigate' => true]);
}
@endphp

<a href="{{ $href }}" {{ $attributes }}>
    @if($icon)
        <x-dynamic-component :component="$icon" class="h-4 w-4 mr-2 shrink-0" />
    @endif
    
    <span>{{ $slot }}</span>
    
    @if($active && !$mobile)
        <span class="sr-only">(aktuelle Seite)</span>
    @endif
</a>