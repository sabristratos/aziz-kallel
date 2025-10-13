<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        @php
            use App\Models\Setting;

            $logoSetting = Setting::where('key', 'site_logo')->first();
            $logoUrl = $logoSetting?->getFirstMediaUrl('site_logo', 'logo-md') ?: asset('abdelaziz-logo.jpg');
        @endphp

        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
                <div class="absolute inset-0 bg-science-blue-900"></div>
                <a href="{{ localized_route('home') }}" class="relative z-20 flex items-center gap-3 text-lg font-medium" wire:navigate>
                    <div class="flex h-10 w-10 items-center justify-center rounded-md overflow-hidden bg-white">
                        <img src="{{ $logoUrl }}" alt="{{ Setting::get('consultant_name') }} Logo" class="w-full h-full object-contain" />
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold">{{ Setting::get('consultant_name') }}</span>
                        <span class="text-sm text-white/80">{{ Setting::get('consultant_title') }}</span>
                    </div>
                </a>

                @php
                    [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
                @endphp

                <div class="relative z-20 mt-auto">
                    <blockquote class="space-y-2">
                        <flux:heading size="lg">&ldquo;{{ trim($message) }}&rdquo;</flux:heading>
                        <footer><flux:heading>{{ trim($author) }}</flux:heading></footer>
                    </blockquote>
                </div>
            </div>
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <a href="{{ localized_route('home') }}" class="z-20 flex flex-col items-center gap-3 font-medium lg:hidden mb-2" wire:navigate>
                        <div class="flex h-14 w-14 items-center justify-center rounded-lg overflow-hidden bg-white">
                            <img src="{{ $logoUrl }}" alt="{{ Setting::get('consultant_name') }} Logo" class="w-full h-full object-contain" />
                        </div>
                        <div class="flex flex-col items-center gap-0.5">
                            <span class="text-lg font-bold text-zinc-900 dark:text-white">{{ Setting::get('consultant_name') }}</span>
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ Setting::get('consultant_title') }}</span>
                        </div>
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
