<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

@php
use App\Models\Setting;

$logoSetting = Setting::where('key', 'site_logo')->first();
$faviconUrl = $logoSetting?->getFirstMediaUrl('site_logo', 'favicon') ?? '/favicon.ico';
@endphp

<link rel="icon" href="{{ $faviconUrl }}" sizes="any">
<link rel="apple-touch-icon" href="{{ $faviconUrl }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
