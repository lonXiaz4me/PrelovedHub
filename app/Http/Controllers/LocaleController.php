<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    /**
     * Save the visitor's language choice. "auto" removes it,
     * so the browser's language is used again.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $locale = $request->validate([
            'locale' => ['required', 'in:auto,en,ms'],
        ])['locale'];

        $response = redirect()->route('settings');

        if ($locale === 'auto') {
            return $response->withCookie(Cookie::forget('locale'));
        }

        return $response->withCookie(cookie('locale', $locale, 60 * 24 * 365));
    }
}
