@props(['title' => null, 'description' => null])

@php
use App\Models\Setting;

// Get meta data from settings
$metaTitle = $title ?? Setting::where('key', 'meta_title')->first()?->value ?? config('app.name');
$metaDescription = $description ?? Setting::where('key', 'meta_description')->first()?->value ?? 'Professional financial consulting services';
$consultantName = Setting::where('key', 'consultant_name')->first()?->value ?? 'Financial Consultant';
$contactPhone = Setting::where('key', 'contact_phone')->first()?->value ?? '';
$contactEmail = Setting::where('key', 'contact_email')->first()?->value ?? '';

// Get logo for favicon
$logoSetting = Setting::where('key', 'site_logo')->first();
$faviconUrl = $logoSetting?->getFirstMediaUrl('site_logo', 'favicon') ?? '/favicon.ico';

// Get social sharing image (consultant photo or logo fallback)
$consultantPhotoSetting = Setting::where('key', 'consultant_profile_photo')->first();
$socialImageUrl = $consultantPhotoSetting?->getFirstMediaUrl('profile_photo', 'social')
    ?? $logoSetting?->getFirstMediaUrl('site_logo', 'social')
    ?? url(asset('abdelaziz-kallel-2.png'));
$socialImageAlt = $consultantName . ' - ' . config('app.name');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="{{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">
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

        @fluxAppearance
    </head>
    <body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
        <!-- Header Only (No Hero) -->
        <header class="bg-gradient-to-br from-science-blue-400 via-science-blue-500 to-science-blue-600">
            <div class="max-w-7xl mx-auto px-6 py-6 lg:px-8 lg:py-8">
                <div class="rounded-3xl overflow-hidden">
                    <x-header.main class="z-50 isolate" />
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <x-footer.main />
        </div>
        
        <!-- Cookie Consent -->
        <x-cookie-consent />
        
        @script
        @fluxScripts
    </body>
</html>