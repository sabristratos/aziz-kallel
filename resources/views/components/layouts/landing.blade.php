@props(['title' => null, 'description' => null])

@php
use App\Models\Setting;

// Get meta data from settings - fallback to landing-specific or general settings
$metaTitle = $title ?? Setting::where('key', 'landing_meta_title')->first()?->value ?? Setting::where('key', 'meta_title')->first()?->value ?? config('app.name');
$metaDescription = $description ?? Setting::where('key', 'landing_meta_description')->first()?->value ?? Setting::where('key', 'meta_description')->first()?->value ?? 'Professional financial consulting services';
$consultantName = Setting::where('key', 'consultant_name')->first()?->value ?? 'Financial Consultant';

// Get profile photo for favicon and header
$profilePhotoSetting = Setting::where('key', 'consultant_profile_photo')->first();
$faviconUrl = $profilePhotoSetting?->getFirstMediaUrl('profile_photo') ?? '/favicon.ico';
$profilePhoto = $profilePhotoSetting?->getFirstMediaUrl('profile_photo', 'high_quality');

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

        @fluxAppearance
    </head>
    <body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
        <!-- Minimal Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center items-center py-6">
                    @if($profilePhoto)
                        <div class="flex items-center {{ $isRtl ? 'space-x-reverse space-x-6' : 'space-x-6' }}">
                            <img src="{{ $profilePhoto }}"
                                 alt="{{ $consultantName }}"
                                 class="w-16 h-16 sm:w-18 sm:h-18 rounded-full object-cover shadow-md border-2 border-white" />
                            <div class="{{ $isRtl ? 'text-right' : 'text-center sm:text-left' }}">
                                <h1 class="font-semibold text-gray-900 text-base sm:text-lg">{{ $consultantName }}</h1>
                                <p class="text-sm sm:text-base text-gray-600">{{ __('Deutsche Vermögensberatung') }}</p>
                            </div>
                        </div>
                    @endif
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