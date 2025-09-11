@props(['title' => null, 'description' => null])

@php
use App\Models\Setting;

// Get meta data from settings
$metaTitle = $title ?? Setting::where('key', 'meta_title')->first()?->value ?? config('app.name');
$metaDescription = $description ?? Setting::where('key', 'meta_description')->first()?->value ?? 'Professional financial consulting services';
$consultantName = Setting::where('key', 'consultant_name')->first()?->value ?? 'Financial Consultant';
$contactPhone = Setting::where('key', 'contact_phone')->first()?->value ?? '';
$contactEmail = Setting::where('key', 'contact_email')->first()?->value ?? '';

// Get profile photo for favicon
$profilePhotoSetting = Setting::where('key', 'consultant_profile_photo')->first();
$faviconUrl = $profilePhotoSetting?->getFirstMediaUrl('profile_photo') ?? '/favicon.ico';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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