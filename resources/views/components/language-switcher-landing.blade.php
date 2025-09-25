@php
$currentLocale = app()->getLocale();
$currentUrl = url()->current();
@endphp

<div class="flex items-center bg-white border border-slate-300 rounded-lg overflow-hidden shadow-sm">
    <!-- German Toggle -->
    <a href="{{ $currentUrl }}?lang=de"
       class="flex items-center justify-center px-3 py-2 text-sm font-medium transition-colors {{ $currentLocale === 'de' ? 'bg-science-blue-500 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
        DE
    </a>

    <!-- Arabic Toggle -->
    <a href="{{ $currentUrl }}?lang=ar"
       class="flex items-center justify-center px-3 py-2 text-sm font-medium transition-colors {{ $currentLocale === 'ar' ? 'bg-science-blue-500 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
        AR
    </a>
</div>