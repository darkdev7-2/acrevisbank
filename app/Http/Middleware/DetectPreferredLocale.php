<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetectPreferredLocale
{
    /**
     * Supported locales
     */
    protected $supportedLocales = ['fr', 'de', 'en', 'es'];

    /**
     * Language mappings for browser languages
     */
    protected $languageMappings = [
        'fr' => 'fr',
        'fr-fr' => 'fr',
        'fr-ch' => 'fr',
        'fr-ca' => 'fr',
        'de' => 'de',
        'de-de' => 'de',
        'de-ch' => 'de',
        'de-at' => 'de',
        'en' => 'en',
        'en-us' => 'en',
        'en-gb' => 'en',
        'en-ca' => 'en',
        'es' => 'es',
        'es-es' => 'es',
        'es-mx' => 'es',
        'it' => 'fr', // Default Italian to French (Switzerland)
        'it-ch' => 'fr',
    ];

    /**
     * Default locale (French for Switzerland)
     */
    protected $defaultLocale = 'fr';

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip if visiting a URL with locale already specified
        $path = $request->path();
        foreach ($this->supportedLocales as $locale) {
            if (str_starts_with($path, $locale . '/') || $path === $locale) {
                return $next($request);
            }
        }

        // Skip locale detection for certain paths
        if (str_starts_with($path, 'locale/') ||
            str_starts_with($path, 'segment/') ||
            str_starts_with($path, 'admin') ||
            str_starts_with($path, 'api/')) {
            return $next($request);
        }

        // Check if user has already selected a locale (stored in session)
        if (session()->has('locale')) {
            $preferredLocale = session('locale');
            if (in_array($preferredLocale, $this->supportedLocales)) {
                return redirect('/' . $preferredLocale);
            }
        }

        // Detect from browser Accept-Language header
        $browserLocale = $this->detectBrowserLocale($request);

        // Store detected locale in session
        session()->put('locale', $browserLocale);

        // Redirect to localized URL
        if ($path === '/') {
            return redirect()->route('home', ['locale' => $browserLocale]);
        }

        return redirect('/' . $browserLocale . '/' . $path);
    }

    /**
     * Detect preferred locale from browser Accept-Language header
     */
    protected function detectBrowserLocale(Request $request): string
    {
        $acceptLanguage = $request->header('Accept-Language');

        if (!$acceptLanguage) {
            return $this->defaultLocale;
        }

        // Parse Accept-Language header
        // Format: "fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7"
        $languages = [];
        foreach (explode(',', $acceptLanguage) as $lang) {
            $parts = explode(';', trim($lang));
            $locale = strtolower(trim($parts[0]));
            $quality = 1.0;

            if (isset($parts[1]) && str_starts_with($parts[1], 'q=')) {
                $quality = (float) substr($parts[1], 2);
            }

            $languages[$locale] = $quality;
        }

        // Sort by quality (highest first)
        arsort($languages);

        // Find first matching supported locale
        foreach ($languages as $locale => $quality) {
            // Direct match
            if (in_array($locale, $this->supportedLocales)) {
                return $locale;
            }

            // Check language mappings
            if (isset($this->languageMappings[$locale])) {
                return $this->languageMappings[$locale];
            }

            // Check base language (e.g., "fr" from "fr-CH")
            $baseLocale = substr($locale, 0, 2);
            if (in_array($baseLocale, $this->supportedLocales)) {
                return $baseLocale;
            }

            if (isset($this->languageMappings[$baseLocale])) {
                return $this->languageMappings[$baseLocale];
            }
        }

        // Default to French (most common in Switzerland)
        return $this->defaultLocale;
    }
}
