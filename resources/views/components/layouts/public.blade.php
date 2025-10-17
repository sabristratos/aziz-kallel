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
        <meta property="og:title" content="{{ $metaTitle }}">
        <meta property="og:description" content="{{ $metaDescription }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary">
        <meta property="twitter:title" content="{{ $metaTitle }}">
        <meta property="twitter:description" content="{{ $metaDescription }}">

        <!-- Favicon -->
        <link rel="icon" href="{{ $faviconUrl }}" sizes="any">
        <link rel="apple-touch-icon" href="{{ $faviconUrl }}">


        <!-- Styles & Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="min-h-screen max-w-7xl mx-auto px-2 pt-6 lg:px-8 lg:pt-8 bg-slate-50 text-slate-900 antialiased">
        <!-- Header and Hero with Gradient -->
        <div>
            <div class="bg-gradient-to-br from-science-blue-400 via-science-blue-500 to-science-blue-600 rounded-3xl overflow-hidden">
                <!-- Main Header -->
                <x-header.main class="z-50 isolate" />

                <!-- Hero Section Only -->
                @livewire('hero-section')
            </div>
        </div>

        <!-- Main Content (Other Sections) -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <x-footer.main />

        <!-- Cookie Consent -->
        <x-cookie-consent />

        <!-- Mobile Menu (at body level for proper positioning) -->
        <x-header.mobile-menu />

        @script
        @fluxScripts
    </body>
</html>
