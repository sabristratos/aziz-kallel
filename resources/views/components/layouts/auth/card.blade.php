<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        @php
            use App\Models\Setting;

            $logoSetting = Setting::where('key', 'site_logo')->first();
            $logoUrl = $logoSetting?->getFirstMediaUrl('site_logo', 'logo-md') ?: asset('abdelaziz-logo.jpg');
        @endphp

        <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <a href="{{ localized_route('home') }}" class="flex flex-col items-center gap-3 font-medium mb-2" wire:navigate>
                    <div class="flex h-14 w-14 items-center justify-center rounded-lg overflow-hidden bg-white">
                        <img src="{{ $logoUrl }}" alt="{{ Setting::get('consultant_name') }} Logo" class="w-full h-full object-contain" />
                    </div>
                    <div class="flex flex-col items-center gap-0.5">
                        <span class="text-lg font-bold text-zinc-900 dark:text-white">{{ Setting::get('consultant_name') }}</span>
                        <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ Setting::get('consultant_title') }}</span>
                    </div>
                </a>

                <div class="flex flex-col gap-6">
                    <div class="rounded-xl border bg-white dark:bg-stone-950 dark:border-stone-800 text-stone-800 shadow-xs">
                        <div class="px-10 py-8">{{ $slot }}</div>
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
