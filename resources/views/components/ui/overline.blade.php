@props([
    'text' => '',
    'align' => 'center' // center, left, right
])

@php
$alignmentClasses = [
    'center' => 'justify-center text-center',
    'left' => 'justify-start text-left',
    'right' => 'justify-end text-right'
];

$textAlign = $alignmentClasses[$align] ?? $alignmentClasses['center'];
@endphp

<div class="flex items-center gap-2 mb-3 {{ $textAlign }}">
    <span class="text-xs font-semibold uppercase tracking-widest text-golden-amber-600">{{ $text }}</span>
    <div class="w-1.5 h-1.5 bg-golden-amber-500 rounded-full"></div>
</div>