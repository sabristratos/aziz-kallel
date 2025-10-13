@php
    use App\Models\Setting;

    $logoSetting = Setting::where('key', 'site_logo')->first();
    $logoUrl = $logoSetting?->getFirstMediaUrl('site_logo', 'logo-sm') ?: asset('abdelaziz-logo.jpg');
@endphp

<div class="flex aspect-square size-8 items-center justify-center rounded-lg overflow-hidden bg-white dark:bg-white">
    <img src="{{ $logoUrl }}" alt="{{ Setting::get('consultant_name') }} Logo" class="w-full h-full object-contain" />
</div>
<div class="ms-1 grid flex-1 text-start text-sm">
    <span class="mb-0.5 truncate leading-tight font-semibold">{{ Setting::get('consultant_name') }}</span>
    <span class="truncate text-xs text-zinc-500 dark:text-zinc-400">{{ Setting::get('consultant_title') }}</span>
</div>
