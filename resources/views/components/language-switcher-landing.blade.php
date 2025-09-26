@php
$currentLocale = app()->getLocale();
$currentRoute = request()->route()->getName();
$currentParams = request()->route()->parameters();

// Remove locale from parameters
unset($currentParams['locale']);

$deUrl = route($currentRoute, array_merge(['locale' => 'de'], $currentParams));
$arUrl = route($currentRoute, array_merge(['locale' => 'ar'], $currentParams));
@endphp

<div class="flex items-center bg-white border border-slate-300 rounded-lg overflow-hidden shadow-sm">
    <!-- German Toggle -->
    <a href="{{ $deUrl }}"
       class="flex items-center justify-center px-3 py-2 text-sm font-medium transition-colors {{ $currentLocale === 'de' ? 'bg-science-blue-500 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
        DE
    </a>

    <!-- Arabic Toggle -->
    <a href="{{ $arUrl }}"
       class="flex items-center justify-center px-3 py-2 text-sm font-medium transition-colors {{ $currentLocale === 'ar' ? 'bg-science-blue-500 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
        AR
    </a>
</div>