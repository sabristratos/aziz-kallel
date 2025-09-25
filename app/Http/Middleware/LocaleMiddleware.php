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
        $defaultLocale = config('app.locale', 'ar');

        // Check for locale in session first
        $locale = session('locale');

        // If no locale in session, use browser preferences
        if (!$locale) {
            $preferredLanguages = $request->getLanguages();
            foreach ($preferredLanguages as $lang) {
                // Check both full locale (e.g., 'en-US') and language code (e.g., 'en')
                if (array_key_exists($lang, $availableLocales)) {
                    $locale = $lang;
                    break;
                }

                // Check just the language part (e.g., 'en' from 'en-US')
                $langCode = substr($lang, 0, 2);
                if (array_key_exists($langCode, $availableLocales)) {
                    $locale = $langCode;
                    break;
                }
            }
        }

        // Validate locale and fallback to default
        if (!$locale || !array_key_exists($locale, $availableLocales)) {
            $locale = $defaultLocale;
        }

        // Set the application locale
        app()->setLocale($locale);

        return $next($request);
    }
}
