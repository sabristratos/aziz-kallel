@props(['id' => null])

@php
use App\Models\Testimonial;

// Get active testimonials
$testimonials = Testimonial::where('is_active', true)
    ->orderBy('sort_order')
    ->get();
@endphp

<x-section-wrapper :id="$id">
    <div class="rounded-3xl">
        <!-- Header -->
        <x-ui.section-header 
            overline="Referenzen"
            title="Was meine Kunden sagen"
            description="Erfahren Sie aus erster Hand, wie ich meinen Kunden bei ihren finanziellen Zielen geholfen habe."
            layout="two-column"
            class="animate-slide-up" />

        <!-- Testimonials Carousel -->
        <div class="splide testimonials-splide" data-testimonials='{{ $testimonials->toJson() }}'>
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($testimonials as $testimonial)
                        <li class="splide__slide">
                            <div class="bg-slate-100 rounded-2xl p-4 sm:p-6 h-full">
                                <!-- Quote Icon -->
                                <div class="mb-4 sm:mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-8 sm:h-12 w-8 sm:w-12 text-science-blue-400">
                                        <path d="M15 10C15 7.23858 17.2386 5 20 5C20.5523 5 21 4.55228 21 4C21 3.44772 20.5523 3 20 3C16.134 3 13 6.13401 13 10V17.75C13 19.2688 14.2312 20.5 15.75 20.5H19.75C21.2688 20.5 22.5 19.2688 22.5 17.75V13.75C22.5 12.2312 21.2688 11 19.75 11H15.75C15.49 11 15.2384 11.0361 15 11.1035V10Z" fill="currentColor"></path>
                                        <path d="M3 10C3 7.23858 5.23858 5 8 5C8.55228 5 9 4.55228 9 4C9 3.44772 8.55228 3 8 3C4.13401 3 1 6.13401 1 10V17.75C1 19.2688 2.23122 20.5 3.75 20.5H7.75C9.26878 20.5 10.5 19.2688 10.5 17.75V13.75C10.5 12.2312 9.26878 11 7.75 11H3.75C3.48999 11 3.23842 11.0361 3 11.1035V10Z" fill="currentColor"></path>
                                    </svg>
                                </div>

                                <!-- Testimonial Content -->
                                <blockquote class="mb-3 sm:mb-4">
                                    <x-ui.text size="small" color="secondary" as="span" class="text-xs sm:text-sm">
                                        {{ is_array($testimonial->content) ? $testimonial->content['de'] ?? $testimonial->content : $testimonial->content }}
                                    </x-ui.text>
                                </blockquote>

                                <!-- Client Details -->
                                <div class="border-l-4 border-science-blue-200 pl-3 sm:pl-4 mt-auto">
                                    <x-ui.text size="small" class="font-semibold text-xs sm:text-sm" as="div">{{ $testimonial->client_name }}</x-ui.text>
                                    <x-ui.text size="xs" color="muted" class="mt-1 text-xs" as="div">{{ $testimonial->client_title ?? 'Kunde' }}</x-ui.text>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Navigation Controls -->
        <div class="flex justify-center items-center space-x-4 sm:space-x-6 mt-6 sm:mt-8">
            <!-- Previous Arrow -->
            <button class="splide-prev p-1.5 sm:p-2 border border-science-blue-300 text-science-blue-600 hover:border-science-blue-500 hover:text-science-blue-700 transition-colors duration-200 rounded-full bg-transparent">
                <x-heroicon-s-chevron-left class="h-3 sm:h-4 w-3 sm:w-4" />
            </button>

            <!-- Navigation Dots -->
            <div class="splide__pagination flex space-x-2"></div>

            <!-- Next Arrow -->
            <button class="splide-next p-1.5 sm:p-2 border border-science-blue-300 text-science-blue-600 hover:border-science-blue-500 hover:text-science-blue-700 transition-colors duration-200 rounded-full bg-transparent">
                <x-heroicon-s-chevron-right class="h-3 sm:h-4 w-3 sm:w-4" />
            </button>
        </div>
    </div>
</x-section-wrapper>


