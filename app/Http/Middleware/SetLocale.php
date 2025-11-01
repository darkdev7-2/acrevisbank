<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);
        $availableLocales = ['fr', 'de', 'en', 'es'];

        // Check if the first segment is a valid locale
        if (in_array($locale, $availableLocales)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
        } else {
            // If no locale in URL, use session or default (fr)
            $locale = session('locale', config('app.fallback_locale', 'fr'));
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
