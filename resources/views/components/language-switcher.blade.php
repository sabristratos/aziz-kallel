@php
$currentLocale = app()->getLocale();
$currentRoute = request()->route()->getName();
$currentParams = request()->route()->parameters();

// Remove locale from parameters for the alternate locale
unset($currentParams['locale']);

$nextLocale = $currentLocale === 'ar' ? 'de' : 'ar';
$nextUrl = route($currentRoute, array_merge(['locale' => $nextLocale], $currentParams));
@endphp

<a href="{{ $nextUrl }}"
   class="flex items-center bg-white border border-slate-300 rounded-lg overflow-hidden hover:bg-slate-50 transition-colors">
    <!-- Current Language (Active) -->
    <div class="flex items-center justify-center px-3 py-2 text-sm font-medium bg-science-blue-500 text-white">
        {{ strtoupper($currentLocale) }}
    </div>

    <!-- Next Language (Inactive) -->
    <div class="flex items-center justify-center px-3 py-2 text-sm font-medium text-slate-600">
        {{ strtoupper($nextLocale) }}
    </div>
</a>