@props([
    'src' => null,
    'alt' => '',
    'fallback' => null,
    'size' => 'md',
    'animated' => false
])

@php
$sizeClasses = [
    'xs' => 'h-6 w-6',
    'sm' => 'h-8 w-8',
    'md' => 'h-10 w-10',
    'lg' => 'h-12 w-12',
    'xl' => 'h-16 w-16',
    '2xl' => 'h-20 w-20',
];

$avatarClasses = 'relative inline-flex items-center justify-center shrink-0 overflow-hidden bg-white border-2 border-slate-200 text-slate-500 font-medium select-none rounded-full shadow-sm';
$sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<div {{ $attributes->merge(['class' => $avatarClasses . ' ' . $sizeClass]) }}>
    @if($src)
        <img src="{{ $src }}" 
             alt="{{ $alt }}" 
             class="h-full w-full object-cover rounded-full" />
    @else
        <span class="text-xs">{{ $fallback ?: strtoupper(substr($alt, 0, 2)) }}</span>
    @endif
</div>
