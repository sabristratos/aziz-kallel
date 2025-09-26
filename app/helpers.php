<?php

if (!function_exists('localized_route')) {
    /**
     * Generate a URL for the given route with the current locale.
     */
    function localized_route(string $routeName, array $parameters = []): string
    {
        $locale = app()->getLocale();

        return route($routeName, array_merge(['locale' => $locale], $parameters));
    }
}

if (!function_exists('switch_locale_url')) {
    /**
     * Get the current route URL with a different locale.
     */
    function switch_locale_url(string $targetLocale): string
    {
        $request = request();
        $currentRoute = $request->route()->getName();
        $currentParams = $request->route()->parameters();

        // Remove current locale from parameters
        unset($currentParams['locale']);

        return route($currentRoute, array_merge(['locale' => $targetLocale], $currentParams));
    }
}