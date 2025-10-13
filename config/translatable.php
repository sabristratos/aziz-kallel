<?php

return [
    /*
     * If a translation has not been set for a given locale, use this locale instead.
     */
    'fallback_locale' => 'de',

    /*
     * If set to true, the fallback locale will be used for all locales.
     * If set to false, fallback will only be used if the translation is not found.
     */
    'fallback_any_locale' => false,

    /*
     * By default, the package will use the current application locale.
     * You can override this value by setting a custom locale.
     */
    'locale' => null,

    /*
     * You can specify which locales are available for your application.
     * If set to null, all locales are available.
     */
    'locales' => [
        'de',
        'ar',
    ],
];
