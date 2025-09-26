<?php

namespace App\Helpers;

class LocaleHelper
{
    /**
     * Generate a URL for the given route with the current locale.
     */
    public static function route(string $routeName, array $parameters = []): string
    {
        $locale = app()->getLocale();

        return route($routeName, array_merge(['locale' => $locale], $parameters));
    }

    /**
     * Generate a URL for the given route with a specific locale.
     */
    public static function routeWithLocale(string $routeName, string $locale, array $parameters = []): string
    {
        return route($routeName, array_merge(['locale' => $locale], $parameters));
    }

    /**
     * Get the current route URL with a different locale.
     */
    public static function switchLocale(string $targetLocale): string
    {
        $request = request();
        $currentRoute = $request->route()->getName();
        $currentParams = $request->route()->parameters();

        // Remove current locale from parameters
        unset($currentParams['locale']);

        return route($currentRoute, array_merge(['locale' => $targetLocale], $currentParams));
    }

    /**
     * Get all available locale URLs for the current page.
     */
    public static function getAllLocaleUrls(): array
    {
        $availableLocales = config('app.available_locales', []);
        $urls = [];

        foreach (array_keys($availableLocales) as $locale) {
            $urls[$locale] = static::switchLocale($locale);
        }

        return $urls;
    }
}