<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = config('app.available_locales', []);
        $defaultLocale = config('app.locale', 'de');

        // Get locale from route parameter
        $locale = $request->route('locale');

        // If no locale in route (non-localized routes), use default
        if (!$locale) {
            $locale = $defaultLocale;
        }

        // Validate locale and fallback to default
        if (!array_key_exists($locale, $availableLocales)) {
            $locale = $defaultLocale;
        }

        // Set the application locale
        app()->setLocale($locale);

        return $next($request);
    }
}
