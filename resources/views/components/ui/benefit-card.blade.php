@props([
    'title' => '',
    'description' => '',
    'icon' => null,
    'iconRotation' => '-rotate-12'
])

<div class="bg-science-blue-100 rounded-2xl p-6 flex-1 flex items-center relative overflow-hidden group">
    <div class="relative z-10">
        <x-ui.heading level="4" class="mb-2">{{ $title }}</x-ui.heading>
        <x-ui.text size="small" color="secondary" class="line-clamp-3">{{ $description }}</x-ui.text>
    </div>
    
    @if($icon)
        <!-- Background Icon -->
        <div class="absolute -bottom-6 -right-6 w-32 h-32 text-golden-amber-500/10 {{ $iconRotation }} transition-all duration-300 ease-out group-hover:scale-110 group-hover:-rotate-[30deg] group-hover:text-golden-amber-500/20">
            <x-dynamic-component :component="$icon" class="w-full h-full" />
        </div>
    @endif
</div>