<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public const SUPPORTED = ['en', 'ms'];

    /**
     * Pick the language: the visitor's saved choice first,
     * otherwise whatever their browser prefers, otherwise the app default.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->cookie('locale');

        if (! in_array($locale, self::SUPPORTED, true)) {
            $locale = $request->getPreferredLanguage(self::SUPPORTED) ?? config('app.locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
