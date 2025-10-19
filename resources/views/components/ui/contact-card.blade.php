@props([
    'title' => '',
    'description' => '',
    'action' => '',
    'href' => '#',
    'icon' => null
])

<div class="relative group p-3 sm:p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
    <div class="relative z-10">
        <x-ui.heading level="4" class="mb-1 text-sm sm:text-base">{{ $title }}</x-ui.heading>
        <x-ui.text color="secondary" class="mb-2 text-xs sm:text-sm">{{ $description }}</x-ui.text>
        @if($action)
            <x-ui.link href="{{ $href }}">
                <span dir="ltr">{{ $action }}</span>
            </x-ui.link>
        @else
            {{ $slot }}
        @endif
    </div>
    
    @if($icon)
        <!-- Background Icon -->
        <div class="absolute -top-2 ltr:-left-2 rtl:-right-2 w-20 h-20 text-golden-amber-500/8 ltr:-rotate-12 rtl:rotate-12 transition-all duration-300 ease-out group-hover:scale-110 ltr:group-hover:-rotate-[20deg] rtl:group-hover:rotate-[20deg] group-hover:text-golden-amber-500/12">
            <x-dynamic-component :component="$icon" class="w-full h-full" />
        </div>
    @endif
</div>