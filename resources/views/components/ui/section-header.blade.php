@props([
    'overline' => '',
    'title' => '',
    'description' => '',
    'layout' => 'two-column' // two-column, centered
])

@if($layout === 'two-column')
    <!-- Two Column Layout -->
    <div class="grid lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-12 items-center mb-8 sm:mb-12">
        <!-- Left Column: Overline & Heading -->
        <div>
            @if($overline)
                <x-ui.overline text="{{ $overline }}" align="left" />
            @endif
            <x-ui.heading level="2" class="text-xl sm:text-2xl lg:text-3xl">
                {{ $title }}
            </x-ui.heading>
        </div>
        
        <!-- Right Column: Description -->
        <div>
            @if($description)
                <x-ui.text size="lead" color="secondary" class="text-sm sm:text-base lg:text-lg">
                    {{ $description }}
                </x-ui.text>
            @endif
        </div>
    </div>
@else
    <!-- Centered Layout -->
    <div class="text-center mb-8 sm:mb-12">
        @if($overline)
            <x-ui.overline text="{{ $overline }}" />
        @endif
        <x-ui.heading level="2" class="mb-3 sm:mb-4 text-xl sm:text-2xl lg:text-3xl">
            {{ $title }}
        </x-ui.heading>
        @if($description)
            <x-ui.text size="lead" color="secondary" class="max-w-2xl mx-auto text-sm sm:text-base lg:text-lg">
                {{ $description }}
            </x-ui.text>
        @endif
    </div>
@endif