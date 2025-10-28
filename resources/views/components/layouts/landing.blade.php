@props(['title' => null, 'description' => null])

@php
use App\Models\Setting;

// Get meta data from settings - fallback to landing-specific or general settings
$metaTitle = $title ?? Setting::where('key', 'landing_meta_title')->first()?->value ?? Setting::where('key', 'meta_title')->first()?->value ?? config('app.name');
$metaDescription = $description ?? Setting::where('key', 'landing_meta_description')->first()?->value ?? Setting::where('key', 'meta_description')->first()?->value ?? 'Professional financial consulting services';
$consultantName = Setting::where('key', 'consultant_name')->first()?->value ?? 'Financial Consultant';

// Get logo for favicon and header
$logoSetting = Setting::where('key', 'site_logo')->first();
$faviconUrl = $logoSetting?->getFirstMediaUrl('site_logo', 'favicon') ?? '/favicon.ico';
$logoUrl = $logoSetting?->getFirstMediaUrl('site_logo', 'logo-lg') ?: asset('abdelaziz-logo.jpg');

// Get social sharing image (consultant photo or logo fallback)
$consultantPhotoSetting = Setting::where('key', 'consultant_profile_photo')->first();
$socialImageUrl = $consultantPhotoSetting?->getFirstMediaUrl('profile_photo', 'social')
    ?? $logoSetting?->getFirstMediaUrl('site_logo', 'social')
    ?? url(asset('abdelaziz-kallel-2.png'));
$socialImageAlt = $consultantName . ' - ' . config('app.name');

// RTL support
$currentLocale = app()->getLocale();
$isRtl = in_array($currentLocale, ['ar', 'he', 'fa', 'ur']);
$direction = $isRtl ? 'rtl' : 'ltr';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $direction }}" class="{{ $isRtl ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $metaTitle }}</title>
        <meta name="description" content="{{ $metaDescription }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $metaTitle }}">
        <meta property="og:description" content="{{ $metaDescription }}">
        <meta property="og:image" content="{{ $socialImageUrl }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="{{ $socialImageAlt }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:title" content="{{ $metaTitle }}">
        <meta property="twitter:description" content="{{ $metaDescription }}">
        <meta property="twitter:image" content="{{ $socialImageUrl }}">
        <meta property="twitter:image:alt" content="{{ $socialImageAlt }}">

        <!-- Favicon -->
        <link rel="icon" href="{{ $faviconUrl }}" sizes="any">
        <link rel="apple-touch-icon" href="{{ $faviconUrl }}">

        <!-- Styles & Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
        <!-- Minimal Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center items-center py-6">
                    <div class="flex items-center {{ $isRtl ? 'space-x-reverse gap-6' : 'gap-6' }}">
                        <div class="w-24 h-24 rounded-lg overflow-hidden bg-white flex items-center justify-center">
                            <img src="{{ $logoUrl }}"
                                 alt="{{ $consultantName }} Logo"
                                 class="w-full h-full object-contain" />
                        </div>
                        <div class="{{ $isRtl ? 'text-right' : 'text-center sm:text-left' }}">
                            <h1 class="font-semibold text-gray-900 text-base sm:text-lg">{{ $consultantName }}</h1>
                            <p class="text-sm sm:text-base text-gray-600">{{ __('Deutsche Vermögensberatung') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Simple Footer -->
        <x-footer.simple />

        @script
        @fluxScripts
    </body>
</html>
