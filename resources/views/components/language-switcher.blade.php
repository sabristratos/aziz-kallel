@php
$currentLocale = app()->getLocale();
$nextLocale = $currentLocale === 'ar' ? 'de' : 'ar';
@endphp

<a href="{{ route('locale.switch', $nextLocale) }}"
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